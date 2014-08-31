<?php
namespace Home\Controller;

use Think\Upload;
class FileController extends HomeController{
	
	public function upload(){
		$upload=new Upload(C('FILE_UPLOAD'));
		$info=$upload->upload();
		if($info){
			var_dump($info);
		}else{
			echo $upload->getError();
		}
	}
}