<?php

namespace Common\Service;

class Goods {

    // 完善产品的数据
    static public function fillGoodsData($goodsArray){
        if($goodsArray){
            $Category = new Category();
            $allCates = $Category->getCates();
            $Meta = new Meta();
            $allMeta = $Meta->getAllMeta();
            $areas = Area::getAllCityList();
            $tagList = MarketTag::getTagList();

            foreach($goodsArray as &$goods){
                if(isset($goods['cate_id'])){ $goods['cate_name'] = $allCates[$goods['cate_id']]['name']; }
                if(isset($goods['technology'])){ $goods['technology'] = $allMeta[$goods['technology']]['meta_value']; }
                if(isset($goods['purpose'])){ $goods['purpose'] = $allMeta[$goods['purpose']]['meta_value']; }
                if(isset($goods['origin_addr'])){ $goods['origin_addr'] = $areas[$goods['origin_addr']]['province_name'] .' '. $areas[$goods['origin_addr']]['city_name']; }
                if(isset($goods['mkt_tag'])){
                    $goods['tag_show_name'] = $tagList[$goods['mkt_tag']]['show_name'];
                    $goods['tag_show_style'] = $tagList[$goods['mkt_tag']]['show_style'];
                }
            }
        }
        return $goodsArray;
    }

    // 更新产品价格到产品历史记录表中
    static public function update_supply_price($goods_id,$new_price){
        $data = array(
            'goods_id'      =>  $goods_id,
            'rec_type'      =>  'GOODS_PRICE',
            'price'         =>  floatval($new_price),
            'update_time'   =>  time(),
        );
        if(!D('GoodsHistory')->data($data)->add()){
            //TODO : 记录错误日志
        };
    }

    // 更新产品库存到产品历史记录表中
    static public function update_supply_count($goods_id,$new_count){
        $data = array(
            'goods_id'      =>  $goods_id,
            'rec_type'      =>  'GOODS_COUNT',
            'count'         =>  floatval($new_count),
            'update_time'   =>  time(),
        );
        if(!D('GoodsHistory')->data($data)->add()){
            //TODO : 记录错误日志
        };
    }

}