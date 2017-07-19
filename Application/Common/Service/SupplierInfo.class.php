<?php
/**
 * Created by PhpStorm.
 * User: Qihongchuan
 * Date: 2016/3/26
 * Time: 14:27
 * Description:
 */

namespace Common\Service;

class SupplierInfo {


    // 完善供应商的数据
    static public function fillSupplierInfo($supplierArray) {
        if($supplierArray){
            $areas = Area::getAllCityList();
            $Meta = new Meta();
            $business_model_items = $Meta->getBusinessModel();
            foreach($supplierArray as &$supplier){
                $supplier['supply_addr'] = $areas[$supplier['supply_addr']]['province_name'].' '.$areas[$supplier['supply_addr']]['city_name'];
                $supplier['business_model'] = $business_model_items[$supplier['business_model']]['meta_value'];
            }
        }
        return $supplierArray;
    }
}