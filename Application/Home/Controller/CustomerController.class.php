<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class CustomerController extends BaseController {

	/**
	 *  个人信息
	 */
	public function index(){
		//if(empty($_SESSION['user'])){
			//vecho 1111111111111111;
			//header("Location:http://www.huxiaohui.xyz/ThinkPHP/home/index/fn_wx_login");
		//	$this->redirect('../login/index');
		///}else{
			//print_r($_SESSION['user']);
			$this->assign('userinfo',$_SESSION['user']);
		//}
		//$list=D('Siteset')->getSite();
		$this->display();
	}
	/**
	 *  添加常用乘车人
	 *  uid :用户id
	 *  name ：乘车人姓名
	 *  type ：证件类型
	 *  card ：证件号
	 *  tel ：手机号
	 */
	public function add_purchaser_member()
	{
		if (IS_POST) {
			$CustomerID = $_SESSION['user_id'];
			$PurchaserName = I('name');
			$CardType = I('type');
			$Card = I("card");
			$Tel = I("tel");
			$date = I("date");
			//$this->ajaxReturn(array('errcode' => 0, 'message' => '添加成功'));
			if (empty($CustomerID)) {
				//$this->ajaxReturn(array('errcode' => -1, 'message' => '用户ID不能为空'));
			}
			if (empty($PurchaserName)) {
				$this->ajaxReturn(array('errcode' => -1, 'message' => '乘车人不能为空'));
			}
			if ($date) {
				$data = array(
						'cpm_CustomerID' => $CustomerID,
						'cpm_PurchaserName' => $PurchaserName,
						'cpm_Date' => $date,
				);
				M('Customerpurchasermember')->add($data);
				$this->ajaxReturn(array('errcode' => 0, 'message' => '添加成功'));
			}
			if (empty($CardType)) {
				//$this->ajaxReturn(array('errcode' => -1, 'message' => '卡片类型不能为空'));
			}
			if (empty($Card)) {
				$this->ajaxReturn(array('errcode' => -1, 'message' => '证件号不能为空'));
			}
			if (empty($Tel)) {
				$this->ajaxReturn(array('errcode' => -1, 'message' => '手机号不能为空'));
			}
			$data = array(
					'cpm_CustomerID' => $CustomerID,
					'cpm_PurchaserName' => $PurchaserName,
					'cpm_CardType' => $CardType,
					'cpm_Card' => $Card,
					'cpm_Tel' => $Tel,
			);
			$count=M('Customerpurchasermember')->where(array('cpm_Card'=>$Card))->count();
			if($count){
				$this->ajaxReturn(array('errcode' => 0, 'message' => '添加成功'));
			}
			M('Customerpurchasermember')->add($data);
			$this->ajaxReturn(array('errcode' => 0, 'message' => '添加成功'));
		}
		$id = I('id');
		if($id) {

			$data = M('Customerpurchasermember')->where(array('cpm_ID' =>$id))->find();
			//var_dump( $data);
			$this->assign('data', $data);
		}
		$this->display();
	}

}//class $CardType
