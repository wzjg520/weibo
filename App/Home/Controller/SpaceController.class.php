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
	
	//@用户
	public function setUrl($username=''){
		if(IS_AJAX && $username != ''){
			$User = D('User');
			$getUser=$User->getUserByName($username);
			if(is_array($getUser)){
				$this->ajaxReturn($getUser);
			}
			
		}else{
			$this->error('非法操作');
		}
	}
}