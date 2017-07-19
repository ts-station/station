/**
 * Created by Administrator on 2017/5/24.
 */
$(function () {
    var cardTypeValue;

    $('#demo_inp1').calendar();
    //点击切换：
    $(".select-box>.w>ul>li").on("click",function () {
        //console.log($(this));
        $(this).find("a").addClass("select-box-ed");
        $(this).siblings().children("a").removeClass("select-box-ed");
        //console.log($(this).find("a").html());
        if($(this).find("a").html()=="儿童"){
            //console.log(1);
            $(".select-con-1").css("display","none");
            $(".select-con-2").css("display","block");
        }else{
            $(".select-con-1").css("display","block");
            $(".select-con-2").css("display","none");
        }
    })
    $("#cardType").on("click",function () {
        $(".adult-alert").slideDown(500);
    })
    $(".adult-alert").on("click",function () {
        $(this).slideUp(500);
    })
    $(".adult-alert").find("#clear-alert").on("click",function () {
        $(".adult-alert").slideUp(500);
    })
    $(".adult-alert").find("li").on("click",function(e){
        e.preventDefault();
        e.stopPropagation();
        //console.log($(this).html());
        cardTypeValue=$(this).html();
        $("#cardType").html(cardTypeValue);
    })

    
    
    
    
    
    
});