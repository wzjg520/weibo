<?php
namespace Home\Model;
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
	public function publish($content,$uid,$reid=0){
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
		if($reid>0){
			$data['reid']=$reid;
		}
		if($this->create($data)){
			$tid=$this->add();
			if($tid){
				if($reid>0)$this->setRecount($reid);
				return $tid;
			}else{
				return 0;
			}
			
		}else{
			return $this->getError();
		}
	}
	//被转发的源微博+1
	public function setRecount($reid){
		$map['id'] = $reid;
		$this->where($map)->setInc('re_count');
	}
	//获得数据列表
	public function getList($start,$step){
		$topicList=$this->relation(true)
		->table('__TOPIC__ a, __USER__ b')
		->field('a.id,a.content,a.content_over,a.reid,a.create,b.username,b.face,a.uid,b.domain')
		->where('a.uid=b.id')
		->limit($start,$step)
		->order('a.create DESC')
		->select();
		return $this->format($topicList);
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
			} else if (date("Y") == date('Y',$value['create'])) {
				$value['time'] = date('m月d日 H:i', $value['create']);
			} else {
				$value['time'] = date('Y年m月d日 H:i', $value['create']);
			}
			//表情解析
			$value['content']=preg_replace('/\[(a|b|c|d)_([0-9]+)\]/i','<img src="'.__ROOT__.'/Public/'.MODULE_NAME.'/images/face/$1/$2.gif" border="0">', $value['content']);
			//@会员解析
			$value['content'] .=' ';
			$value['content']=preg_replace('/(@\S+)\s/i','<a href="'.__ROOT__.'/$1" class="space" target="_blank" >$1</a>',$value['content']);
			
			//获取转播的微博
			if ($value['reid'] > 0) {
				$value['recontent'] = $this->getReContent($value['reid']);
			}
			$data[$key]=$value;
			$data[$key]['count']=count($value['images']);
			//头像解析
			$data[$key]['face']=json_decode($value['face']);
			
												
		};
		return $data;
	}
	
	//获取被转播的微博内容
	private function getReContent($reid) {
		return $this->reFormat($this->relation(true)
				->table('__TOPIC__ a, __USER__ b')
				->field('a.id,a.content,a.content_over,a.create,a.uid,a.reid,a.re_count,b.username,b.face,b.domain')
				->where('a.uid=b.id AND a.id='.$reid)
				->find());
	}
	//转发微博解析
	public function reFormat($data){
			if(!is_null($data['images'])){
				foreach($data['images'] as $k=>$v){
					$data['images'][$k]=json_decode($v['data'],true);
				}
			}
			if(!is_null($data['content_over'])){
				$data['content']=$data['content'].$data['content_over'];
			}
			$time = NOW_TIME - $data['create'];
			if ($time < 60) {
				$data['time'] = '刚刚发布';
			} else if ($time < 60 * 60) {
				$data['time'] = floor($time / 60).'分钟之前';
			} else if (date('Y-m-d') == date('Y-m-d', $data['create'])) {
				$data['time'] = '今天'.date('H:i', $data['create']);
			} else if (date("Y-m-d",strtotime("-1 day")) == date('Y-m-d',$data['create'])) {
				$data['time'] = '昨天'.date('H:i', $data['create']);
			} else if (date("Y") == date('Y',$data['create'])) {
				$data['time'] = date('m月d日 H:i', $data['create']);
			} else {
				$data['time'] = date('Y年m月d日 H:i', $data['create']);
			}
			//表情解析
			$data['content']=preg_replace('/\[(a|b|c|d)_([0-9]+)\]/i','<img src="'.__ROOT__.'/Public/'.MODULE_NAME.'/images/face/$1/$2.gif" border="0">', $data['content']);
			//@会员解析
			$data['content'] .=' ';
			$data['content']=preg_replace('/(@\S+)\s/i','<a href="'.__ROOT__.'/$1" class="space" target="_blank" >$1</a>',$data['content']);
			
			$data['count']=count($data['images']);
			//头像解析
			$data['face']=json_decode($data['face']);
		return $data;
	}	
}