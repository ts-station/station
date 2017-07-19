<?php
/**
 * Created by PhpStorm.
 * User: Qihongchuan
 * Date: 2016/4/6
 * Time: 10:42
 * Description: 标签相关方法的封装类
 */

namespace Common\Service;

class MarketTag {

    /**
     * MarketTag constructor.
     */
    public function __construct() {

    }

    /**
     * 返回标签列表 (目前还未定义标签类型，以后可能会对标签按照类型做分类)
     *
     * @param string $type 标签类型
     * @return array
     */
    public static function getTagList($type=''){
        $tagList = S('mkt_tag_list');
        if(!$tagList){
            $tagListData = D('MktTag')->order('tag_id asc')->select();
            $tagList = array();
            foreach($tagListData as $tagData){
                $tagList[$tagData['tag_id']] = $tagData;
            }
            S('mkt_tag_list',$tagList,C('BASIC_CACHE_TIME'));
        }
        if(true or $type != ''){
            // TODO : 筛选出特定的 tag_list
        }else{
            // TODO : 直接返回全部 tag_list
        }
        return $tagList;
    }
}