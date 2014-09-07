<?php
namespace Home\Model;
use Think\Model;
class ImagesModel extends Model{
	public function storage($img,$tid){
		foreach($img as $key=>$value){
			$data=array(
					'data'=>$value,
					'tid' => $tid,
			);
			if( ! $this->add($data))return 0;
			
		}
		return 1;
	}
}