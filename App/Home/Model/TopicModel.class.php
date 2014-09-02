<?php
namespace Home\Model;
use Think\Model;
class TopicModel extends Model{
	protected $_validate = array(
		//-1,'帐号长度不合法！'
		array('content', '1,280', -1, self::EXISTS_VALIDATE,'length'),
	);
	//自动完成
	protected $_auto = array (
		array('create','time',self::MODEL_INSERT,'function'),
	);
	public function publish($content,$uid,$iid){
		if(mb_strlen($content)>255){
			$data=array(
				'content'=>mb_substr($content, 0,255,'utf8'),
				'content_over'=>mb_substr($content,255,25,'utf8'),
			);
		}else{
			$data=array(
				'content'=>$content,
			);
		}
		$data['ip']=get_client_ip(1);
		$data['uid']=$uid;
		$data['iid']=$iid;
		if($this->create($data)){
			$uid=$this->add();
			echo $uid;
		}else{
			return $this->getError();
		}
	}
	
}