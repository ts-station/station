<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index(){
		$_SESSION['user'] = array('nickname'=>'HXH','openid'=>'oLVPpjqs9BhvzwPj5A-vTYAX3GLc');
	}
	/**
	 *  微信登录
	 */
	public function fn_system(){
		if(empty($_SESSION['user'])){
			//echo 1111111111111111;
			header("Location:http://www.huxiaohui.xyz/ThinkPHP/home/login/fn_wx_login");
		}else{
			header("Location:http://www.huxiaohui.xyz/ThinkPHP/home/login/fn_wx_login");
			//print_r($_SESSION['user']);
		}
	}
	public function fn_wx_login(){
		$appid = C('AppID');//"wxddcd995fcc1981b3";
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri=http%3a%2f%2fwww.huxiaohui.xyz%2fThinkPHP%2fhome%2flogin%2flogin&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
		header("Location:".$url);
	}
	public function login(){
		$appid = C('AppID');//"wx7a6f30cb15ed2e41";
		$secret = C('AppSecret');//"d3cd24261570f5b852b7162ec5cbdc70";
		$code = $_GET["code"];
		$get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
//echo $get_token_url;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch,CURLOPT_URL,$get_token_url);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		$res = curl_exec($ch);
		curl_close($ch);
		$json_obj = json_decode($res,true);

//根据openid和access_token查询用户信息
		$access_token = $json_obj['access_token'];
		$openid = $json_obj['openid'];
		$get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch,CURLOPT_URL,$get_user_info_url);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		$res = curl_exec($ch);
		curl_close($ch);
//解析json
		$user_obj = json_decode($res,true);
		$_SESSION['user'] = $user_obj;

		$count=M('Customer')->where(array('cu_Openid'=>$user_obj['openid']))->find();
		if(empty($count)){
			$data=array(
					'cu_Name'=>$user_obj['nickname'],
					'cu_Openid'=>$user_obj['openid'],
					'cu_Icon'=>$user_obj['headimgurl'],
					'cu_Sex'=>$user_obj['sex'],
					'cu_Language'=>$user_obj['language'],
					'cu_City'=>$user_obj['city'],
					'cu_Province'=>$user_obj['province'],
					'cu_Country'=>$user_obj['country'],
					'cu_Date'=>time(),
			);
			$id=M('Customer')->add($data);
		}
		else{
			$id=$count['cu_customerid'];
		}
		$_SESSION['user_id'] = $id;
		header("Location:http://www.huxiaohui.xyz/ThinkPHP/home/customer/index");
	}
	/**
	 *  微信登录
	 */
	public function fn_system_edit(){
		if(empty($_SESSION['user'])){
			//echo 1111111111111111;
			header("Location:http://www.huxiaohui.xyz/ThinkPHP/home/login/fn_wx_login_edit");
		}else{
			header("Location:http://www.huxiaohui.xyz/ThinkPHP/home/login/fn_wx_login_edit");
			//print_r($_SESSION['user']);
		}
	}
	public function fn_wx_login_edit(){
		$appid = C('AppID');//"wxddcd995fcc1981b3";
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri=http%3a%2f%2fwww.huxiaohui.xyz%2fThinkPHP%2fhome%2flogin%2flogin_edit&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
		header("Location:".$url);
	}
	public function login_edit(){
		$appid = C('AppID');//"wxddcd995fcc1981b3";
		$secret = C('AppSecret');//"d3cd24261570f5b852b7162ec5cbdc70";
		$code = $_GET["code"];
		$get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
//echo $get_token_url;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch,CURLOPT_URL,$get_token_url);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		$res = curl_exec($ch);
		curl_close($ch);
		$json_obj = json_decode($res,true);

//根据openid和access_token查询用户信息
		$access_token = $json_obj['access_token'];
		$openid = $json_obj['openid'];
		$get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch,CURLOPT_URL,$get_user_info_url);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		$res = curl_exec($ch);
		curl_close($ch);
//解析json
		$user_obj = json_decode($res,true);
		$_SESSION['user'] = $user_obj;

		$count=M('Customer')->where(array('cu_Openid'=>$user_obj['openid']))->find();
		if(empty($count)){
			$data=array(
					'cu_Name'=>$user_obj['nickname'],
					'cu_Openid'=>$user_obj['openid'],
					'cu_Icon'=>$user_obj['headimgurl'],
					'cu_Sex'=>$user_obj['sex'],
					'cu_Language'=>$user_obj['language'],
					'cu_City'=>$user_obj['city'],
					'cu_Province'=>$user_obj['province'],
					'cu_Country'=>$user_obj['country'],
					'cu_Date'=>time(),
			);
			$id=M('Customer')->add($data);
		}
		else{
			$id=$count['cu_customerid'];
		}
		$_SESSION['user_id'] = $id;
		header("Location:http://www.huxiaohui.xyz/ThinkPHP/home/search/runs_search");
	}
}//class end
