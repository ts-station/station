<?php

namespace Common\Controller;

use Think\Controller;

class BaseController extends Controller {
    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin:*');
        //$_SESSION['user_id']='001';
    }

    //当访问空方法时 跳转默认页面
    public function _empty(){
        $this->redirect("Index/index");
    }

}