<?php
namespace Home\Controller;
class SpaceController extends HomeController{
	public function index(){
		if($this->login()){
			$User=D('User');
			$user=$User->getUser();		
			$this->assign('user',$user);
			$this->assign('bigFace',json_decode($user['face'])->big);
			$this->display();
		}
		
	}
}