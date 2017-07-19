<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" style="font-size: 100px">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>个人中心</title>
    <link rel="stylesheet" href="/station/Public/Home/css/common1.css">
    <link rel="stylesheet" href="/station/Public/Home/less/personal.css">
</head>
<body>
    <div class="header">
        <div>我的</div>
        <div>
            <div></div>
            <div>微信昵称</div>
        </div>
    </div>

    <div class="cont">
        <div id="purchaser">
            <span></span><span>常用乘车人</span><span></span>
        </div>
        <div id="order">
            <span></span><span>我的订单</span><span></span>
        </div>
        <div>
            <div id="notice">
                <span></span><span href="">最新公告</span><span></span>
            </div>
            <div>
                <span></span><span href="">关于我们</span><span></span>
            </div>
        </div>
    </div>
</body>
<script src="/station/Public/Home/js/common.js"></script>
<script src="/station/Public/Home/js/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#purchaser").click(function(){
            window.location.href="../order/purchaser_member_list";
        });
        $("#order").click(function(){
            window.location.href="../order/order_list";
        });
        $("#notice").click(function(){
            window.location.href="../notice/index";
        });

    });
</script>
</html>