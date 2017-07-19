<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class SiteController extends BaseController {

	/**
	 *  站点信息
	 */
	public function index(){
		$list=D('Siteset')->getSite();
		$data=array();
		foreach($list as $k=>$v){
			$arr=array(
				'id'=>$v['sset_operatecode'],
				'name'=>$v['sset_sitename'],
			);
			$data[]=$arr;
		}
		$this->ajaxReturn(array('errcode' => 0, 'message' => '成功','data'=>$data));
	}

	public function ticketmodel(){
		$list=D('Ticketmodel')->getTicketModel();
		//var_dump($list);
		$this->ajaxReturn($list);
	}






}//class end
