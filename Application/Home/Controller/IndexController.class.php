<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function pay(){
		$aaa = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx7a6f30cb15ed2e41&secret=7f8c6005dd823917a61d55075c8791bd');
		var_dump($aaa);
		/*$order_sn = 98667;
		$openId = '';
		$jsApiParameters = wxpay($openId,'江南极客',$order_sn,1);
		$this->assign(array(
				'data' => $jsApiParameters
		));
		$this->display();*/
	}

	public function arrive(){
		$this->display();
	}

	public function index(){
		//$arr=M('databak')->select();print_r($arr);
		//获得参数 signature nonce token timestamp echostr
		$nonce     = $_GET['nonce'];
		$token     = C('Token');//'weixin';
		$timestamp = $_GET['timestamp'];
		$echostr   = $_GET['echostr'];
		$signature = $_GET['signature'];
		//形成数组，然后按字典序排序
		$array = array();
		$array = array($nonce, $timestamp, $token);
		sort($array);
		//拼接成字符串,sha1加密 ，然后与signature进行校验
		$str = sha1( implode( $array ) );
		
		if( $str  == $signature && $echostr ){
			//第一次接入weixin api接口的时候
			echo  $echostr;
			exit;
		}else{
			$this->reponseMsg();
		}
	}
	// 接收事件推送并回复
	public function reponseMsg(){
		//1.获取到微信推送过来post数据（xml格式）
		$postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
		//2.处理消息类型，并设置回复类型和内容
		/*<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[FromUser]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[subscribe]]></Event>
</xml>*/
		$postObj = simplexml_load_string( $postArr );
		//$postObj->ToUserName = '';
		//$postObj->FromUserName = '';
		//$postObj->CreateTime = '';
		//$postObj->MsgType = '';
		//$postObj->Event = '';
		// gh_e79a177814ed
		//判断该数据包是否是订阅的事件推送
		if( strtolower( $postObj->MsgType) == 'event'){
			//如果是关注 subscribe 事件
			if( strtolower($postObj->Event == 'subscribe') ){
				//回复用户消息(纯文本格式)	
				$toUser   = $postObj->FromUserName;
				$fromUser = $postObj->ToUserName;
				$time     = time();
				$msgType  =  'text';
				$content  = '欢迎关注我们的微信公众账号'.$postObj->FromUserName.'-'.$postObj->ToUserName;
				$template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
				$info     = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
				echo $info;
/*<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[你好]]></Content>
</xml>*/
			

			}
			elseif( strtolower($postObj->Event) == 'click' ){
			//elseif ($postObj->Event=='CLICK') {
				/* $content = '您1';
				$template = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
//注意模板中的中括号 不能少 也不能多
				$fromUser = $postObj->ToUserName;
				$toUser   = $postObj->FromUserName; 
				$time     = time();
				// $content  = '18723180099';
				$msgType  = 'text';
				echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
				exit; */
				$toUser   = $postObj->FromUserName;
				$fromUser = $postObj->ToUserName;
				$time     = time();
				$msgType  =  'text';
				$content  = '点击推送';
				$template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
				$info     = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
				echo $info;
			}
			
		}

		//当微信用户发送imooc，公众账号回复‘imooc is very good'
		/*<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[你好]]></Content>
</xml>*/
		/*if(strtolower($postObj->MsgType) == 'text'){
			switch( trim($postObj->Content) ){
				case 1:
					$content = '您输入的数字是1';
				break;
				case 2:
					$content = '您输入的数字是2';
				break;
				case 3:
					$content = '您输入的数字是3';
				break;
				case 4:
					$content = "<a href='http://www.imooc.com'>慕课</a>";
				break;
				case '英文':
					$content = 'imooc is ok';
				break;

			}	
				$template = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
//注意模板中的中括号 不能少 也不能多
				$fromUser = $postObj->ToUserName;
				$toUser   = $postObj->FromUserName; 
				$time     = time();
				// $content  = '18723180099';
				$msgType  = 'text';
				echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
			
		}
	}
*/
		//用户发送tuwen1关键字的时候，回复一个单图文
		if( strtolower($postObj->MsgType) == 'text' && trim($postObj->Content)=='tuwen2' ){
			$toUser = $postObj->FromUserName;
			$fromUser = $postObj->ToUserName;
			$arr = array(
				array(
					'title'=>'imo',
					'description'=>"imo is very cool",
					'picUrl'=>'https://www.baidu.com/img/bdlogo.png',
					'url'=>'http://www.hao123.com',
				),
				array(
					'title'=>'hao123',
					'description'=>"hao123 is very cool",
					'picUrl'=>'https://www.baidu.com/img/bdlogo.png',
					'url'=>'http://www.hao123.com',
				),
				array(
					'title'=>'qq',
					'description'=>"qq is very cool",
					'picUrl'=>'https://www.baidu.com/img/bdlogo.png',
					'url'=>'http://www.qq.com',
				),
			);
			$template = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<ArticleCount>".count($arr)."</ArticleCount>
						<Articles>";
			foreach($arr as $k=>$v){
				$template .="<item>
							<Title><![CDATA[".$v['title']."]]></Title> 
							<Description><![CDATA[".$v['description']."]]></Description>
							<PicUrl><![CDATA[".$v['picUrl']."]]></PicUrl>
							<Url><![CDATA[".$v['url']."]]></Url>
							</item>";
			}
			
			$template .="</Articles>
						</xml> ";
			echo sprintf($template, $toUser, $fromUser, time(), 'news');

			//注意：进行多图文发送时，子图文个数不能超过10个
		}else{
			switch( trim($postObj->Content) ){
				case 1:
					$content = "<a href='http://www.huxiaohui.xyz/ThinkPHP/home/login/fn_system_edit'>我要买票</a>";
				break;
				case 2:
					$content =  "<a href='http://huxiaohui.xyz/thinkphp/home/login/fn_system'>个人中心</a>";
				break;
				case 3:
					$content = '您输入的数字是3';
				break;
				case 4:
					$content = "<a href='http://www.baidu.com'>测试</a>";
				break;
				case '英文':
					$content = 'im is ok';
				break;
			}	
				$template = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
//注意模板中的中括号 不能少 也不能多
				$fromUser = $postObj->ToUserName;
				$toUser   = $postObj->FromUserName; 
				$time     = time();
				// $content  = '18723180099';
				$msgType  = 'text';
				echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
			
		}//if end
	}//reponseMsg end

	function http_curl(){
		//获取imooc
		//1.初始化curl
		$ch = curl_init();
		$url = 'http://www.baidu.com';
		//2.设置curl的参数
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//3.采集
		$output = curl_exec($ch);
		//4.关闭
		curl_close($ch);
		var_dump($output);
	}

	function getWxAccessToken(){
		//1.请求url地址
		//$appid = 'wx08d5c2cb632bb5e4';
		//$appsecret =  '06d3444fb9abd8d00314eb4a38ad61a8';
		$appid = C('AppID');//'wxddcd995fcc1981b3';
		$appsecret =  C('AppSecret');//'d3cd24261570f5b852b7162ec5cbdc70';
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
		//2初始化
		//echo $url;
		
		$ch = curl_init();
		//3.设置参数
		curl_setopt($ch , CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    //curl_setopt($ch, CURLOPT_HEADER, 1);
	//curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
		
		//curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10); 
		//4.调用接口 
		
		$res = curl_exec($ch);
		//5.关闭curl
		curl_close( $ch );
		if( curl_errno($ch) ){
			//var_dump( curl_error($ch) );
		}
		$arr = json_decode($res, true);
		//var_dump( $arr );
		return $arr['access_token'];
	}

	function getWxServerIp(){
		$accessToken = "6vOlKOh7r5uWk_ZPCl3DS36NEK93VIH9Q9tacreuxJ5WzcVc235w_9zONy75NoO11gC9P0o4FBVxwvDiEtsdX6ZRFR0Lfs_ymkb8Bf6kRfo";
		$url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=".$accessToken;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$res = curl_exec($ch);
		curl_close($ch);
		if(curl_errno($ch)){
			var_dump(curl_error($ch));
		}
		$arr = json_decode($res,true);
		echo "<pre>";
		var_dump( $arr );
		echo "</pre>";
	}
	public function https_request($url,$data = null){ 
		 $curl = curl_init(); 
		 curl_setopt($curl, CURLOPT_URL, $url); 
		 
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		 
		 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
		 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); 
		 if (!empty($data)){ 
		  curl_setopt($curl, CURLOPT_POST, 1); 
		  curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 
		 } 
		 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		 $output = curl_exec($curl); //print_r($data);exit;
		 curl_close($curl); 
		 return $output; 
	}
	public function defineItem(){
		$access_token=$this->getWxAccessToken();
		//$access_token='';
		$jsonmenu ='{
     "button":[
     {	
          "type":"click",
          "name":"今日歌曲",
          "key":"tuwen2"
      },
      {
           "name":"菜单",
           "sub_button":[
           {	
               "type":"view",
               "name":"搜索",
               "url":"http://www.soso.com/"
            },
            {
                 "type":"miniprogram",
                 "name":"wxa",
                 "url":"http://mp.weixin.qq.com",
                 "appid":"wx286b93c14bbf93aa",
                 "pagepath":"pages/lunar/index.html"
             },
            {
               "type":"click",
               "name":"赞一下我们",
               "key":"V1001_GOOD"
            }]
       }]
		}';
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token; 
		$result = $this->https_request($url, $jsonmenu); 
		var_dump($result); 
	}
	public function fn_system(){
		if(empty($_SESSION['user'])){
			//echo 1111111111111111;
			header("Location:http://www.huxiaohui.xyz/ThinkPHP/home/index/fn_wx_login");
		}else{
			print_r($_SESSION['user']);
		}
	}
	public function fn_wx_login(){
		$appid = C('AppID');//"wxddcd995fcc1981b3";
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri=http%3a%2f%2fwww.huxiaohui.xyz%2fThinkPHP%2fhome%2findex%2flogin&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
		header("Location:".$url);
	}
	public function login(){
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
		$_SESSION['user'] = $user_obj;echo 11100;
		//S($user_obj,1);echo S($user_obj);
		print_r($user_obj);
	}


}//class end
