(function () {
    var html = document.getElementsByTagName('html')[0];
    /*取到屏幕的宽度*/
    var width = window.innerWidth;
    /* 640 100  320 50 */
    var fontSize = 100/750*width;
    /*设置fontsize*/
    html.style.fontSize = fontSize +'px';
//调整页面尺寸大小
    window.onresize = function(){
        var html = document.getElementsByTagName('html')[0];
        /*取到屏幕的宽度*/
        var width = window.innerWidth;
        /* 640 100  320 50 */
        var fontSize = 100/750 * width;
        /*设置fontsize*/
        html.style.fontSize = fontSize +'px';
    }
})()