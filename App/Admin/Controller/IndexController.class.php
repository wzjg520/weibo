<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller {
	
	public function index() {
		if (session('admin')) {
			$this->display();
			
		} else {
			$this->redirect('Login/index');
		}
	}
	
	//ajax获得导航tree
	public function getNav(){
		$Nav = D('Nav');
		$this->ajaxReturn($Nav->getNav(I('post.id')));
	}
}