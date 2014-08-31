<?php
namespace Home\Controller;
use Think\Verify;
class LoginController extends HomeController{
	
	public function index(){
		if(!session('?auth')){
			$this->display();
		}else{
			$this->redirect('Index/index');
		}
		
	}
	//验证码
	public function verify(){
		$Img=new Verify();
		$Img->useImgBg=true;
		$Img->entry();
	}
}