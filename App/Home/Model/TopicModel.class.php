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
	//一对一
	protected $_link = array (
		'images' => array(
			'mapping_type' => self::HAS_MANY,
			'foreign_key' => 'tid',
			'class_name' => 'Images',
			'mapping_fields'=>'data',
		),
		
	);
	//发布微博
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
	//获得数据列表
	public function getList($start,$step){
		$topicList=$this->relation(true)
		->table('__TOPIC__ a, __USER__ b')
		->field('a.id,a.content,a.content_over,a.create,b.username')
		->where('a.uid=b.id')
		->limit($start,$step)
		->order('a.create DESC')
		->select();
		return $topicList;
	}
	
	//数据格式化
	public function format($data){
		
		foreach($data as $key=>$value){
			if(!is_null($value['images'])){
				foreach($value['images'] as $k=>$v){					
					$value['images'][$k]=json_decode($v['data'],true);
				}
			}
			if(!is_null($value['content_over'])){
				$value['content']=$value['content'].$value['content_over'];
			}
			$time = NOW_TIME - $value['create'];
			if ($time < 60) {
				$value['time'] = '刚刚发布';
			} else if ($time < 60 * 60) {
				$value['time'] = floor($time / 60).'分钟之前';
			} else if (date('Y-m-d') == date('Y-m-d', $value['create'])) {
				$value['time'] = '今天'.date('H:i', $value['create']);
			} else if (date("Y-m-d",strtotime("-1 day")) == date('Y-m-d',$value['create'])) {
				$value['time'] = '昨天'.date('H:i', $value['create']);
			} else if ($time < 60 * 60 * 365) {
				$value['time'] = date('m月d日 H:i', $value['create']);
			} else {
				$value['time'] = date('Y年m月d日 H:i', $value['create']);
			}
			$value['content']=preg_replace('/\[(a|b|c|d)_([0-9]+)\]/i','<img src="'.__ROOT__.'/Public/'.MODULE_NAME.'/images/face/$1/$2.gif" border="0">', $value['content']);
			$data[$key]=$value;
			$data[$key]['count']=count($value['images']);
		};
		return $data;
	}
}