<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>微博--首页</title>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.ui.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/base.js"></script>
<link rel="stylesheet" href="/weibo/Public/Home/css/jquery.ui.css">
<link rel="stylesheet" href="/weibo/Public/Home/css/base.css">

	<link rel="stylesheet" href="/weibo/Public/Home/css/set.css">
	<script type="text/javascript" src="/weibo/Public/Home/js/set.js"></script>

<script>
		var	THINKPHP={
			'img': '/weibo/Public/Home/images',
			'module':'/weibo/Home',
			'uploadify':'/weibo/Public/Home/uploadify',
			'indexImg':'<?php echo U("File/indexImg");?>',
			'avatar':'<?php echo U("File/avatar");?>',
			'root':'/weibo',
		}
</script>
</head>
<body>
<div id="header">
	<div class="header_main">
		<div class="logo">微博系统</div>
		<div class="nav">
			<ul>
				<li class="selected"><a href="<?php echo U('Index/index');?>">首页</a></li>
				<li><a href="#">图片</a></li>
				<li><a href="#">广场</a></li>
				<li><a href="#">找人</a></li>
			</ul>
		</div>
		<div class="person">
			<ul>
				<li><a href="#">蜡笔小新</a></li>
				<li class="app">消息
					<dl class="list">
						<dd><a href="#">@提到我的</a></dd>
						<dd><a href="#">收到的评论</a></dd>
						<dd><a href="#">发出的评论</a></dd>
						<dd><a href="#">我的私信</a></dd>
						<dd><a href="#">系统消息</a></dd>
						<dd><a href="#" class="line">发私信&gt;&gt;</a></dd>
					</dl>
				</li>
				<li class="app">账号
					<dl class="list">
						<dd><a href="<?php echo U('Set/index');?>">个人设置</a></dd>
						<dd><a href="#">申请认证</a></dd>
						<dd><a href="#">排行榜</a></dd>
						<dd><a href="<?php echo U('User/logout');?>" class="line">退出&gt;&gt;</a></dd>
					</dl>
				</li>
			</ul>
		</div>
		<div class="search">
			<form action="" method='post'>
				<input type="text" id="search" placeholder="请输入微博关键字" />
				<a href="javascript:void(0)"></a>
			</form>
		</div>	
	</div>
</div>
<div id="main">
	
	<div class="main_left">
		<ul>
			<li><a href="<?php echo U('Set/index');?>">个人设置</a></li>
			<li><a href="<?php echo U('Set/avatar');?>">头像设置</a></li>
		</ul>
	</div>
	<div class="main_right">
		<h2>个人设置</h2>
		<hr/>
		<dl>
			<dd>账号名称：<?php echo ($user['username']); ?></dd>
			<dd>邮箱地址：<input type="text" name="email" value="<?php echo ($user['email']); ?>" class="text"/></dd>
			<dd><span >个人简介：</span><textarea name="intro"><?php echo ($user['extend']['intro']); ?></textarea></dd>
			<dd><input type="submit" name="send"  class="button" value="修改"/></dd>
		</dl>
	</div>

</div>
<div id="footer">
	<div class="footer_left">&copy; 2014 ihuahua.cc All Rights Reserved.</div>
	<div class="footer_right">Powered By ThinkPHP.</div>
</div>
<div id="msg"></div>
</body>
</html>