<?php
namespace Home\Model;
use Think\Model;
class CommentModel extends Model{
	//微博表自动完成
	protected $_auto=array(
		array('create','time',self::MODEL_INSERT,'function'),
	);
	
	//发布微博
	public function publish($content,$uid,$tid){
		
		$data = array(
			'content'=>$content,
			'ip'=>get_client_ip(1),
			'uid'=>$uid,
			'tid'=>$tid,
		);
		
		if($this->create($data)){
			$cid = $this->add();
			if($cid){
				$Topic = D('Topic');
				$Topic->setCommcount($tid);
				return $cid;
			}else{
				return 0;
			}
		}else{
			$this->getError();
		}
	}
	
	//获取评论列表
	public function getList($tid,$page){
		//总记录数
		$count = $this->table('__COMMENT__ c,__USER__ u')
					->field('c.id,c.content,c.create,c.uid,u.username,u.domain')
					->order('c.create DESC')
					->where('c.uid=u.id AND c.tid='.$tid)
					->count();
		//总页码
		$total = ceil($count/5);
		
		//当前offset
		$offset = ($page-1) * 5;
		
		//评论数据
		$list = $this->table('__COMMENT__ c ,__USER__ u')
					->field('c.id,c.content,c.create,c.uid,u.username,u.domain')
					->order('c.create DESC')
					->limit($offset,5)
					->where('c.uid=u.id AND c.tid='.$tid)
					->select();
		$obj = array(
			'list'=>$list,
			'total'=>$total,
		);
		return $obj;
	}
	
	//格式化评论列表数据
	private function format($list){
		foreach($list as $key=>$value){
			//时间解析
			$time = NOW_TIME - $list[$key]['create'];
			if ($time < 60) {
					$list[$key]['time'] = '刚刚发布';
			} else if ($time < 60 * 60) {
				$list[$key]['time'] = floor($time / 60).'分钟之前';
			} else if (date('Y-m-d') == date('Y-m-d', $list[$key]['create'])) {
				$list[$key]['time'] = '今天'.date('H:i', $list[$key]['create']);
			} else if (date("Y-m-d",strtotime("-1 day")) == date('Y-m-d',$list[$key]['create'])) {
				$list[$key]['time'] = '昨天'.date('H:i', $list[$key]['create']);
			} else if (date('Y') == date('Y', $list[$key]['create'])) {
				$list[$key]['time'] = date('m月d日 H:i', $list[$key]['create']);
			} else {
				$list[$key]['time'] = date('Y年m月d日 H:i', $list[$key]['create']);
			}
			
			//解析＠账号
			$list[$key]['content'] .= ' ';
			$pattern = '/(@\S+)\s/i';
			$list[$key]['content'] = preg_replace('/(@\S+)\s/i','<a href="'.__ROOT__.'/$1" class="space" target="_blank" >$1</a>',$list[$key]['content']);
		}
		return $list;
	}
}