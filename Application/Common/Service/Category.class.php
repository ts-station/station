<?php
/**
 * Created by PHPStorm.
 * User: Qihongchuan
 * Date: 2016/02/23
 * Time: 17:06
 * Description: 分类相关方法的封装类
 */


namespace Common\Service;

class Category
{
    public $errMessage = '';

    /**
     * 获取所有分类
     * @return array
     */
    public function getCates()
    {
        $ttl = C('BASIC_CACHE_TIME') ? C('BASIC_CACHE_TIME') : 1800 ;
        $resultArr = S('goods_cate__all');
        // $resultArr = array();                     // 调试时，暂时取消注释该行代码，可强制刷新缓存
        if (!$resultArr) {
            $cateMod = D('Cate');
            $catesArr = $cateMod->where('status=1')->order('sort ASC')->select();
            foreach ($catesArr as $cate) {
                $resultArr[$cate['id']] = $cate;
            }
            S('goods_cate__all', $resultArr, $ttl);
        }
        return $resultArr;
    }

    /**
     * 根据分类Id获取分类路径
     *
     * @param int $cate_id 分类Id
     * @param int $maxDepth 最大深度
     * @return array       分类路径数组
     */
    public function getCatePath($cate_id, $maxDepth = 6)
    {
        $cate_id = intval($cate_id);
        if ($cate_id < 0) {
            $this->errMessage = '错误的分类Id';
            return false;
        }
        $allCates = $this->getCates();
        $resultArr = array();
        for (; 0 < $maxDepth; $maxDepth--) {
            $cateInfo = $allCates[$cate_id];
            if (!$cateInfo) {
                break;
            }
            array_unshift($resultArr, $cateInfo);
            $cate_id = $cateInfo['parent_id'];
            if ($cate_id <= 0) {
                break;
            }
        }
        // TODO: 如果数组不为空的情况下，且第一个元素的父元素不是根元素0，应该考虑将整个数组清空
        return $resultArr;
    }

    /**
     * 根据分类Id获取所有子分类数组
     *
     * @param int $cate_id 分类Id
     * @param bool $showHide 是否显示隐藏分类，默认false不显示
     * @return array            子分类信息数组
     */
    public function getSubCates($cate_id, $showHide = false)
    {
        $cate_id = intval($cate_id);
        if ($cate_id < 0) {
            $this->errMessage = '错误的分类Id';
            return false;
        }
        $resultArr = array();
        foreach ($this->getCates() as $cate) {
            if ($cate['parent_id'] == $cate_id) {
                if ($showHide || $cate['status'] == 1) {
                    $resultArr[$cate['id']] = $cate;
                }
            }
        }
        return $resultArr;
    }

    /**
     * 根据分类Id获取所有子分类Id数组(递归获取)；具体实现为非递归方式
     *
     * @param int $cate_id 分类Id
     * @param bool $showHide 是否显示隐藏分类，默认false不显示
     * @param int $maxDepth 最大递归显示深度
     * @return array            子分类数组
     */
    public function getAllSubCatesId($cate_id, $showHide = false, $maxDepth = 6)
    {
        $cate_id = intval($cate_id);
        if ($cate_id < 0) {
            $this->errMessage = '错误的分类Id';
            return false;
        }
        $allCates = $this->getCates();
        $resultArr = array();
        $parentCateArr[$cate_id] = $cate_id;
        if ($cate_id != 0) {  // 如果分类不等于根分类，需要把该分类本身的id也加入；
            $resultArr[$cate_id] = (string)$cate_id;
        }
        for (; $maxDepth > 0; $maxDepth--) {
            $subCatesArr = array();
            foreach ($allCates as $cate) {
                if (in_array($cate['parent_id'], $parentCateArr)) {
                    if ($showHide || $cate['status'] == 1) {
                        $subCatesArr[$cate['id']] = $cate['id'];
                    }
                }
            }
            if (!$subCatesArr) {
                break;
            }
            $resultArr = ($resultArr + $subCatesArr);
            $parentCateArr = $subCatesArr;
        }
        return $resultArr;
    }

    /**
     * 根据顶级分类获取分类树状结构(递归实现)
     *
     * @param int $cate_id 分类Id，默认值为0，表示根分类
     * @param bool $showHide 是否显示隐藏分类，默认false不显示
     * @param int $maxDepth 最大递归深度
     * @return array            子分类嵌套数组
     */
    public function getCatesTree($cate_id = 0, $showHide = false, $maxDepth = 6 )
    {
        $cate_id = intval($cate_id);
        if ($cate_id < 0) {
            $this->errMessage = '错误的分类Id';
            return false;
        }
        // ThinkPHP中根据前缀来删除缓存很不方便；这里因为传入的参数太多，导致缓存键太多，单个删除起来比较麻烦，暂取消缓存该数据
        $CatesList = $this->getCates();
        $resultArr = $this->_getCatesTree($CatesList, $cate_id, $showHide, $maxDepth);
        return $resultArr;
    }

    /**
     * 内部实现：根据顶级分类获取分类树状结构(递归实现)
     *
     * @param array $CatesList 所有分类列表；(因为只读，所以引用传递，节省空间)
     * @param int $cate_id 分类Id
     * @param bool $showHide 是否显示隐藏分类
     * @param int $maxDepth 最大递归深度
     * @return array            子分类嵌套数组
     */
    private function _getCatesTree(&$CatesList, $cate_id, $showHide, $maxDepth)
    {
        $resultArr = array();
        if (--$maxDepth < 0) {
            return $resultArr;
        }
        foreach ($CatesList as $cate) {
            if ($cate['parent_id'] == $cate_id) {
                if ($showHide || $cate['status'] == 1) {
                    $resultArr[$cate['id']] = array(
                        'cate_name' => $cate['name'],
                        'sub_cates' => $this->_getCatesTree($CatesList, $cate['id'], $showHide, $maxDepth),
                    );
                }
            }
        }
        return $resultArr;
    }

    /**
     * 获取分类列表(在分类的原始数据上附带以下字段：1按照分类层级生成的展现时组成前缀缩进的字段)
     *
     * @param int $cate_id 顶级分类id
     * @param int $hide_cate_id 不需要显示的分类(包括子分类)的id，默认值为0，表示没有不需要显示的分类；
     * @param bool $showHide 是否显示隐藏分类
     * @param string $prefix 全局前缀，会添加在每一个分类项前面
     * @return array 分类列表数组
     */
    public function getCatesList($cate_id=0, $hide_cate_id=0,$showHide=false, $prefix='')
    {
        $hide_cate_id = intval($hide_cate_id);
        $cate_id = intval($cate_id);
        if ($hide_cate_id < 0 || $cate_id < 0 ) {
            $this->errMessage = '错误的分类Id';
            return false;
        }
        $catesArr = $this->getcates();
        return $this->_getCatesList($catesArr, $cate_id, $prefix, $hide_cate_id, $showHide);
    }

    /**
     * 内部实现：获取分类列表(在分类的原始数据上附带以下字段：1按照分类层级生成的展现时组成前缀缩进的字段)
     *
     * @param array $catesArr           所有分类数组：未处理
     * @param int $cate_id              顶级分类id
     * @param string $cur_prefix        表示前缀缩进的字符串
     * @param int $hide_cate_id         需要隐藏的分类id
     * @param bool $showHide            是否显示隐藏状态分类(及其子分类)
     * @return array                    所有分类数组：已处理，添加了额外字段
     */
    private function _getCatesList(&$catesArr, $cate_id, $cur_prefix, $hide_cate_id, $showHide)
    {
        // TODO: 缓存的key需要根据传入的参数来综合生成，待完成
        $subCates = array();
        foreach ($catesArr as $cate) {
            if (($cate['parent_id'] == $cate_id) && ($cate['id'] != $hide_cate_id)) {
                if ($showHide || $cate['status'] == 1) {
                    $subCates[$cate['id']] = $cate;
                }
            }
        }
        $catesList = array();
        $subCatesCount = count($subCates);
        $index = 0;
        foreach ($subCates as $item) {
            if ($item['parent_id'] == 0) {
                $icon = '';
                //第一级子分类的子分类缩进空格长度，也即第二级子分类缩进空格的长度，跟其它的略有不同，需单独设置
                $sub_prefix = $cur_prefix . str_repeat('&nbsp;', 3);
            } else { // 其它的子分类缩进空格长度
                if ($index == $subCatesCount - 1) {
                    $icon = "└─";
                    $sub_prefix = $cur_prefix . str_repeat('&nbsp;', 7);
                } else {
                    $icon = "├─";
                    $sub_prefix = $cur_prefix . "│" . str_repeat('&nbsp;', 5);
                }
            }
            $index++;
            $item['prefix'] = $cur_prefix . $icon;
            $catesList[$item['id']] = $item;
            $catesList += $this->_getCatesList($catesArr, $item['id'], $sub_prefix, $hide_cate_id, $showHide);
        }
        return $catesList;
    }

    /**
     * @param array $idsArr 分类id数组
     * @return array    分类名称数组
     */
    public static function getNamesByIds(array $idsArr){
        $resultArr = array();
        if($idsArr){
            $Category = new Category();
            $allCates = $Category->getCates();
            foreach($idsArr as $id){
                $resultArr[$id] = $allCates[$id]['name'];
            }
        }
        return $resultArr;
    }

    //查询所有的顶级分类，没有做缓存处理
    public function allparent(){
        return D('Cate')->field('id,name,lastcat')->where('parent_id=0')->order('sort asc')->select();
    }

}

