<?php
/**
 * Created by PhpStorm.
 * User: Qihongchuan
 * Date: 2016/2/23
 * Time: 15:24
 * Description: 元数据相关方法的封装类
 */

namespace Common\Service;


class Meta{



    /**
     * 获取所有属性可选项
     *
     * @return array        数据数组
     */
    public function getAllMeta(){
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $metaMod = D('Meta');
        // TODO: 应该获取缓存剩余时间，然后和$ttl参数比较，如果比$ttl大，应该重新设置缓存有效期
        $resultArr = S('goods_meta__all_meta');
        if(!$resultArr){
            $dataArr = $metaMod->order('sort asc, meta_id asc')->field('meta_id,meta_value')->select();
            if($dataArr){
                foreach($dataArr as $data){
                    $resultArr[$data['meta_id']] = $data;
                }
            }
            S('goods_meta__all_meta',$resultArr,$ttl);
        }
        return $resultArr;
    }

    /**
     * YARN_COUNT -- 获取产品纱支属性可选项
     *
     * @return array        数据数组
     */
    public function getYarnCount(){
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $metaMod = D('Meta');
        $resultArr = S('goods_meta__yarn_count');
        if(!$resultArr){
            $resultArr = array();
            $dataArr = $metaMod->where('meta_type=:meta_type')->bind(':meta_type','YARN_COUNT')->order('sort asc, meta_id asc')->select();
            if($dataArr){
                foreach($dataArr as $data){
                    $resultArr[$data['meta_id']] = $data;
                }
            }
            S('goods_meta__yarn_count',$resultArr,$ttl);
        }
        return $resultArr;
    }

    /**
     * STRANDS_WIRE -- 产品股线属性可选项；
     *
     * @return array        数据数组
     */
    public function getStrandsWire(){
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $metaMod = D('Meta');
        $resultArr = S('goods_meta__strands_wire');
        if(!$resultArr){
            $resultArr = array();
            $dataArr = $metaMod->where('meta_type=:meta_type')->bind(':meta_type','STRANDS_WIRE')->order('sort asc, meta_id asc')->select();
            if($dataArr){
                foreach($dataArr as $data){
                    $resultArr[$data['meta_id']] = $data;
                }
            }
            S('goods_meta__strands_wire',$resultArr,$ttl);
        }
        return $resultArr;
    }

    /**
     * TECHNOLOGY -- 产品加工工艺属性可选项；
     *
     * @return array        数据数组
     */
    public function getTechnology(){
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $metaMod = D('Meta');
        $resultArr = S('goods_meta__technology');
        if(!$resultArr){
            $resultArr = array();
            $dataArr = $metaMod->where('meta_type=:meta_type')->bind(':meta_type','TECHNOLOGY')->order('sort asc, meta_id asc')->select();
            if($dataArr){
                foreach($dataArr as $data){
                    $resultArr[$data['meta_id']] = $data;
                }
            }
            S('goods_meta__technology',$resultArr,$ttl);
        }
        return $resultArr;
    }

    /**
     * PURPOSE  -- 产品纱线用途属性可选项；
     *
     * @return array        数据数组
     */
    public function getPurpose(){
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $metaMod = D('Meta');
        $resultArr = S('goods_meta__purpose');
        if(!$resultArr){
            $resultArr = array();
            $dataArr = $metaMod->where('meta_type=:meta_type')->bind(':meta_type','PURPOSE')->order('sort asc, meta_id asc')->select();
            if($dataArr){
                foreach($dataArr as $data){
                    $resultArr[$data['meta_id']] = $data;
                }
            }
            S('goods_meta__purpose',$resultArr,$ttl);
        }
        return $resultArr;
    }

    /**
     * YARN_SHAPE  -- 产品成纱形态属性可选项；
     *
     * @return array        数据数组
     */
    public function getYarnShape(){
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $metaMod = D('Meta');
        $resultArr = S('goods_meta__yarn_shape');
        if(!$resultArr){
            $resultArr = array();
            $dataArr = $metaMod->where('meta_type=:meta_type')->bind(':meta_type','YARN_SHAPE')->order('sort asc, meta_id asc')->select();
            if($dataArr){
                foreach($dataArr as $data){
                    $resultArr[$data['meta_id']] = $data;
                }
            }
            S('goods_meta__yarn_shape',$resultArr,$ttl);
        }
        return $resultArr;
    }

    /**
     * YARN_SHAPE  -- 产品成纱形态属性可选项；
     *
     * @return array        数据数组
     */
    public function getUsterNo(){
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $metaMod = D('Meta');
        $resultArr = S('goods_meta__uster_no');
        if(!$resultArr){
            $resultArr = array();
            $dataArr = $metaMod->where('meta_type=:meta_type')->bind(':meta_type','USTER_NO')->order('sort asc, meta_id asc')->select();
            if($dataArr){
                foreach($dataArr as $data){
                    $resultArr[$data['meta_id']] = $data;
                }
            }
            S('goods_meta__uster_no',$resultArr,$ttl);
        }
        return $resultArr;
    }

    /**
     * BUSINESS_MODEL  -- 供应商商业模式可选项；
     *
     * @return array        数据数组
     */
    public function getBusinessModel(){
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $metaMod = D('Meta');
        $resultArr = S('supplier_meta__business_model');
        if(!$resultArr){
            $resultArr = array();
            $dataArr = $metaMod->where('meta_type=:meta_type')->bind(':meta_type','BUSINESS_MODEL')->order('sort asc, meta_id asc')->select();
            if($dataArr){
                foreach($dataArr as $data){
                    $resultArr[$data['meta_id']] = $data;
                }
            }
            S('supplier_meta__business_model',$resultArr,$ttl);
        }
        return $resultArr;
    }

    /**
     * PAYMENT_TYPE  -- 订单支付方式可选项；
     *
     * @return array        数据数组
     */
    public function getPaymentType(){
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $metaMod = D('Meta');
        $resultArr = S('order_meta__payment_type');
        if(!$resultArr){
            $resultArr = array();
            $dataArr = $metaMod->where('meta_type=:meta_type')->bind(':meta_type','PAYMENT_TYPE')->order('sort asc, meta_id asc')->select();
            if($dataArr){
                foreach($dataArr as $data){
                    $resultArr[$data['meta_id']] = $data;
                }
            }
            S('order_meta__payment_type',$resultArr,$ttl);
        }
        return $resultArr;
    }

    /**
     * DELIVERY_TYPE  -- 订单交货方式可选项；
     *
     * @return array        数据数组
     */
    public function getDeliveryType(){
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $metaMod = D('Meta');
        $resultArr = S('order_meta__delivery_type');
        if(!$resultArr){
            $resultArr = array();
            $dataArr = $metaMod->where('meta_type=:meta_type')->bind(':meta_type','DELIVERY_TYPE')->order('sort asc, meta_id asc')->select();
            if($dataArr){
                foreach($dataArr as $data){
                    $resultArr[$data['meta_id']] = $data;
                }
            }
            S('order_meta__delivery_type',$resultArr,$ttl);
        }
        return $resultArr;
    }


    /**
     * ORDER_PROCESS  -- 订单流程环节项；
     *
     * @return array        数据数组
     */
    public function getOrderProcess(){
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $metaMod = D('Meta');
        $resultArr = S('order_meta__order_process');
        if(!$resultArr){
            $resultArr = array();
            $dataArr = $metaMod->where('meta_type=:meta_type')->bind(':meta_type','ORDER_PROCESS')->order('sort asc, meta_id asc')->select();
            if($dataArr){
                foreach($dataArr as $data){
                    $resultArr[$data['meta_key']] = $data;
                }
            }
            S('order_meta__order_process',$resultArr,$ttl);
        }
        return $resultArr;
    }

    /**
     * 获取网站配置信息，如：网站 meta_keywords 等设置；
     *
     * @param string $param
     * @return mixed
     */
    static public function getSiteConfig($param='all'){
        $site_config = S('site_config');
        if(!$site_config) {
            $site_config_data = D('Meta')->where("meta_type='SITE_CONFIG'")->select();
            $site_config = array();
            if ($site_config_data) {
                foreach ($site_config_data as $config) {
                    $site_config[$config['meta_key']] = $config['meta_value'];
                }
            }
            S('site_config', $site_config, C('BASIC_CACHE_TIME'));
        }
        if($param === 'all'){
            return $site_config;
        }else{
            return $site_config[$param];
        }
    }

}