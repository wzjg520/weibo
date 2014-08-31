<?php
namespace Home\Controller;

use Think\Controller;
use Think\Verify;

class UserController extends Controller {
	public function register() {
		if (IS_AJAX) {
			$User = D('User');
			$flag = $User->register(I('post.username'),I('post.password'),I('post.email'));
			echo $flag;
		} else {
			$this->error('非法访问');
		}
	}
	//ajax验证uesrname
	public function checkUsername(){
		if(IS_AJAX){
			$User= D ('User');
			$flag= $User->checkFields(I('post.username'),'username');
			echo $flag>0 ? 'true' : 'false';
		}else{
			$this->error('非法访问');
		}
	}
	//ajax验证email
	public function checkEmail(){
		if(IS_AJAX){
			$User= D ('User');
			$flag= $User->checkFields(I('post.email'),'email');
			echo $flag>0 ? 'true' : 'false';
		}else{
			$this->error('非法访问');
		}
	}
	public function checkVerify(){
		if(IS_AJAX){
			$User= D ('User');
			$flag= $User->checkFields(I('post.verify'),'verify');
			echo $flag>0 ? 'true' : 'false';
		}else{
			$this->error('非法访问');
		}
	}
	
	//验证登陆
	public function login(){
		if(IS_AJAX){
			$User= D ('User');
			$uid = $User->login(I('post.username'),I('post.password'),I('post.auto'));
			echo $uid>0 ? 'true' : 'false';
		}else{
			$this->error('非法访问');
		}
	}
	//退出登录
	public function logout(){
		//清除服务器session
		session('auth',null);
		//清除本地cookie
		cookie('auto',null);
		$this->success('退出成功',U('Login/index'));
	}
}