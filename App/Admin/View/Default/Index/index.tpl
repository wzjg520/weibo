<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>微博--后台</title>

<link rel="stylesheet" type="text/css" href="__EASYUI__/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="__EASYUI__/themes/icon.css" />

<style>
.logo{
	width:200px;
	height:70px;
	line-height:70px;
	color:#fff;
	font-size:20px;
	font-weight:bold;
	float:left;
	text-align:center;
}
.logout{
	float:right;
	padding:40px 20px 0 0;
	color:#fff;
	font-size:12px;
	font-weight:bold;
}
.logout a{
	color:red;
	text-decoration:none;
}
.logout a:hover{
	text-decoration:underline;
}
#nav{
	padding:10px;
}
</style>

</head>
<body class="easyui-layout">
	 <div data-options="region:'north',title:'North Title',split:true,noheader:true" style="height:80px;background:#666;">
		<div class="logo">微博管理</div>
		<div class="logout">您好，{:session('admin')} | <a href="{:U('Login/out')}">退出</a></div>
	</div>   
    <div data-options="region:'south',title:'buttom',split:true,noheader:true" style="height:50px;line-height:40px;text-align:center;">
		©2014-2015 爱花花网络工作室. Powered by ThinkPHP and EasyUI.
	</div>    
    <div data-options="region:'west',title:'导航',split:true" style="width:180px;">
		<ul id="nav"></ul>
	</div>   
    <div data-options="region:'center',title:'center title'" style="padding:5px;background:#eee;"></div>   
</body>

<script>
	THINKPHP = {
			'module' : '__MODULE__'
	}
</script>
<script type="text/javascript" src="__EASYUI__/jquery.min.js"></script>
<script type="text/javascript" src="__EASYUI__/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__EASYUI__/locale/easyui-lang-zh_CN.js" ></script>
<script type="text/javascript" src="__JS__/index.js"></script>
</html>