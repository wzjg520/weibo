<?php
namespace Home\Controller;
class IndexController extends HomeController {
    public function index(){
       if($this->login()){
 		 	$Topic = D('Topic');
 		 	$topicList=$Topic->relation(true)
 		 						->table('__TOPIC__ a, __USER__ b')
 		 						->field('a.id,a.content,a.content_over,a.create,b.username')
 		 						->where('a.uid=b.id')
 		 						->limit('0,10')
 		 						->order('a.create DESC')
 		 						->select();
 		 	$topicList=$Topic->format($topicList);
 		 	$this->assign('topicList',$topicList);
       		$this->display();
       }
    }
}