<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>常用乘车联系人</title>
    <link rel="stylesheet" href="/station/Public/Home/css/common.css">
    <link rel="stylesheet" href="/station/Public/Home/less/cclxr.css">
    <script src="/station/Public/Home/js/jquery.js"></script>
    <script src="/station/Public/Home/libs/mirrors-lhgcalendar-master/lhgcalendar/lhgcalendar.js"></script>
    <script src="/station/Public/Home/js/common.js"></script>
    <script src="/station/Public/Home/js/cycclxr.js"></script>
</head>
<body>
<!--header start-->
<header class="w">
    <a href="#" onClick="javascript:history.back(-1);">&lt;</a>
    <h3>新增常用乘车人</h3>
</header>
<!--header end-->
<!--select-box start-->
<!--成人票页面-->
<div class="select-box clearfix">
    <div class="w">
        <ul>
            <li><a href="#" <?php if($data['cpm_date'] == null): ?>class="select-box-ed"<?php endif; ?> id="1">成人</a></li>
            <li><a href="#"  <?php if($data['cpm_date']): ?>class="select-box-ed"<?php endif; ?> id="2">儿童</a></li>
        </ul>
    </div>
</div>
<input type="text" id="select-type" style="display:none" value="1"/>
<div class="select-con-1 clearfix" <?php if($data['cpm_date']): ?>style="display:none"<?php endif; ?>>
    <ul>
        <li><span>乘客姓名</span>
            <input type="text" placeholder="请输入证件上的姓名" id="name1" <?php if($data['cpm_purchasername']): ?>value="<?php echo ($data["cpm_purchasername"]); ?>"<?php endif; ?>>
       </li>
        <li><span>证件类型</span>
            <p id="cardType">身份证 <em> &gt;</em></p>
        </li>
        <li><span>证件号码</span><input type="text" placeholder="请输入正确的证件号码" id="code" <?php if($data['cpm_card']): ?>value="<?php echo ($data["cpm_card"]); ?>"<?php endif; ?>></li>
        <li><span>手机号</span><input type="text" placeholder="请输入正确的手机号码" id="tel" <?php if($data['cpm_tel']): ?>value="<?php echo ($data["cpm_tel"]); ?>"<?php endif; ?>></li>
    </ul>
</div>
<!--儿童票页面-->
<div class="select-con-2 clearfix" <?php if($data['cpm_date']): ?>style="display:block"<?php endif; ?>>
    <ul>
        <li><span>乘客姓名</span> <input type="text" placeholder="请输入儿童姓名" id="name2" <?php if($data['cpm_purchasername']): ?>value="<?php echo ($data['cpm_purchasername']); ?>"<?php endif; ?>></li>
        <li><span>出生日期</span>

            <!--时间选择插件-->
            <input class="runcode" id="demo_inp1" placeholder="请选择年月日&gt;" <?php if($data['cpm_date']): ?>value="<?php echo ($data["cpm_date"]); ?>"<?php endif; ?>/>
        </li>
    </ul>
</div>
<p id="sub" >确认添加</p>
<!--select-box end-->
<!--成人票 弹窗 start-->
<div class="adult-alert">
    <div class="adult-box">
        <ul>
            <li>身份证</li>
            <li>护照</li>
            <li>军人证</li>
            <p id="clear-alert">取消</p>
        </ul>
    </div>
</div>
<!--成人票 弹窗 end-->
</body>
<script>
    $(document).ready(function(){
        $("#adult").click(function(){
            $('#select-type').val('1');
        })
        $("#children").click(function(){alert();
            $('#select-type').val('2');
        })
        $("#sub").click(function() {
            var type = $('.select-box-ed').attr('id');
            if (type == 1) {
                var name = $('#name1').val();
                var code = $('#code').val();
                var tel = $("#tel").val();
                if (name == '') {
                    alert('请输入姓名');
                    return false;
                }
                var namereg = /^[\u4e00-\u9fa5]{2,4}$/i;
                if (namereg.test(name) === false) {
                    alert('请输入正确的姓名');
                    return false;
                }
                var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
                if (reg.test(code) === false) {
                    alert('请输入有效的证件号');
                    return false;
                }
                var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
                if(!myreg.test(tel))
                {
                    alert('请输入有效的手机号码！');
                    return false;
                }

                $.ajax({
                    type:'post',
                    url:"add_purchaser_member",
                    data:{name:name,card:code,tel:tel},
                    dataType:'html',
                    success:function(msg){
                        var data=eval('('+msg+')');
                        if(data.errcode==-1){
                            alert(data.message);
                        }
                        if(data.errcode==0){
                            window.location.href="../order/purchaser_member_list";
                        }
                    }
                });
            }
            if(type == 2){
                var name = $('#name2').val();
                var date = $('#demo_inp1').val();
                if (name == '') {
                    alert('请输入姓名');
                    return 0;
                }
                if (date == '') {
                    alert('请输入生日');
                    return 0;
                }
                $.ajax({
                    type:'post',
                    url:"add_purchaser_member",
                    data:{name:name,date:date},
                    dataType:'html',
                    success:function(msg){
                        var data=eval('('+msg+')');
                        if(data.errcode==-1){
                            alert(data.message);
                        }
                        if(data.errcode==0){
                            window.location.href="../order/purchaser_member_list";
                        }
                    }
                });
            }

        });
    });
</script>
</html>