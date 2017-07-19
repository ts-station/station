<?php

if(file_exists(CONF_PATH."cache-config.php")){
    $cache_config = include CONF_PATH."cache-config.php";
}else{
    $cache_config = array();
}

$basic_config = array(
    //'配置项'=>'配置值'

    /* 数据库设置 */
    'DB_TYPE'               =>  'sqlsrv',     // 数据库类型
    //'DB_HOST'               =>  '192.168.2.62', // 服务器地址
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    //'DB_HOST'               =>  'HXH\SQLEXPRESS', // 服务器地址
    'DB_NAME'               =>  '1000da',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'TS2017station',          // 密码
    'DB_PORT'               =>  '1433',        // 端口
    //'DB_PORT'               =>  '3310',        // 端口
    'DB_PREFIX'             =>  'ts_',    // 数据库表前缀

    'URL_HTML_SUFFIX'       =>  '',  // URL伪静态后缀设置
    'TMPL_TEMPLATE_SUFFIX'  => '.html',  // 默认模板文件后缀
    'DEFAULT_MODULE'        =>  'Home',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称

    'AppID'                 =>'wx7a6f30cb15ed2e41',     //开发者ID
    'AppSecret'             =>'7f8c6005dd823917a61d55075c8791bd',   //开发者密码
    'Token'                 =>'weixin',                   //令牌

    // 自定义设置
    "AUTHCODE" => 'd62K5x7AWz1sB37PD8',//后台登录引用的秘钥,请不要随意更改
    // "TMPL_EXCEPTION_FILE"=>"404.html",
    'URL_CASE_INSENSITIVE'  =>  false,
    'CORD_SAVE_TIME'        =>  120,//手机验证码生存周期
    'show_page_trace'=>false,

);
return array_merge($basic_config,$cache_config);
