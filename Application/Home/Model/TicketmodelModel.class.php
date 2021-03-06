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

class TicketmodelModel extends Model {
    public function getTicketModel(){
        $list=$this->count();
        return $list;
    }
    public function search($BeginStationID,$EndStationID,$NoOfRunsdate,$type,$page,$page_size){
        $order='pd_fullprice asc';
        if($type==1){
            $order='tml_noofrunstime asc';
        }
        else if($type==2){
            $order='tml_noofrunstime desc';
        }
        else if($type==3){
            $order='pd_fullprice asc';
        }
        else if($type==4){
            $order='pd_fullprice desc';
        }
        $map=array(
            't.tml_BeginstationID'=>$BeginStationID,
            't.tml_EndstationID'=>$EndStationID,
            't.tml_NoOfRunsdate'=>$NoOfRunsdate,
        );
        $list=$this->alias('t')
            ->join('LEFT JOIN ts_PriceDetail AS p ON p.pd_NoOfRunsID = t.tml_NoOfRunsID AND p.pd_NoOfRunsdate = t.tml_NoOfRunsdate')
            ->where($map)
            ->order($order)
            ->page($page,$page_size)
            ->select();
        //echo $this->getlastsql();
        return $list;
    }
    public function info($runsid, $runsdate){
        $map=array(
            't.tml_NoOfRunsID'=>$runsid,
            't.tml_NoOfRunsdate'=>$runsdate,
        );
        $info=$this->alias('t')
            ->join('LEFT JOIN ts_PriceDetail AS p ON p.pd_NoOfRunsID = t.tml_NoOfRunsID AND p.pd_NoOfRunsdate = t.tml_NoOfRunsdate')

            ->where($map)
            // ->page($page,$page_size)
            ->find();
        return $info;
    }
}