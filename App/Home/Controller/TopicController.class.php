<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\ImagesModel;

class TopicController extends Controller{
	//发布微博
	public function publish(){
		if(IS_AJAX){
			$iid='';
			$img=I('post.images','',false);
			if(is_array($img)){
				$Images=new ImagesModel();
				$iid=$Images->storage(I('post.images'));
			}
			$Topic=D('Topic');
			$session=session('auth');
			$Topic->publish(I('post.content'),$session['id'],$iid);
			echo $Topic;
		}else{
			$this->error('非法操作');
		}
	}
}