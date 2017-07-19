<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>我的订单</title>
    <link rel="stylesheet" href="/station/Public/Home/css/common.css">
    <link rel="stylesheet" href="/station/Public/Home/less/orderDetails.css">
    <script src="/station/Public/Home/js/jquery.js"></script>
    <script src="/station/Public/Home/js/jquery.qrcode.min.js"></script>
    <script src="/station/Public/Home/js/common.js"></script>
</head>
<body>
<!--header start-->
<header class="w">
    <a href="#" onClick="javascript:history.back(-1);">&lt;</a>
    <span>订单详情</span>
</header>
<!--header end-->
<!--content s-->
<div class="content">
    <!--top s-->
    <div class="con-top clearfix">
        <p>待支付</p>
        <p id="newPay">立即支付</p>
    </div>
    <!--top e-->
    <!--con s-->
    <div class="con-con">
        <!--<input type="button" id="btn" value="免费获取验证码" onclick="settime(this)" />-->
        <div class="con-con-t">请在<span><span id="minute">5</span>分<span id="second">0</span>秒</span>内完成支付逾期将自动取消订单</div>
        <div class="con-con-t2"><p>车票信息</p></div>
        <div class="con-con-c clearfix">
            <div><span><?php echo ($order_info["tml_beginstation"]); ?></span></div>
            <div>
                <span><?php echo ($order_info["th_noofrunsdate"]); ?> <?php echo ($order_info["tml_noofrunstime"]); ?></span>
                <span></span>
                <span>固定班 <?php echo ($order_info["tml_busmodel"]); ?></span>
            </div>
            <div><span><?php echo ($order_info["tml_endstation"]); ?></span></div>
        </div>
        <div class="con-con-t2"><p>乘客信息</p></div>
        <?php if(is_array($purchaser_list)): $i = 0; $__LIST__ = $purchaser_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><div class="con-con-b clearfix">
                <span><?php echo ($f["cpm_purchasername"]); ?><span>全票</span></span>
                <span><?php echo ($f["cpm_tel"]); ?></span>
                <span>保险</span>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="con-con-b2 clearfix">
            <p>订单金额</p>
            <p><span>￥</span><?php echo ($order_info["th_pricetotal"]); ?> <span>&gt;</span></p>
        </div>
        <div class="con-con-b3 clearfix">
            <p>保险</p>
            <p>乘客意外伤害保险 (3元) <span>&gt;</span></p>
        </div>
        <!--footer s-->
        <footer>
            <div class="footer-t">
                <p>订单编号: <?php echo ($order_info["th_orderid"]); ?></p>
            </div>
            <div class="footer-b">
                <p>订单时间: <?php echo ($order_info["th_noofrunsdate"]); ?> <?php echo ($order_info["tml_noofrunstime"]); ?></p>
            </div>
        </footer>
        <!--footer e-->
        <div class="footer-btn">
            <p>作废订单</p>
            <p>继续支付</p>
        </div>
    </div>
    <!--con e-->

</div>
<!--content e-->


</body>
<script src="/station/Public/Home/js/jquery.js"></script>
<script>
    var m = 4;//传个分钟数到这里
    var s = 59;
    function showtime(){
        document.getElementById('minute').innerHTML = m;
        document.getElementById('second').innerHTML = s;
        s = s-1;
        if(s<0){
            m = m -1;
            s = 59
        }
        if(m==0){
            //window.location='http://www.ewceo.com';//倒计时结束跳转到www.ewceo.com
        }
    }
    clearInterval(settime);
    var settime = setInterval(function(){
        showtime();
    },1000);
</script>
</html>