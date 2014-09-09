<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\ImagesModel;

class TopicController extends Controller{
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
}