<?php

namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller {
	
	public function index() {
		if(session('admin')) {
			$this->redirect('Index/index');
		} else {
			$this->display();
		}
		
	}
	
	//验证管理员
	public function checkManager() {
		
		if(IS_AJAX){
			$Manage = D('Manage');
			sleep(3);
			echo $Manage->checkManager(I('post.manager'), I('post.password'));			
		}else{
			$this->error('非法操作');
		}
		
	}
	
}