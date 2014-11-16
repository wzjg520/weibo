<?php
namespace Home\Controller;
use Think\Controller;
class CommentController extends Controller{
	//发布微博
	public function publish(){
		if(IS_AJAX){
			$Comment = D('Comment');
			$cid = $Comment->publish(I('post.content'),session('auth')['id'],I('post.tid'));
			echo $cid;
		}else{
			$this->error('非法访问！');
		}		
	}
	
	//获取评论列表
	public function getList(){
		if(IS_AJAX){
			$Comment = D('Comment');
			$getList = $Comment->getlist(I('post.tid'),I('post.page'));
			$this->assign('getList',$getList['list']);
			$this->assign('total',$getList['total']);
			$this->assign('page',I('post.page'));
			
			//print_r($getList);
			$this->display();
		}else{
			$this->error('非法访问！');
		}
	}
}