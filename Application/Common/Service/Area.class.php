<?php
/**
 * Created by PhpStorm.
 * User: Qihongchuan
 * Date: 2016/03/04
 * Time: 15:24
 * Description: 地区数据的封装类
 */

namespace Common\Service;

class Area {

    public $ok = '';                     // OK表示是一个存在的area
    public $area_type = array();         // 区域类型：PROVINCE / CITY
    public $province_key = array();      // 省key
    public $province_name = array();     // 省name
    public $province_list = array();     // 省下拉项
    public $city_key = array();          // 市key
    public $city_name = array();         // 市name
    public $city_list = array();         // 市下拉项

    /**
     * 构造函数：初始化area类
     *
     * @param string $area_key 区域的key
     */
    function __construct($area_key=null) {
        if (empty($area_key)) {
            $this->ok = true;
            $this->area_type = 'COUNTRY';
            $this->province_list = Area::getProvinceList();
        } else {
            if (strlen($area_key) == 6) {
                if (substr($area_key, 2) == '0000') {        // 省
                    $province_list = static::getProvinceList();
                    $result = $province_list[$area_key];
                } else {                                    // 市
                    $city_list = static::getAllCityList();
                    $result = $city_list[$area_key];
                }
                if ($result) {
                    $this->ok = true;
                    $this->area_type = $result['area_type'];
                    $this->province_key = $result['province_key'];
                    $this->province_name = $result['province_name'];
                    $this->province_list = Area::getProvinceList();
                    $this->city_key = $result['city_key'];
                    $this->city_name = $result['city_name'];
                    $this->city_list = Area::getCityList($result['province_key']);
                }
            }
        }
    }

    /**
     * @return array 返回所有省级区域数据
     */
    static function getProvinceList() {
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $resultArr = S('area__province_list');
        if (!$resultArr) {
            $areaMod = D('area');
            $tmpArr = $areaMod->where("area_type='PROVINCE'")->select();
            foreach($tmpArr as $province){
                $resultArr[$province['province_key']] = $province;
            }
            S('area__province_list',$resultArr,$ttl);
        }
        return $resultArr;
    }

    /**
     * @return array 返回所有市级区域数据
     */
    static function getAllCityList() {
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $resultArr = S('area__all_city_list');
        if (!$resultArr) {
            $areaMod = D('area');
            $tmpArr = $areaMod->where("area_type='CITY'")->select();
            foreach($tmpArr as $city){
                $resultArr[$city['city_key']] = $city;
            }
            S('area__all_city_list',$resultArr,$ttl);
        }
        return $resultArr;
    }

    /**
     * @param $province_key
     * @return array 根据省级区域的key，返回该省的所有市级区域数据
     */
    static function getCityList($province_key) {
        $resultArr = array();
        foreach(static::getAllCityList() as $city_key => $city){
            if($city['province_key'] == $province_key){
                $resultArr[$city_key] = $city;
            }
        }
        return $resultArr;
    }


    public static function getCity() {
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        if (!S('city')) {
            $city = D('area')->field('city_key,city_name')->select();
            S('city', $city, $ttl);
        } else {
            $city = S('city');
        }
        $result = array();
        foreach ($city as $k => $v) {
            $result[$v['city_key']] = $v['city_name'];
        }
        return $result;
    }

    public static function getProvince() {
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        if (!S('province')) {
            $province = D('area')->field('province_key,province_name')->group('province_key')->select();
            S('province', $province, $ttl);
        } else {
            $province = S('province');
        }
        $result = array();
        foreach ($province as $k => $v) {
            $result[$v['province_key']] = $v['province_name'];
        }
        return $result;
    }
}
