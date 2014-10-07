<?php
namespace Home\Controller;
class FileController extends HomeController{
	//微博首页图片上传专用
	public function indexImg(){
		$File=D('File');
		$this->ajaxReturn($File->indexImg());
	}
	//个人中心头像上传专用
	public function avatar(){
		$File=D('File');
		$this->ajaxReturn($File->avatar());
	}
	//个人头像上传裁剪
	public function crop(){
		$File=D('File');
		$path=$File->crop(I('post.w'),I('post.h'),I('post.x'),I('post.y'),I('post.url'));
		$User=D('User');
		$User->updateFace(json_encode($path));
		echo json_encode($path);	
	}
}