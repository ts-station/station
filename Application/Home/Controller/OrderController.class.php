<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class OrderController extends BaseController
{

	/**
	 *  常用乘车人列表
	 */
	public function purchaser_member_list()
	{
		$CustomerID = $_SESSION['user_id'];
		$page = I("page");
		$page_size = I("page_size");
		if (empty($page)) {
			$page = 1;
		}
		if (empty($page_size)) {
			$page_size = 10;
		}
		$data = M('Customerpurchasermember')->where(array('cpm_CustomerID' => $CustomerID))->select();
		//echo  M('Customerpurchasermember')->getLastSql();
		//var_dump($data);
		$this->assign('list',$data);
		$this->display();
	}
	/**
	 *  添加乘客
	 *  uid :用户id
	 *  name ：乘车人姓名
	 *  type ：证件类型
	 *  card ：证件号
	 *  tel ：手机号
	 */
	public function add_passenger(){
		$CustomerID = $_SESSION['user_id'];
		$passenger = I("passenger");
		$page = I("page");
		$page_size = I("page_size");
		if (empty($page)) {
			$page = 1;
		}
		if (empty($page_size)) {
			$page_size = 10;
		}
		$passenger_arr=array();
		if($passenger){
			$passenger_arr=explode(',',$passenger);
		}

		$data = M('Customerpurchasermember')->where(array('cpm_CustomerID' => $CustomerID))->select();

		$this->assign('passenger_arr',$passenger_arr);
		$this->assign('runsid',I("runsid"));
		$this->assign('runsdate',I("runsdate"));
		$this->assign('list',$data);
		$this->display();
	}

	/**
	 *  提交订单
	 *  uid :用户id
	 *  cpm_id ：乘车人ID，逗号隔开
	 *  type ：证件类型
	 *  card ：证件号
	 *  Tel ：手机号
	 */
	public function order()
	{
		if (IS_POST) {
			$CustomerID = I('uid');
			$cpm_id = I('cpm_id');
			$name = I('name');
			$tel = I('tel');
			if (empty($CustomerID)) {
				$this->ajaxReturn(array('errcode' => -1, 'message' => '用户ID不能为空'));
			}
			if (empty($cpm_id)) {
				$this->ajaxReturn(array('errcode' => -1, 'message' => '乘车人不能为空'));
			}
			if (empty($name)) {
				$this->ajaxReturn(array('errcode' => -1, 'message' => '取票人不能为空'));
			}
			if (empty($tel)) {
				$this->ajaxReturn(array('errcode' => -1, 'message' => '取票人电话不能为空'));
			}
			$data = array(
					'th_Name' => $name,
					'th_Tel' => $tel,
					'th_CustomerID' => $CustomerID,
			);
			$re = M('Order')->add($data);
			//echo $re;
			$cpm_id_arr = explode(',', $cpm_id);

		}
		$this->display();
	}

	public function edit_order(){
		$runsid = I('runsid');
		$runsdate = I('runsdate');
		$passenger = I('passenger');
		if(empty($passenger)){
			$passenger=0;
		}
		$info = D('Ticketmodel')->info($runsid, $runsdate);
		$line_info=M('Lineinfo')->where(array('li_LineID'=>$info['tml_lineid']))->find();
		//$line_info=M('Lineinfo')->where(array('li_LineID'=>$info['tml_lineid']))->select();
		//var_dump($line_info);
		$passenger_list=array();
		if($passenger) {
			$map['cpm_ID'] = array('in', $passenger);
			$passenger_list = M('Customerpurchasermember')->where($map)->select();
		}
		//var_dump($passenger_list);
		$this->assign('passenger_list',$passenger_list);
		$this->assign('num',count($passenger_list));
		$this->assign('runsid',$runsid);
		$this->assign('runsdate',$runsdate);
		$this->assign('passenger',$passenger);
		$this->assign('info',$info);
		$this->assign('line_info',$line_info);
		$this->display();
	}
	public function pay(){
		$ops=I('');
		$CustomerID = $_SESSION['user_id'];
		$runsid = $ops['runsid'];
		$runsdate = $ops['runsdate'];
		$passenger = $ops['passenger'];
		$price = $ops['price'];
		$name = $ops['name'];
		$tel = $ops['tel'];
		$passenger_arr=explode(',',$passenger);
		$info = D('Ticketmodel')->info($runsid, $runsdate);
		$order_info= D('Order')->order('th_ID desc')->find();
		//var_dump($order_id);
		$order_info_id=$order_info['th_id']+1;

		$th_OrderID = date('YmdHis').$order_info_id;
		$data=array(
			'th_OrderID'=>$th_OrderID,
			'th_Name'=>$name,
			'th_Tel'=>$tel,
			'th_PriceTotal'=>$price,
			'th_CustomerID'=>$CustomerID,
			'th_NoOfRunsID'=>$runsid,
			'th_NoOfRunsdate'=>$runsdate,
			'th_Date'=>time(),
		);
		//var_dump($data);
		$order_id=D('Order')->add($data);

		foreach($passenger_arr as $k=>$v){
			$data_pur=array(
				'cp_CustomerID'=>$v,
				'cp_TicketID'=>0,  //无用
				'cp_AddDate'=>time(),
				'cp_OrderID'=>$order_id,
			);
			D('Customerpurchaser')->add($data_pur);
		}
		$this->assign('order_id',$order_id);
		/*$this->assign('info',$info);
		$this->assign('price',$price);
		$_SESSION['order_id']=date('YmdHis').$order_info_id;
		$_SESSION['info']=$info;
		$_SESSION['price']=$price;
		$_SESSION['order_id']=$th_OrderID;
		$_SESSION['o_id']=$order_id;*/

		/*$openId = '';
		$jsApiParameters = wxpay($openId,'江南极客',date('YmdHis'),100,1);
		$this->assign(array(
				'data' => $jsApiParameters
		));*/

		$this->display();
		//$this->redirect('payment');
	}
	public function payment(){
		$order_id=I('order_id');

		$order = D('Customerpurchaser')->where(array('cp_OrderID'=>$order_id))->find();
		$order_info = D('Order')->where(array('th_ID'=>$order_id))->find();
		//var_dump($order_info);
		$this->assign('order_id',$order_info['th_orderid']);
		$this->assign('price',$order_info['th_pricetotal']);
		$this->assign('o_id',$order_id);


		$time = $order['cp_adddate'];
		$last = $time + 5*60 - time();
		$last = $last>0?$last:0;
		$m = $last/60;
		$s = $last%60;
		$this->assign('m',(int)$m);
		$this->assign('s',$s);
		$this->assign('data',time());

		$openId = '';
		$jsApiParameters = wxpay($openId,'江南极客',$order_info['th_orderid'],$order_info['th_pricetotal']*100,1);
		$this->assign(array(
				'data' => $jsApiParameters
		));

		$this->display();
	}
	/**
	 *  订单列表
	 */
	public function order_list(){
		$CustomerID = $_SESSION['user_id'];
		$order_list=D('Order')->alias('o')
				->where(array('o.th_CustomerID'=>$CustomerID))
				->join('JOIN ts_Ticketmodel AS t ON o.th_NoOfRunsID = t.tml_NoOfRunsID AND o.th_NoOfRunsdate = t.tml_NoOfRunsdate')
				->order('th_ID desc')
				->page(1,10)
				->select();
		//var_dump($order_list);
		//var_dump($order_list);
		//echo $order_list[0]['th_date']-500;
		foreach($order_list as $k =>$v){
			if((time()-$v['th_date'])>5*60&&$v['th_status']==0){
				M('Order')->where(array('th_ID'=>$v['th_id']))->save(array('th_Status'=>1));
			}
		}

		$this->assign('order_list',$order_list);
		$this->display();
	}
	/**
	 *  订单详情
	 */
	public function order_info()
	{
		$orderid = I('orderid');
		$order_info = D('Order')->alias('o')
				->where(array('o.th_ID' => $orderid))
				->join('JOIN ts_Ticketmodel AS t ON o.th_NoOfRunsID = t.tml_NoOfRunsID AND o.th_NoOfRunsdate = t.tml_NoOfRunsdate')
				->find();
		$purchaser_list = D('Customerpurchaser')->alias('p')
				->where(array('p.cp_OrderID' => $orderid))
				->join('JOIN ts_CustomerPurchaserMember AS m ON p.cp_CustomerID = m.cpm_ID')
				->select();
		$time = $purchaser_list[0]['cp_adddate'];
		$last = $time + 5 * 60 - time();
		$last = $last > 0 ? $last : 0;
		$m = $last / 60;
		$s = $last % 60;
		$this->assign('m', (int)$m);
		$this->assign('s', $s);
		//var_dump($order_info);
		//var_dump($purchaser_list);
		$this->assign('order_info', $order_info);
		$this->assign('purchaser_list', $purchaser_list);
		if ($order_info['th_status'] == 0) {
			$this->display();
		}
		else{
			$this->display('order_details');
		}


	}

	//支付超时 0为未支付 1为支付超时  2为已支付
	public function time_up(){
		$orderid = I('orderid');
		//echo $orderid;
		$data = array('th_Status'=>1);
		D('Order')->where(array('th_ID'=>$orderid))->save($data);
		$this->redirect('order_list');
	}









}//class end
