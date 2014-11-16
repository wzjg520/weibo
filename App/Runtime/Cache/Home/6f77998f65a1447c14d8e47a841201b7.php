<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>微博 --登陆</title>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.ui.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.form.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.validate.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/login.js"></script>
<link rel="stylesheet" href="/weibo/Public/Home/css/jquery.ui.css">
<link rel="stylesheet" href="/weibo/Public/Home/css/login.css">
<script type="text/javascript">
	var	THINKPHP={
		img:'/weibo/Public/Home/images',
		module:'/weibo/Home',
		index:'<?php echo U("Index/index");?>',
		login:'<?php echo U("User/login");?>',
	} 
</script>
</head>
<body>
	<div id="header"></div>
	<div id="main">
		<form id="login">
			<span class="username">
				<input type="text" class="text" name="username" id="username" placeholder="账号/邮箱"/>
				
			</span>
			<span class="password">
				<input type="password" class="text" placeholder="密码" name="password"/>
				<label id="auto"><input type="checkbox" name="auto" value="on"/>自动登录</label>
			</span>
			
			<input type="submit" class="submit" name="send" id="button"  value="提交"/>
		</form>
		<div class="bottom"><a class="reg" href="javascript:void(0)">注册新用户</a><a href="javascript:void(0)" class="fing_lost">找回密码</a></div>
	</div>
	
	<div id="footer">
	</div>
	<p id="footer_text">爱花花技术博客 <small>ihuahua.cc designed by june</small></p>
	<form id="reg_form">
		<ol class="errors"></ol>
		<p>
			<label for="username">用户：</label>
			<input type="text" id="username" class="text" name="username" placeholder="必填，2-20位之间" />
			<span class="star">*</span>
		</p>
		<p>
			<label for="password">密码：</label>
			<input type="password" id="password" class="text" name="password" placeholder="必填，6-20位之间" />
			<span class="star">*</span>
		</p>
		<p>
			<label for="username">确认：</label>
			<input type="password" id="repassword" class="text" name="repassword" placeholder="必填，必须和密码一致" />
			<span class="star">*</span>
		</p>
		<p>
			<label for="email">邮箱：</label>
			<input type="text" class="text" id="email" name="email" placeholder="必填，用于找回密码" />
			<span class="star">*</span>
		</p>
	</form>
	<div id="loading">数据交互中...</div>
	<form id="verify_form">
		<ol class="errors"></ol>
		<p>
			<label for="verify">验证码：</label>
			<input type="text" id="verify" class="text" name="verify" placeholder="必填，必须图片中的字符一致" />
			<span class="star">*</span>
		</p>
		<p>
			<a href="javascript:void(0)" class="changeImg">看不清，换一张</a>
			<img class="verifyImg" src="<?php echo U('verify');?>"/>
		</p>
	</form>
</body>
</html>