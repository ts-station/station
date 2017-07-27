<?php
function token()
{
    $token = mt_rand(0,9999).substr(time(),-4).substr(microtime(),2,6).mt_rand(1000,9999).NOW_TIME;
    return sha1($token);
}
/**
 * 微信支付
 * @param  string   $openId 	openid
 * @param  string   $goods 		商品名称
 * @param  string   $attach 	附加参数,我们可以选择传递一个参数,比如订单ID
 * @param  string   $order_sn	订单号
 * @param  string   $total_fee  金额
 */
/**
 * 微信支付
 * @param  string   $openId     openid
 * @param  string   $goods      商品名称
 * @param  string   $attach     附加参数,我们可以选择传递一个参数,比如订单ID
 * @param  string   $order_sn   订单号
 * @param  string   $total_fee  金额
 */
function wxpay($openId,$goods,$order_sn,$total_fee,$attach){
    require_once "./Api/wxpay/lib/WxPay.Api.php";
    require_once "./Api/wxpay/example/WxPay.JsApiPay.php";
    require_once './Api/wxpay/example/log.php';

    $logHandler= new CLogFileHandler(APP_ROOT."/Api/wxpay/logs/".date('Y-m-d').'.log');
    $log = Log::Init($logHandler, 15);

    $tools = new JsApiPay();
    if(empty($openId)) $openId = $tools->GetOpenid();

    $input = new WxPayUnifiedOrder();
    $input->SetBody($goods);                 //商品名称
    $input->SetAttach("test");                  //附加参数,可填可不填,填写的话,里边字符串不能出现空格
    $input->SetOut_trade_no($order_sn);          //订单号
    $input->SetTotal_fee($total_fee);            //支付金额,单位:分
    $input->SetTime_start(date("YmdHis"));       //支付发起时间
    $input->SetTime_expire(date("YmdHis", time() + 600));//支付超时
    $input->SetGoods_tag("test3");
    //$input->SetNotify_url("http://".$_SERVER['HTTP_HOST']."/payment.php");  //支付回调验证地址
    $input->SetNotify_url("http://".$_SERVER['HTTP_HOST']."/payment.php/WexinApi/WeixinPay/notify");
    $input->SetTrade_type("JSAPI");              //支付类型
    $input->SetOpenid($openId);                  //用户openID
    $order = WxPayApi::unifiedOrder($input);    //统一下单

    $jsApiParameters = $tools->GetJsApiParameters($order);

    return $jsApiParameters;
}
