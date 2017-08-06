<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class CodeController extends BaseController {

	/**
	 *  二维码
	 */
	public function index(){
		$orderid = I('orderid');
		$order_info = D('Order')->alias('o')
				->where(array('o.th_ID' => $orderid))
				->join('JOIN ts_Ticketmodel AS t ON o.th_NoOfRunsID = t.tml_NoOfRunsID AND o.th_NoOfRunsdate = t.tml_NoOfRunsdate')
				->find();
		$this->assign('info',$order_info);
		$this->display();

	}
}//class end
