<?php
namespace Home\Controller;
use Think\Controller;
class HomeController extends Controller{
	//验证码
	public function login(){
		if(!is_null($_COOKIE['auto']) && !session('?auth')){
			$userinfo=explode('|', encrypy($_COOKIE['auto'],1));
			list($username,$ip)=$userinfo;
			if($ip==get_client_ip(1)){				
				$User=D('User');
				$userObj=$User->field('id,username,last_login')->where(array('username'=>$username))->find();
				$auth=array(
					'username'=>$userObj['username'],
					'last_login'=>NOW_TIME,
					'id'=>$userObj['id']
				);
				session('auth',$auth);
			}
		}
		if(session('?auth')){
			return 1;
		}else{
			$this->redirect('Login/index');
		}
	}
}