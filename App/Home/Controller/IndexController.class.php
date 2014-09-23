<?php
namespace Home\Controller;
class IndexController extends HomeController {
    public function index(){
       if($this->login()){
 		 	$Topic = D('Topic');
 		 	$topicList=$Topic->getList(0,10);
 		 	$topicList=$Topic->format($topicList);
 		 	$this->assign('topicList',$topicList);
       		$this->display();
       }
    }
}