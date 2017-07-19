<?php
/**
 * Created by PhpStorm.
 * User: Qihongchuan
 * Date: 2016/3/17
 * Time: 10:39
 * Description: 交易动态
 */

namespace Common\Service;

class TradeInfo {


    // 按照指定顺序，获取指定数量的交易动态信息数据
    static public function tradeInfoList($count=20) {
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        if($count <= 0){ $count = 0; }
        $tradeInfoArr = S('trade_info__top_'.$count);
        if(!$tradeInfoArr){
            $tradeInfoMod = D('TradeInfo');
            $tradeInfoArr = $tradeInfoMod->where("info_type='TRADE_INFO'")->order('show_time DESC')->limit($count)->select();
            foreach($tradeInfoArr as $key => $item ){
                switch($item['trade_status']){
                    case '洽谈中':
                        $tradeInfoArr[$key]['css_class'] = 'negotiating';
                        break;
                    case '正在交易':
                        $tradeInfoArr[$key]['css_class'] = 'dealing';
                        break;
                    case '交易成功':
                        $tradeInfoArr[$key]['css_class'] = 'success';
                        break;
                }
            }
            S('trade_info__top_'.$count,$tradeInfoArr,$ttl);
        }
        return $tradeInfoArr;
    }

}