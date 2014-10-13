<?php
namespace Home\Controller;
class IndexController extends HomeController {
    public function index(){
       if($this->login()){
 		 	$Topic = D('Topic');
 		 	$topicList=$Topic->getList(0,10);
 		 	$this->assign('topicList',$topicList);
 		 	$this->assign('smallFace', session('auth')['face']->small);
 		 	$this->assign('bigFace', session('auth')['face']->big);
 		 	$this->assign('auth',session('auth'));
       		$this->display();
       }
    }
}