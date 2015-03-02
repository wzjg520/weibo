<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>微博--后台</title>

<link rel="stylesheet" type="text/css" href="__EASYUI__/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="__EASYUI__/themes/icon.css" />

<style type="text/css">
#login p{
	padding:5px 10px;
}
#login p label{
	width:60px;
	font-size:12px;
	display:inline-block;
}
.l-btn-text{
	padding:0 10px;
}
.textbox{
	height:20px;
	line-height:20px;
}
</style>
</head>
<body>

<div style="display:none;">
	<div id="login">
		<p><label for="manager">用户名：</label><input type="text" name="manager" id="manager" class="textbox" /></p>
		<p><label for="password">密码：</label><input type="password" name="password" id="password" class="textbox"/></p>
	</div>
	<div id="btn">
		<a href="javascript:;"  class="easyui-linkbutton">登陆</a>
	</div>
</div>
	
</body>
<script>
var	THINKPHP={
		'img': '__IMG__',
		'module':'__MODULE__',
		'index':'{:U("Index/index")}',
		'root':'__ROOT__',
	}
</script>
<script type="text/javascript" src="__EASYUI__/jquery.min.js"></script>
<script type="text/javascript" src="__EASYUI__/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__EASYUI__/locale/easyui-lang-zh_CN.js" ></script>
<script type="text/javascript" src="__JS__/login.js"></script>
</html>