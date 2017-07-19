<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en" style="font-size: 100px;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>班次查询</title>
    <link rel="stylesheet" href="/station/Public/Home/css/common1.css">
    <!--标准mui.css-->
    <link rel="stylesheet" href="/station/Public/Home/css/mui.min.css">
    <!--App自定义的css-->
    <link rel="stylesheet" type="text/css" href="/station/Public/Home/css/app.css"/>
    <link href="/station/Public/Home/css/mui.picker.css" rel="stylesheet"/>
    <link href="/station/Public/Home/css/mui.poppicker.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/station/Public/Home/less/index.css">
    <style>
    </style>
</head>
<body>


<header>
    <p class="banxin">请选择出发时间</p>
    <a href="#" class="banxin" id="">
        <span></span>
        <span id='showUserPicker' type='button'  style='margin-left:0.6rem;'></span>
        <span></span>
    </a>
</header>

<div class="coten">
    <div>
        <div class="banxin" id="depart">
            <p>选择出发城市</p>
            <a href="#">
                <span></span><span id="departText">紫阳</span><span></span>
            </a>
        </div>
    </div>
    <div>
        <div class="banxin" id="arrive">
            <p>选择到达城市</p>
            <a href="#">
                <span></span><span id="arriveText">紫阳</span><span></span>
            </a>
        </div>
    </div>
</div>
<form action="result_search" method="post">
    <input type="text" name="time" value="2017-02-18" style="display: none" id="time">
    <input type="text" name="begin" value="001" style="display: none" id="begin">
    <input type="text" name="end" value="001" style="display: none" id="end">
    <input type="submit" value="查 询" style="display: none" id="search-submit">
</form>
<button class="refer" id="search-button">查 询</button>

<a class="feater" href="#">
    <div class="banxin">
        <div></div>
        <div>江西、陕西开始执行实名制购物票...</div>
    </div>
</a>


</body>
<!--等比适配js-->
<script src="/station/Public/Home/js/common.js"></script>
<!--<script src="js/jquery.js"></script>-->
<script src="/station/Public/Home/js/mui.min.js"></script>
<script src="/station/Public/Home/js/mui.picker.js"></script>
<script src="/station/Public/Home/js/mui.poppicker.js"></script>
<script>
    function addDate(date, days) {
        var d = new Date(date);
        d.setDate(d.getDate() + days);
        var m = d.getMonth() + 1;
        return d.getFullYear() + '-' + m + '-' + d.getDate();
    }

    (function ($, doc) {
        $.init();
        $.ready(function () {
            //普通示例
            var dtPicker = new $.PopPicker();
            var data = [];

            //选择时间第一天是今天则i=0;若选择时间第一天是明天，则i=1,i<31
            for (var i = 0; i < 30; i++) {
                var obj = {};
                obj.text = addDate(new Date(), +i);
                data.push(obj);
            }
            //时间选择
            dtPicker.setData(data);
            var showUserPickerButton = doc.getElementById('showUserPicker');
            var showUserPicker = doc.getElementById('showUserPicker');

            showUserPicker.innerHTML = addDate(new Date(), +0)
            showUserPickerButton.addEventListener('tap', function (event) {
                dtPicker.show(function (items) {
                    showUserPicker.innerHTML = items[0].text;
                });
            }, false);


            //出发城市
            var userDepart = new $.PopPicker();
            userDepart.setData(
                    <?php echo ($site_list); ?>
                    /*[{
                value: 'lzn',
                text: '泸州南南'
            }, {
                "value": "001",
                "text": "紫阳"
            }, {
                "value": "002",
                "text": "安康"
            }, {
                "value": "003",
                "text": "西安"
            }]*/);
            var depart = doc.getElementById('depart');
            var departText = doc.getElementById('departText');
            depart.addEventListener('tap', function (event) {
                userDepart.show(function (items) {
                    departText.innerText = items[0].text;
                    //返回 false 可以阻止选择框的关闭
                    //return false;
                    document.getElementById("begin").setAttribute("value", items[0].value);
                });
            }, false);
//
//
//            //到达城市
            var userArrive = new $.PopPicker();
            userArrive.setData(
                    <?php echo ($site_list); ?>

                    /*[{
                value: 'cdb',
                text: '成都北北'
            },{
               'value': "001",
               'text': "紫阳"
            }, {
                'value': "002",
                'text': "安康"
            }, {
                'value': "003",
                'text': "西安"
            }]*/);
            var arrive = doc.getElementById('arrive');
            var arriveText = doc.getElementById('arriveText');
            arrive.addEventListener('tap', function (event) {
                userArrive.show(function (items) {
                    arriveText.innerText = items[0].text;
                    //返回 false 可以阻止选择框的关闭
                    //return false;
                    document.getElementById("end").setAttribute("value", items[0].value);
                });
            }, false);
//
        });
    })(mui, document);

    var search_button = document.getElementById("search-button");
    var search_submit = document.getElementById("search-submit");
    search_button.onclick = function() {
        search_submit.click();
    }

</script>
</html>