<?php
namespace Home\Controller;

use Think\Upload;
use Think\Image;
class FileController extends HomeController{
	
	public function upload(){
		$upload=new Upload(C('FILE_UPLOAD'));
		$info=$upload->upload();
		if($info){			
			$rootPath=C('FILE_UPLOAD');
			$rootPath=$rootPath['rootPath'];
			$imgPath=$rootPath.$info['Filedata']['savepath'].$info['Filedata']['savename'];
			$imgHandler=new Image();
			$imgHandler->open($imgPath);
			//缩略图
			$thumbPath=$rootPath.$info['Filedata']['savepath'].'180-'.$info['Filedata']['savename'];
			$imgHandler->thumb(180, 180)->save($thumbPath);
			
			$imgHandler->open($imgPath);
			//展开图
			$unfoldPath=$rootPath.$info['Filedata']['savepath'].'550-'.$info['Filedata']['savename'];
			$imgHandler->thumb(550, 550)->save($unfoldPath);
			
			//全部图片地址
			$imgArr=array(
					'thumb'=>$thumbPath,
					'unfold'=>$unfoldPath,
					'source'=>$imgPath,
			);
			$this->ajaxReturn($imgArr);
		}else{
			echo $upload->getError();
		}
	}
}