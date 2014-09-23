<?php
return array(
		
		
	//设置可访问目录
	'MODULE_ALLOW_LIST'=>array('Home','Admin'),
	//设置默认目录
	'DEFAULT_MODULE'=>'Home',
	//开启调试模式
	'show_page_trace'=>true,
	//设置模版后缀
	'TMPL_TEMPLATE_SUFFIX'=>'.tpl',
	//设置默认主题目录
	'DEFAULT_THEME'=>'Default',
	//设置重写模式
	'URL_MODEL'=>2,
	//加密公钥
	'encrypy_key'=>'ihuahua.cc',
		
	//数据库配置参数
	'DB_TYPE'=>'pdo',
	'DB_USER'=>'root',
	'DB_PWD'=>'ABC201314',
	'DB_PREFIX'=>'weibo_',
	'DB_DSN'=>'mysql:host=localhost;dbname=weibo;charset=utf8',
		
);
