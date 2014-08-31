<?php
return array(
		'TMPL_PARSE_STRING' => array(
			'__CSS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/css',
			'__JS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/js',
			'__IMG__'=>__ROOT__.'/Public/'.MODULE_NAME.'/images',
			'__UPLOADIFY__'=>__ROOT__.'/Public/'.MODULE_NAME.'/uploadify',
		
		),
		//默认错误跳转对应的模板文件
		'TMPL_ACTION_ERROR' => 'Public/jump',
		//默认成功跳转对应的模板文件
		'TMPL_ACTION_SUCCESS' => 'Public/jump',
		
		'FILE_UPLOAD'=>array(
				'maxSize'=>3145728,
				'rootPath'=>'Uploads/',
				'saveName'=>array('uniqid',time()),
				'exts'    =>array('jpg', 'gif', 'png', 'jpeg'),
				'autoSub' =>true,
				'subName' =>array('date','Ymd'),
		),
	
		
);