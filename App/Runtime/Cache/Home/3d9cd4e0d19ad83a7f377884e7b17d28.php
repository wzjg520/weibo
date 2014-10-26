<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo ($msgTitle); ?></title>

<style>
body{
	background:url(/weibo/Public/<?php echo MODULE_NAME;?>/images/weibo_bg.jpg)	
}
.info{
	width:800px;
	height:140px;
	padding:100px 0 0 0;
	margin:100px auto;
	background:#fff;
	border-radius:4px;
	text-align:center;
	box-shadow:0 0 5px #ccc;
}
.text{
	font-size:32px;
	font-weight:bold;
	display:inline-block;
	text-indent:45px;
}
.error{
	background:url(/weibo/Public/<?php echo MODULE_NAME;?>/images/jump_error.png) no-repeat left center;
}
.success{
	background:url(/weibo/Public/<?php echo MODULE_NAME;?>/images/jump_success.png) no-repeat left center;
}
.jump{
	padding:50px 25px 0 0;
	text-align:right;
}
a{
	color:#06f;
	text-decoration:none;
}
a:hover{
	color:#f60;
}
</style>
</head>
<body>
<div class="info">
<?php
if ($status){ ?>
<span class="text success"><?php echo ($message); ?></span>
<?php
}else{ ?>
<span class="text error"><?php echo ($error); ?></span>

<?php
} ?>
<p class="jump">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>