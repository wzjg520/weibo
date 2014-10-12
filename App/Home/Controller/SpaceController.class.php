<?php
namespace Home\Controller;
class SpaceController extends HomeController{
	public function index($id=0,$domain=''){
		if($id==0 && $domain=='')$this->error('非法访问');
		if($this->login()){
			$User=D('User');
			//通过id获得用户信息
			if($id)$getUser=$User->getUser();		
			//通过个性域名获得用户信息
			if($domain)$getUser=$User->getUserByDomain($domain);
			if(!$getUser)$this->error('不存在此用户');
			$this->assign('user',$getUser);
			$this->assign('bigFace',json_decode($getUser['face'])->big);
			$this->display();		
		}
		
	}
}