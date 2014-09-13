<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>微博--首页</title>
<link rel="stylesheet" href="/weibo/Public/Home/css/index.css">
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.ui.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/index.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/rl_exp.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/june_pic.js"></script>
<link rel="stylesheet" href="/weibo/Public/Home/css/jquery.ui.css">
<link rel="stylesheet" href="/weibo/Public/Home/uploadify/uploadify.css">
<link rel="stylesheet" href="/weibo/Public/Home/css/rl_exp.css" />
</head>
<body>

<div id="header">
	<div class="header_main">
		<div class="logo">微博系统</div>
		<div class="nav">
			<ul>
				<li class="selected"><a href="#">首页</a></li>
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
						<dd><a href="#">个人设置</a></dd>
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
	
	<script>
		var	THINKPHP={
			'img': '/weibo/Public/Home/images',
			'module':'/weibo/Home',
			'uploadify':'/weibo/Public/Home/uploadify',
			'uploader':'<?php echo U("File/upload");?>',
			'root':'/weibo',
			'unfold':[],
		}
	</script>
	<div class="main_left">
		<form class="weibo_form">
			<span class="left">和大家一起分享点新鲜事吧</span>
			<span class="right num">还可以输入<strong>140</strong>字</span>
			<textarea class="text" name="content" id="rl_exp_input"></textarea>
			<a href="javascript:void(0);" id="rl_exp_btn" class="face">表情<span class="face_arrow_top"></span></a>
			<div class="rl_exp" id="rl_bq" style="display:none;">
				<ul class="rl_exp_tab clearfix">
					<li><a href="javascript:void(0);" class="selected">默认</a></li>
					<li><a href="javascript:void(0);">拜年</a></li>
					<li><a href="javascript:void(0);">浪小花</a></li>
					<li><a href="javascript:void(0);">暴走漫画</a></li>
				</ul>
				<ul class="rl_exp_main clearfix rl_selected"></ul>
				<ul class="rl_exp_main clearfix" style="display:none;"></ul>
				<ul class="rl_exp_main clearfix" style="display:none;"></ul>
				<ul class="rl_exp_main clearfix" style="display:none;"></ul>
				<a href="javascript:void(0);" class="close">×</a>
			</div>
			<a href="javascript:void(0);" class="pic" id="pic_btn">图片<span class="pic_arrow_top"></span></a>
			<div class="weibo_pic_box" id="pic_box">
				<div class="weibo_pic_header">
					<span class="weibo_pic_ino">共 <span class="uploadTotal"></span> 张，还能上传 <span class="uploadLimit"></span> 张（按住ctrl键可选择多张）</span>
					<a href="javascript:void(0);" class="close">×</a>				
				</div>
				<div class="weibo_pic_list">
				</div>
				<input type="file" name="file" id="file"/>
			</div>
			<input type="button" value="发布" class="button" />
		</form>
		
		
		<div class="weibo_content">
			<ul>
				<li><a href="javascript:void(0)" class="selected">我关注的<i class="nav_arrow"></i></a></li>
				<li><a href="javascript:void(0)">互听的</a></li>
			</ul>
			<?php if(is_array($topicList)): $k = 0; $__LIST__ = $topicList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($k % 2 );++$k;?><dl class="weibo_content_data">
					<dt class="face"><a href="javascript:void(0)"><img src="/weibo/Public/Home/images/small_face.jpg" alt="" ></a></dt>
					<dd class="content">
						<h4><a href="javascript:void(0)"><?php echo ($obj["username"]); ?></a></h4>
						<p><?php echo ($obj["content"]); echo ($obj["content_over"]); ?></p>					
						<?php switch($obj["count"]): case "0": break;?>
							<?php case "1": ?><div class="oneImage"><img src="/weibo/<?php echo ($obj['images'][0]['thumb']); ?>" alt="" /></div>
								<div class="image_zoom" style="display:none;">
									<ol>
										<li><a href="javascript:void(0)" class="image_zoom_in">收起</a></li>
										<li ><a target="_blank" class="image_zoom_source" href="/weibo/<?php echo ($obj['images'][0]['source']); ?>">原图</a></li>
									</ol>
									<img source="/weibo/<?php echo ($obj['images'][0]['unfold']); ?>" src="/weibo/Public/Home/images/loading_100.png" alt="" />
								</div><?php break;?>
							<?php default: ?>
									<?php if(is_array($obj["images"])): $i = 0; $__LIST__ = $obj["images"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$images): $mod = ($i % 2 );++$i;?><div class="images">
											<img src="/weibo/<?php echo ($images['thumb']); ?>" key="<?php echo ($k); ?>" alt="" unfold="/weibo/<?php echo ($images['unfold']); ?>" source="/weibo/<?php echo ($images['source']); ?>" />
										</div>
										<script>
											if(typeof THINKPHP["<?php echo ($k); ?>"] == 'undefined')THINKPHP["<?php echo ($k); ?>"]=[];
											
											if("<?php echo ($obj['images'][0]['unfold']); ?>" != ''){
												THINKPHP["<?php echo ($k); ?>"].push("/weibo/<?php echo ($images['source']); ?>")
												THINKPHP["<?php echo ($k); ?>"].push("/weibo/<?php echo ($images['unfold']); ?>")
												
											}				
										</script><?php endforeach; endif; else: echo "" ;endif; endswitch;?>
						<div class="footer">
							<span class="time">8月25日 08:35</span>
							<span class="handler">赞(0) | 转播 | 评论 | 收藏</span>
						</div>
					</dd>
				</dl><?php endforeach; endif; else: echo "" ;endif; ?>
			<div id="images_zoom">				
				<ol>
					<li ><a target="_blank" class="image_zoom_source" href="/weibo/<?php echo ($obj['images'][0]['source']); ?>">原图</a></li>
				</ol>
				<img src="/weibo/Public/Home/images/loading_100.png" alt="" />
				<div class="left">上一张</div>
				<div class="right">下一张</div>
			</div>
			<img src="/weibo/Public/Home/images/close.png" alt="" class="image_close">
					
		</div>
	</div>
	<div class="main_right">right</div>

</div>
<div id="footer">
	<div class="footer_left">&copy; 2014 ihuahua.cc All Rights Reserved.</div>
	<div class="footer_right">Powered By ThinkPHP.</div>
</div>
<div id="msg">数据交互中...</div>
</body>
</html>