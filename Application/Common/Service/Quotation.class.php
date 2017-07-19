<?php
/**
 * Created by PhpStorm.
 * User: Qihongchuan
 * Date: 2016/3/10
 * Time: 9:02
 * Description:
 */

namespace Common\Service;

class Quotation {


    // 完善报价单的数据
    static public function fillQuotationData($quotationArray){
        if($quotationArray){
            $areas = Area::getAllCityList();
            $Meta = new Meta();
            $business_model_items = $Meta->getBusinessModel();
            foreach($quotationArray as &$quotation){
                $quotation['supply_addr'] = $areas[$quotation['supply_addr']]['province_name'].' '.$areas[$quotation['supply_addr']]['city_name'];
                $quotation['business_model'] = $business_model_items[$quotation['business_model']]['meta_value'];
            }
        }
        return $quotationArray;
    }

}