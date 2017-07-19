<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>我的订单</title>
    <link rel="stylesheet" href="/station/Public/Home/css/common.css">
    <link rel="stylesheet" href="/station/Public/Home/less/orders.css">
    <script src="/station/Public/Home/js/jquery.js"></script>
    <script src="/station/Public/Home/js/jquery.qrcode.min.js"></script>
    <script src="/station/Public/Home/js/common.js"></script>
    <script src="/station/Public/Home/js/orders.js"></script>
</head>
<body>
<!--header start-->
<header class="w">
    <a href="#" onClick="javascript:history.back(-1);">&lt;</a>
    <span>我的订单</span>
</header>
<!--header end-->
<!--content s-->
<!--<div class="content">
    &lt;!&ndash;top s&ndash;&gt;
    <div class="con-top clearfix">
        <div class="con-top-l fl">固定班</div>
        <div class="con-top-r fr">未支付</div>
    </div>
    &lt;!&ndash;top e&ndash;&gt;
    &lt;!&ndash;con s&ndash;&gt;
    <div class="con-con">
        <div>
            <span>泸州南</span>
            <span></span>
            <span>成都北</span>
        </div>
        <div>
            <span>发车时间:</span>
            <span>08月08日</span>
            <span>08:00发车</span>
        </div>
        <div style="text-align: right">
            <span>共1张票</span>
            <span>服务费￥3.00</span>
            <span>金额<span>￥</span><span>290</span></span>
        </div>
    </div>
    &lt;!&ndash;con e&ndash;&gt;
</div>-->
<?php if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><div class="content">
        <!--top s-->
        <div class="con-top clearfix">
            <div class="con-top-l fl">固定班</div>
            <div class="con-top-r fr" style="color: #989898">订票成功</div>
        </div>
        <!--top e-->
        <!--con s-->
        <div class="con-con order-list" orderid="<?php echo ($f["th_id"]); ?>">
            <div>
                <span><?php echo ($f["tml_beginstation"]); ?></span>
                <span></span>
                <span><?php echo ($f["tml_endstation"]); ?></span>
            </div>
            <div>
                <span>发车时间:</span>
                <span><?php echo ($f["th_noofrunsdate"]); ?></span>
                <span><?php echo ($f["tml_noofrunstime"]); ?>发车</span>
            </div>
            <div style="text-align: right">
                <span>共1张票</span>
                <span>服务费￥3.00</span>
                <span>金额<span>￥</span><span><?php echo ($f["th_pricetotal"]); ?></span></span>
            </div>
        </div>
        <!--con e-->
    </div><?php endforeach; endif; else: echo "" ;endif; ?>


<!--content e-->
<!--footer s-->
<div class="but clearfix">
    <button class="fl">
        <span>全部</span>
    </button>
    <button class="fl">
        <span>未支付</span>
    </button>
    <button class="fr">
        <span>未出行</span>
    </button>
</div>
<!--footer e-->
</body>
<script src="/station/Public/Home/js/jquery.js"></script>
<script>
    $(document).ready(function(){
        $(".order-list").click(function(){
            var orderid=$(this).attr('orderid');
            window.location.href="order_info?orderid="+orderid;
        });

    });
</script>
</html>