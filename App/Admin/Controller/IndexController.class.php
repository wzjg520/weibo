<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller {
	public function index() {
// 		session('admin', null);
// 		print_r($_SESSION);
		if (session('admin')) {
			$this->display();
			
		} else {
			$this->redirect('Login/index');
		}
	}
}