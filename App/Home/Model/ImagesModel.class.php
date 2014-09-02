<?php
namespace Home\Model;
use Think\Model;
class ImagesModel extends Model{
	public function storage($img){
		$iid='';
		foreach($img as $key=>$value){
			$data=array(
					'data'=>$value,
			);
			if( !! $iid .= $this->add($data)){
				$iid.=',';
			}else{
				return 0;
			}
		}
		return substr($iid, 0,strlen($iid)-1);
	}
}