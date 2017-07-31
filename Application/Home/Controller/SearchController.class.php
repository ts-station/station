<?php
namespace Home\Controller;
use Common\Controller\BaseController;
class SearchController extends BaseController {
	/**
	 *  搜索路线
	 *  begin :起点站ID
	 *  end ：终点站ID
	 *  time ：时间
	 *  page ：分页
	 *  page_size ：分页
	 */
	public function runs_search(){
		if (IS_POST) {
			$BeginStationID = I('begin');
			$EndStationID = I('end');
			$NoOfRunsdate = I('time');
			$page = I("page");
			$page_size = I("page_size");
			if (empty($page)) {
				$page = 1;
			}
			if (empty($page_size)) {
				$page_size = 10;
			}
			if (empty($BeginStationID)) {
				$this->ajaxReturn(array('errcode' => -1, 'message' => '发车点不能为空'));
			}
			if (empty($BeginStationID)) {
				$this->ajaxReturn(array('errcode' => -1, 'message' => '终点站不能为空'));
			}
			if (empty($BeginStationID)) {
				$this->ajaxReturn(array('errcode' => -1, 'message' => '发车时间不能为空'));
			}
			$list = D('Ticketmodel')->search($BeginStationID, $EndStationID, $NoOfRunsdate, $page, $page_size);
			$data = array();

			foreach ($list as $k => $v) {
				$arr = array(
						'time' => $v['tml_noofrunstime'],
						'begin' => $v['tml_beginstation'],
						'end' => $v['tml_endstation'],
						'busmodel' => $v['tml_busmodel'],
						'leave_seats' => $v['tml_LeaveSeats'],
						'price' => $v['pd_fullprice'],
				);
				$data[] = $arr;
			}
			$this->ajaxReturn(array('errcode' => 0, 'message' => '成功', 'data' => $data));
		}
		$list=D('Siteset')->getSite();
		$site_list=array();
		foreach($list as $k=>$v){
			$arr=array(
					'value'=>$v['sset_operatecode'],
					'text'=>$v['sset_sitename'],
			);
			$site_list[]=$arr;
		}
		$site_list= json_encode($site_list);
		$this->assign('site_list',$site_list);
		$this->display();
	}

	public function result_search(){
		$BeginStationID = I('begin');
		$EndStationID = I('end');
		$NoOfRunsdate = I('time');
		$type = I('type');
		$page = I("page");
		$page_size = I("page_size");
		if (empty($page)) {
			$page = 1;
		}
		if (empty($page_size)) {
			$page_size = 10;
		}
		if (empty($BeginStationID)) {
			$this->error('发车点不能为空','runs_search');
		}
		if (empty($BeginStationID)) {
			$this->error('终点站不能为空','runs_search');
		}
		if (empty($NoOfRunsdate)) {
			$this->error('发车时间不能为空','runs_search');
		}
		$list = D('Ticketmodel')->search($BeginStationID, $EndStationID, $NoOfRunsdate,$type, $page, $page_size);
		$data = array();
		foreach ($list as $k => $v) {
			$arr = array(
					'runsid' => $v['tml_noofrunsid'],
					'runsdate' => $v['tml_noofrunsdate'],
					'time' => $v['tml_noofrunstime'],
					'begin' => $v['tml_beginstation'],
					'end' => $v['tml_endstation'],
					'busmodel' => $v['tml_busmodel'],
					'leave_seats' => $v['tml_leaveseats'],
					'price' => $v['pd_fullprice'],
			);
			$data[] = $arr;
		}
		//var_dump($data);
		$this->assign('begin',$BeginStationID);
		$this->assign('end',$EndStationID);
		$this->assign('time',$NoOfRunsdate);
		$this->assign('data',$data);
		$this->display();
	}
	public function ajax_search(){
		$BeginStationID = '001';// I('begin');
		$EndStationID = '002';//I('end');
		$NoOfRunsdate = '2017-02-18';//I('time');
		/*$BeginStationID =  I('begin');
		$EndStationID = I('end');
		$NoOfRunsdate = I('time');*/
		$time =  I('');
		//$time = $_POST['time'];
		//$this->ajaxReturn($time);
		$type = I('type');
		$page = I("page");
		$page_size = I("page_size");
		if (empty($page)) {
			$page = 1;
		}
		if (empty($page_size)) {
			$page_size = 10;
		}

		$list = D('Ticketmodel')->search($BeginStationID, $EndStationID, $NoOfRunsdate,$type, $page, $page_size);

		$data = array();
		foreach ($list as $k => $v) {
			$arr = array(
					'runsid' => $v['tml_noofrunsid'],
					'runsdate' => $v['tml_noofrunsdate'],
					'time' => $v['tml_noofrunstime'],
					'begin' => $v['tml_beginstation'],
					'end' => $v['tml_endstation'],
					'busmodel' => $v['tml_busmodel'],
					'leave_seats' => $v['tml_leaveseats'],
					'price' => $v['pd_fullprice'],
			);
			$data[] = $arr;
		}
		//var_dump($data);
		$this->ajaxReturn($data);
	}

}//class end
