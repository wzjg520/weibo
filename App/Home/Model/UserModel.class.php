<?php
namespace Home\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel{
	protected $_validate = array(
		//-1,'帐号长度不合法！'
		array('username', '/^[^@]{2,20}$/i', -1, self::EXISTS_VALIDATE,'length'),
		//-2,'密码长度不合法！'
		array('password', '6,30', -2, self::EXISTS_VALIDATE,'length'),
		//-3,'密码和密码确认不一致！'
		array('repassword', 'password', -3, self::EXISTS_VALIDATE,'confirm'),
		//-4,'邮箱格式不正确！'
		array('email', 'email', -4, self::EXISTS_VALIDATE),	
		//-5,'帐号被占用！'
		array('username', '', -5, self::EXISTS_VALIDATE, 'unique', self::MODEL_INSERT),
		//-6,'邮箱被占用！'
		array('email', '', -6, self::EXISTS_VALIDATE, 'unique', self::MODEL_INSERT),
		//-7,'验证验证码'
		array('verify','checkVerify','-7',self::EXISTS_VALIDATE,'function'),
		//-8,登陆用户名长度不合法
		array('login_username','2,50',-8,self::EXISTS_VALIDATE,'length'),
		array('login_username','email','noemail',self::EXISTS_VALIDATE,)
	);
	//自动完成
	protected $_auto = array (
		array('password','sha1',self::MODEL_BOTH,'function') , 
		array('create','time',self::MODEL_INSERT,'function')
	);
	//一对一关联模型
	protected $_link=array(
		'extend'=>array(
			'mapping_type' => self::HAS_ONE,
			'class_name'=>'UserExtend',
			'foreign_key'=>'uid',
			'mapping_fields'=>'intro',
		),
	); 
	//注册数据
	public function register($username,$password,$email){
		$data=array(
			'username'=>$username,
			'password'=>$password,
			'email'=>$email,
		);
		if($this->create($data)){
			$flag=$this->add();
			return $flag ? $flag : 0;
		}else{
			return $this->getError();
		}
	}
	//登录验证
	public function login($username,$password,$auto){
		$data=array(
			'login_username' => $username,
			'login_password' => $password,
		);
		$map=array();
		if($this->create($data)){
			$map['email']=$username;		//邮箱验证
		}else{
			if($this->getError()=='noemail'){
				$map['username']=$username;		//账号验证
			}else{
				return $this->getError();
			}
		}
		
		//验证密码
		$user=$this->field('id,password,last_login,username,face,domain')->where($map)->find();
		if($user['password']==sha1($password)){
			
			//登录验证后写入登录信息
			$update = array(
					'id'=>$user['id'],
					'last_login'=>NOW_TIME,
					'last_ip'=>get_client_ip(1),
			);
			$this->save($update);
			
			//登陆后写入session
			$auth=array(
				'username'=>$user['username'],
				'last_login'=>NOW_TIME,
				'id'=>$user['id'],
				'face'=>json_decode($user['face']),
				'domain'=>$user['domain'],
			);
			
			session('auth',$auth);
			//写入cookie
			if($auto=='on'){
				cookie('auto',encrypy($user['username']).'|'.get_client_ip(1),3600*24*30);
			}
			return $user['id'];
		}else{
			return -9;	//账号或密码错误
		}
	}
	//一对一关联获得用户信息
	public function getUser($id=0){
		if($id){
			$map['id']=$id;
		}else{
			$map['id']=session('auth')['id'];
		}		
		$user=$this->relation(true)->field('id,username,email,face,domain')->where($map)->find();
		if(!is_array($user['extend'])){
			$UserExtend=M('UserExtend');
			$data=array(
				'uid'=>session('auth')['id'],
			);
			$UserExtend->add($data);
		}
		return $user;
	}
	//通过域名获得用户信息
	public function getUserByDomain($domain){
		$map['domain']=$domain;
		return $this->relation(true)->field('id,username,email,domain,face')->where($map)->find();
	}
	//获得用户头像
	public function getFace(){
		$map['id']=session('auth')['id'];
		return $this->where($map)->field('face')->find();
	}
	//一对一关联修改数据用户信息
	public function update($email,$intro){
		$map['id']=session('auth')['id'];
		$data=array(
			'email'=>$email,
			'extend'=>array(
				'intro'=>$intro,
			),
		);
		
		return $this->relation(true)->where($map)->save($data);
	}
	//修改用户头像信息
	public function updateFace($path){
		$map['id']=session('auth')['id'];
		$data=array(
			'face'=>$path,
		);
		$_SESSION['auth']['face']=json_decode($path);
		return $this->where($map)->save($data);
	}
	//设置用户域名
	public function setDomain($domain){
		$map['id']=session('auth')['id'];
		$data=array(
			'domain'=>$domain,
		);
		return $this->where($map)->save($data);
	}
	//ajax验证字段时候重复
	public function checkFields($field,$type){
		$data=array();
		switch ($type){
			case 'username':
				$data['username']=$field;
				break;
			case 'email':
				$data['email']=$field;
				break;
			case 'verify':
				$data['verify']=$field;
				break;
			default:
				return 0;
		}
		return $this->create($data) ? 1 : $this->getError();
	}
}