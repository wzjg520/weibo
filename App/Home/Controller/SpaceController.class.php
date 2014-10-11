<?php
namespace Home\Controller;
class SpaceController extends HomeController{
	public function index(){
		if($this->login()){
			$User=D('User');
			$this->assign('User',I('get.id'));
			$this->display();
		}
		
	}
}