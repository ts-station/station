<?php

/**
 * Created by PhpStorm.
 * User: Qihongchuan
 * Date: 2016/2/23
 * Time: 17:33
 * Description:
 */
namespace Home\Model;
use Think\Model;

class SitesetModel extends Model {
    public function getSite(){
        $list=$this->select();
        return $list;
    }
}