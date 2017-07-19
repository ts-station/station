<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en" style="font-size: 100px">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>支付方式</title>
    <link rel="stylesheet" href="/station/Public/Home/css/common.css">
    <link rel="stylesheet" href="/station/Public/Home/less/payment.css">
</head>
<body>
<div class="header">
    <a href="#" onClick="javascript:history.back(-1);"></a><div>支付方式</div>
</div>

<div class="box-t">
    <div id="date">请在5分0秒内完成支付，逾期将自动取消预订！</div>
    <div>
        <span>订购业务</span>
        <span>汽车业务票</span>
    </div>
    <div>
        <span>金额</span>
        <span>¥<?php echo ($price); ?></span>
    </div>
    <div>
        <span>订单号</span>
        <span><?php echo ($order_id); ?></span>
    </div>
</div>

<div class="box-b">
    <div>请选择支付方式</div>
    <div>
        <span class="fl"></span>
        <span class="fl">微信支付</span>
        <span class="fr"></span>
    </div>
</div>

<div class="foot">
    <span class="fl">¥</span><span class="fl">0</span><span class="fl">微信支付</span><span id="btn1" class="fr">去支付</span>
</div>

</body>
<script src="/station/Public/Home/js/common.js"></script>

<script>
    (function() {
        function p (n){
            return n < 10 ? '0'+ n : n;
        }


        for (var m=5; m>=5; m--)
        {
            return m
        }
        var html =  "请在"+p(oMinutes)+"分"+p(oSeconds)+"秒内完成支付，逾期将自动取消预订！";
        document.getElementById('date').innerHTML = html;
        //别忘记当时间为0的，要让其知道结束了;
        if(countDown < 0){
            document.getElementById('time').innerHTML = '元旦到了';
        }
        console.log(html);
    })()
</script>
</html>