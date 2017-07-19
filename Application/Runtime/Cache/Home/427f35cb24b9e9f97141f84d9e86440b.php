<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en" style="font-size: 100px">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>班次查询结果</title>
    <link rel="stylesheet" href="/station/Public/Home/css/common1.css">
    <link rel="stylesheet" href="/station/Public/Home/less/demand.css">
</head>
<body>
    <div class="header">
        <a href="#" onClick="javascript:history.back(-1);">&lt;</a>
        <div class="banxin header-t">
            <div>
                <p>泸州-成都</p>
            </div>
        </div>
        <div class="banxin header-b">
            <button class="fl">前一天</button><button><span></span>08月08日<span>今日</span></button><button class="fr">后一天</button>
        </div>
    </div>

    <div class="cont">
        <ul class="have">

            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i; if($f['leave_seats']): ?><li runsid="<?php echo ($f['runsid']); ?>" runsdate="<?php echo ($f['runsdate']); ?>" class="ticket-add">
                        <div class="banxin">
                            <div><?php echo ($f['time']); ?></div>
                            <div>
                                <div>
                                    <span></span>
                                    <span><?php echo ($f['begin']); ?></span>

                                </div>
                                <div>
                                    <span></span>
                                    <span><?php echo ($f['busmodel']); ?></span>
                                </div>
                            </div>
                            <div>
                                <span><?php echo ($f['leave_seats']); ?>张</span>
                                <span></span>
                                <span>固定班267</span>
                                <span>携童3张</span>
                            </div>
                            <div>
                                <div>
                                    <span></span>
                                    <span><?php echo ($f['end']); ?></span>
                                </div>
                                <div>
                                    <span>¥</span>
                                    <span><?php echo ($f['price']); ?></span>
                                </div>
                            </div>
                        </div>
                    </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>

        </ul>
        <ul class="none">
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i; if(!$f['leave_seats']): ?><li>
                        <div class="banxin">
                            <div><?php echo ($f['time']); ?></div>
                            <div>
                                <div>
                                    <span></span>
                                    <span><?php echo ($f['begin']); ?></span>

                                </div>
                                <div>
                                    <span></span>
                                    <span><?php echo ($f['busmodel']); ?></span>
                                </div>
                            </div>
                            <div>
                                <span>已售完</span>
                                <span></span>
                                <span>固定班267</span>
                                <span>携童3张</span>
                            </div>
                            <div>
                                <div>
                                    <span></span>
                                    <span><?php echo ($f['end']); ?></span>
                                </div>
                                <div>
                                    <span>¥</span>
                                    <span><?php echo ($f['price']); ?></span>
                                </div>
                            </div>
                        </div>
                    </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <li>
                <div class="banxin">
                    <div>07:00</div>
                    <div>
                        <div>
                            <span></span>
                            <span>泸州南</span>

                        </div>
                        <div>
                            <span></span>
                            <span>大型高一</span>
                        </div>
                    </div>
                    <div>
                        <span>已售完</span>
                        <span></span>
                        <span>固定班267</span>
                    </div>
                    <div>
                        <div>
                            <span></span>
                            <span>成都北</span>
                        </div>
                        <div>
                            <span>¥</span>
                            <span>290</span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="but">
        <button class="fl">
            <span></span>
            <span>发车</span>
        </button><button class="fr">
            <span></span>
            <span>票价</span>
    </button>
    </div>
</body>
<script src="/station/Public/Home/js/common.js">
</script><script src="/station/Public/Home/js/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#button1").click(function(){
            $("#list-type").val(0);
            $("#search-submit").click();
        });
        $("#button2").click(function(){
            $("#list-type").val(1);
            $("#search-submit").click();
        });
        $(".ticket-add").click(function(){
            var runsid=$(this).attr('runsid');
            var runsdate=$(this).attr('runsdate');
            window.location.href="../order/edit_order?runsid="+encodeURIComponent(runsid)+"&runsdate="+runsdate;
        });

    });

</script>
</html>