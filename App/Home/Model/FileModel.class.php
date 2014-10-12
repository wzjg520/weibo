<?php
namespace Home\Model;
use Think\Model;
use Think\Upload;
use Think\Image;
class FileModel extends Model {
	//微博首页显示图片
	function indexImg(){
		$Upload=new Upload(C('FILE_UPLOAD'));
		$info=$Upload->upload();
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
			return $imgArr;
		}else{
			echo $Upload->getError();
		}
	}
	//个人中心上传头像
	function avatar(){
		$Upload=new Upload(C('FILE_UPLOAD'));
		$info=$Upload->upload();
		if($info){
			$rootPath=C('FILE_UPLOAD');
			$rootPath=$rootPath['rootPath'];
			//图片地址
			$imgPath=$rootPath.$info['Filedata']['savepath'].$info['Filedata']['savename'];
			//裁剪图片
			$imgHandler=new Image();
			$imgHandler->open($imgPath);
			$imgHandler->thumb(500, 500)->save($imgPath);
			return $imgPath;
		}else{
			echo $Upload->getError();
		}
	}
	//裁剪头像
	function crop($w,$h,$x,$y,$url){
			$rootPath=C('FACE_PATH');
			//图片地址
			$bigFacePath=$rootPath.session('auth')['id'].'_200*200.jpg';
			$smallFacePath=$rootPath.session('auth')['id'].'_50*50.jpg';
			//裁剪图片
			$imgHandler=new Image();
			$imgHandler->open($url);
			$imgHandler->crop($w, $h,$x,$y);
			//保存大图
			$imgHandler->thumb(200,200)->save($bigFacePath);
			//保存小图
			$imgHandler->thumb(50, 50)->save($smallFacePath);
			$pathArr=array(
				small=>$smallFacePath,
				big=>$bigFacePath,
			);
			return $pathArr;
	}
}