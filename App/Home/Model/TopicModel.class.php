<?php
namespace Home\Model;
use Think\Model;
use Think\Model\RelationModel;
class TopicModel extends RelationModel{
	protected $_validate = array(
		//-1,'帐号长度不合法！'
		array('content', '1,280', -1, self::EXISTS_VALIDATE,'length'),
	);
	//自动完成
	protected $_auto = array (
		array('create','time',self::MODEL_INSERT,'function'),
	);
	
	protected $_link = array (
		'images' => array(
			'mapping_type' => self::HAS_MANY,
			'foreign_key' => 'tid',
			'class_name' => 'Images',
			'mapping_fields'=>'data',
		),
		
	);
	public function publish($content,$uid){
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
		if($this->create($data)){
			$tid=$this->add();
			return $tid;
		}else{
			return $this->getError();
		}
	}
	//数据格式化
	public function format($data){
		
		foreach($data as $key=>$value){
			if(!is_null($value['images'])){
				foreach($value['images'] as $k=>$v){					
					$value['images'][$k]=json_decode($v['data'],true);
				}
			}
			$data[$key]=$value;
			$data[$key]['count']=count($value['images']);
		};
		return $data;
	}
}