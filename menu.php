<?php
header("Content-type: text/html; charset=utf-8");
define("ACCESS_TOKEN", "8Aqqow_SmF3hHyIFAkVQDNkv-tJkONEKK4gdBZ8AWJzjEK027ICWRgvc4aLBCrboi1ZFCvzoAnzeh078nC4lhY-ox7CUQMaXP4kb64CgoRCLGoP5TRyt96z9TV81CpCVMCAhADAHXV");


//创建菜单
function createMenu($data){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".ACCESS_TOKEN);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tmpInfo = curl_exec($ch);
if (curl_errno($ch)) {
  return curl_error($ch);
}

curl_close($ch);
return $tmpInfo;

}

//获取菜单
function getMenu(){
return file_get_contents("https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".ACCESS_TOKEN);
}

//删除菜单
function deleteMenu(){
return file_get_contents("https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".ACCESS_TOKEN);
}





$data = '{
     "button":[
     {
           "name":"汽车票",
           "sub_button":[
            {
               "type":"view",
               "name":"我要买票",
               "url":"http://www.huxiaohui.xyz/ThinkPHP/home/login/fn_system_edit"
            },
            {
               "type":"view",
               "name":"个人中心",
               "url":"http://huxiaohui.xyz/thinkphp/home/login/fn_system"
            }]
       },
      {
           "type":"click",
           "name":"我要旅游",
           "key":"introduct"
      },
      {
           "name":"城际拼车",
           "sub_button":[
            {
               "type":"click",
               "name":"城际拼车",
               "key":"V1001_HELLO_WORLD"
            },
            {
               "type":"click",
               "name":"拼车订单",
               "key":"V1001_GOOD"
            }]
       }]
}';




echo createMenu($data);
//echo getMenu();
//echo deleteMenu();