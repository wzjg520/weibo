<?php
namespace Home\Controller;
class SetController extends HomeController{
	//显示个人资料
	public function index(){
		if($this->login()){
			$User=D('User');
			$this->assign('user',$User->getUser());
			$this->display();
		}
	}
	//修改个人信息
	public function updateUser(){
		if(IS_AJAX){
			$User=D('User');
			$uid=$User->update(I('post.email'),I('post.intro'));
			echo $uid ;
		}else{
			$this->error('非法操作');
		}
		
		
		
	}
}