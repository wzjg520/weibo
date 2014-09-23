<?php
namespace Home\Controller;
use Home\Model\ImagesModel;

class TopicController extends HomeController{
	//发布微博
	public function publish(){
		if(IS_AJAX){
			$Topic=D('Topic');
			$user=session('auth');
			$tid=$Topic->publish(I('post.content'),$user['id']);			
			$img=I('post.images','',false);
			if(is_array($img)){
				$Images=new ImagesModel();
				$iid=$Images->storage($img,$tid);
				echo $iid ? $iid : $tid;
			}else{
				echo $tid;
			}			
		}else{
			$this->error('非法操作');
		}	
	}
	//ajax获得总页数
	public function ajaxPages(){
		if(IS_AJAX){
			$Topic=D('Topic');
			$pages=$Topic->where('1=1')->count();
			echo ceil($pages/I('post.unit'));
		}else{
			$this->error('非法操作');
		}
	}
	//ajax获得列表
	public function ajaxList(){
		if(IS_AJAX){
			$Topic=D('Topic');
			$topicList=$Topic->getList(I('post.start'),I('post.step'));
 		 	$topicList=$Topic->format($topicList);
 		 	$this->assign('topicList',$topicList);
       		$this->display();
		}else{
			$this->error('非法操作');
		}
	}
	
}