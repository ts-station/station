<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en" style="font-size: 100px">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>订单提交</title>
    <link rel="stylesheet" href="/station/Public/Home/css/common1.css">
    <link rel="stylesheet" href="/station/Public/Home/less/refer1.css">
</head>
<body>


<div class="header">
    <a href="#" onClick="javascript:history.back(-1);"></a><div>提交订单</div>
</div>

<div class="cont">
    <div>
        <div></div>
        <div>
            <span><?php echo ($info["tml_busmodel"]); ?></span><span>班次267</span>
        </div>
        <div>
            <span>服务费：¥3.0元/张</span><span>服务费：¥3.0元/张</span>
        </div>
        <div>
            <span>里程&nbsp;<?php echo ($line_info["li_kilometer"]); ?>km</span><span>票价&nbsp;<span>¥<?php echo ($info["pd_fullprice"]); ?></span></span>
        </div>
    </div>
    <div><?php echo ($info["tml_noofrunsdate"]); ?>&nbsp;</div>
    <div>
        <span><span></span><span><?php echo ($info["tml_beginstation"]); ?></span></span>
        <span><span><?php echo ($info["tml_noofrunstime"]); ?></span><div></div></span>
        <span><span></span><span><?php echo ($info["tml_endstation"]); ?></span></span>
    </div>
</div>

<div class="box">
    <ul>

        <?php if(is_array($passenger_list)): $i = 0; $__LIST__ = $passenger_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><li>
                <span></span>
            <span>
                <div>
                    <span><?php echo ($p["cpm_purchasername"]); ?></span>
                    <span>成人票</span>
                </div>
                <div>身份证&nbsp;<?php echo ($p["cpm_card"]); ?></div>
            </span>
            <span>
                <span></span>
                <span>保险</span>
            </span>
            <span>
                <span></span>
                <span>携童</span>
            </span>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>

<button class="btn-add">
    <span></span><span>添加乘客</span>
</button>
<form action="payment" method="post">
    <input type="text" name="runsid" value="<?php echo ($runsid); ?>" style="display: none">
    <input type="text" name="runsdate" value="<?php echo ($runsdate); ?>" style="display: none">
    <input type="text" name="passenger" value="<?php echo ($passenger); ?>" style="display: none" id="passenger">
    <input type="text" name="price" value="<?php echo ($info['pd_fullprice']*$num); ?>" style="display: none">
    <div class="btn-a">
        <div class="btn-name">取票人
            <input type="text" placeholder="请输入您的真实姓名" name="name" id="name">
        </div>
        <div class="btn-tel">手机号
            <input type="text" placeholder="请输入您的手机号码" name="tel" id="tel">
        </div>
    </div>
    <input type="submit" value="查 询" style="display: none" id="payment-submit">
</form>

<div class="foot">
    <span class="fl">¥</span><span class="fl"><?php echo ($info['pd_fullprice']*$num); ?></span><span class="fl" id="btn1">明细</span><span id="btn3" class="fr">去支付</span>
</div>

<div class="aff" style="display: none;">
    <div id="btn2"></div>
    <div>
        <div>
            <span class="fl">票价</span>
            <span class="fr">¥290×1份</span>
        </div>
        <div>
            <span class="fl">服务费</span>
            <span class="fr">¥3×1份</span>
        </div>
        <div>
            <span class="fl">保险</span>
            <span class="fr">¥3×1份</span>
        </div>
        <div>
            <span class="fr">去支付</span>
        </div>
    </div>
</div>

</body>

<script src="/station/Public/Home/js/jquery.js"></script>
<script src="/station/Public/Home/js/common.js"></script>
<script>
    $(function(){
        $("#btn1").click(function () {
            $(".aff").stop().show(1);
        })
        $("#btn2").click(function () {
            $(".aff").stop().hide(1);
        })
        $("#btn3").click(function () {
            var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            if(!myreg.test($("#tel").val()))
            {
                alert('请输入有效的手机号码！');
                return false;
            }
            var namereg = /^[\u4e00-\u9fa5]{2,4}$/i;
            if (namereg.test($("#name").val()) === false) {
                alert('请输入正确的姓名');
                return false;
            }

            if(!$("#passenger").val())
            {
                alert('请添加乘客！');
                return false;
            }
            //alert(tel);
            $("#payment-submit").click();
        })
        $(".btn-add").click(function () {
            var runsid='<?php echo ($runsid); ?>';
            runsid=encodeURIComponent(runsid);
            var runsdate='<?php echo ($runsdate); ?>';
            var passenger='<?php echo ($passenger); ?>';
            window.location.href="add_passenger?runsid="+runsid+"&runsdate="+runsdate+"&passenger="+passenger;
        })
    })
</script>
</html>