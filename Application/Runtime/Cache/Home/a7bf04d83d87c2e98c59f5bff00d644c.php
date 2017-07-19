<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en" style="font-size: 100px">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>常用乘车人</title>
    <link rel="stylesheet" href="/station/Public/Home/css/common1.css">
    <link rel="stylesheet" href="/station/Public/Home/less/reder1.css">
</head>
<body>
<!--<div class="header">
    <a href="#" onClick="javascript:history.back(-1);"></a><div>常用乘车人</div>
</div>-->
<header class="w">
    <a href="#" onClick="javascript:history.back(-1);">&lt;</a>
    <span>常用乘车人</span>
</header>

<button class="btn-add">
    <span></span><span>新增常用联系人</span><span></span>
</button>

<div class="cont">
    <ul>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><li>
                 <span>
                    <div><?php echo ($f['cpm_purchasername']); ?></div>
                    <div>身份证：<?php echo ($f['cpm_card']); ?></div>
                </span>
                <span class="edit" value="<?php echo ($f['cpm_id']); ?>"></span>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
</body>
<script src="/station/Public/Home/js/common.js"></script>
<script src="/station/Public/Home/js/jquery.js"></script>
<script>
    $(document).ready(function(){
        $(".btn-add").click(function(){
            window.location.href="../customer/add_purchaser_member";
        });
        $(".edit").click(function(){
            var id=$(this).attr('value');
            window.location.href="../customer/add_purchaser_member?id="+id;
        });
    });
</script>
</html>