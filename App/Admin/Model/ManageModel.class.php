<?php
namespace Admin\Model;
use Think\Model;

class ManageModel extends Model{
	
	//管理员账号自动验证
	protected $_validate = array(
			//-1账号长度不合法
			array('manage', '/^[^@]{2,20}$/', -1, self::EXISTS_VALIDATE),
			//-2密码长度不合法
			array('password', '6,30', -2, self::EXISTS_VALIDATE, 'length')
	);
	
	//检测登陆信息
	public function checkManager($manager, $password){
		$data = array(
				'manager'=>$manager,
				'password' => $password
		);
		
		if($this->create($data)){
			$map['manager'] = $manager;
			$map['password'] = sha1($password);
			
			$o = $this->field('id, manager')->where($map)->find();
			if($o){
				session('admin',$o['manager']);
				
				$update = array(
						'id' => $o['id'],
						'last_login' => time(),
						'last_ip' => get_client_ip(1),
				);
				
				$this->save($update);
				return $o['id'];
			}else{
				return 0;
			}

		}else{
			return $this->getError();
		}
	}
}
