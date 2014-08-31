<?php
//检测验证码
function checkVerify($code){
	$Verify= new Think\Verify();
	$Verify->reset=false;
	return $Verify->check($code);
}
//cookie加密0:加密；1:解密
function encrypy($username,$type=0){
	$key=sha1(C('encrypy_key'));
	if(!$type){
		return base64_encode($username ^ $key);
	}
	$username=base64_decode($username);
	return $username ^ $key;
}