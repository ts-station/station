<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en" style="font-size: 100px">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>常用乘车人</title>
    <link rel="stylesheet" href="/station/Public/Home/css/common1.css">
    <link rel="stylesheet" href="/station/Public/Home/less/reder.css">
</head>
<body>
    <header class="w">
        <a href="#" onClick="javascript:history.back(-1);">&lt;</a>
        <span>常用乘车人</span>
        <button class="fr">确认</button>
    </header>

    <button class="btn-add">
        <span></span><span>新增常用联系人</span><span></span>
    </button>

    <div class="cont">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i; if(in_array($f['cpm_id'],$passenger_arr)): ?><ul class="yes">
                <?php else: ?><ul class="no"><?php endif; ?>

            <li class="check-box">
                <span></span>
                <span><?php echo ($f['cpm_purchasername']); ?></span>
                <span><?php echo ($f['cpm_card']); ?></span>
                <input type="text"  value="<?php echo ($f['cpm_id']); ?>" style="display: none" name="passenger[]">
            </li>
            </ul><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</body>
<script src="/station/Public/Home/js/jquery.min.js"></script>
<script src="/station/Public/Home/js/common.js"></script>
<script>
    $(function(){
        $(".btn-add").click(function(){
            window.location.href="../customer/add_purchaser_member";
        });
        $(".check-box").click(function(){
            var class_type=$(this).parent().attr('class');
            if(class_type=='no'){
                $(this).parent().attr('class','yes');
            }
            if(class_type=='yes'){
                $(this).parent().attr('class','no');
            }
        });
        $(".fr").click(function(){
            var aa=0;
            $("input[name='passenger[]']").each(function(index,item) {
                        var class_type = $(this).parent().parent().attr('class');
                        if (class_type == 'yes') {
                            if (aa == 0) {
                                aa = $(this).val();
                            }
                            else {
                                aa = aa + ',' + $(this).val();
                            }
                        }
                    }
            );
            // alert(aa);
            var runsid='<?php echo ($runsid); ?>';
            runsid=encodeURIComponent(runsid);
            var runsdate='<?php echo ($runsdate); ?>';
            window.location.href="edit_order?passenger="+aa+"&runsid="+runsid+"&runsdate="+runsdate;;
        });
    });
</script>
</html>