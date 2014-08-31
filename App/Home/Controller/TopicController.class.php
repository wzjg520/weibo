<?php
namespace Home\Controller;
use Think\Controller;

class TopicController extends Controller{
	//发布微博
	public function publish(){
		if(IS_AJAX){
			$Topic=D('Topic');
			$Topic->publish(I('post.content'),session('auth')['id']);
			echo $Topic;
		}else{
			$this->error('非法操作');
		}
	}
}