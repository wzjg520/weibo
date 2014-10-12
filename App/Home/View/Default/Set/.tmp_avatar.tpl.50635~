<extend name="Base/common"/>
<block name="head">
	<link rel="stylesheet" href="__CSS__/jquery.Jcrop.css" type="text/css" />
	<link rel="stylesheet" href="__UPLOADIFY__/uploadify.css">
	<link rel="stylesheet" href="__CSS__/set.css">
	<script type="text/javascript" src="__UPLOADIFY__/jquery.uploadify.min.js"></script>
	<script src="__JS__/jquery.Jcrop.js"></script>
	<script type="text/javascript" src="__JS__/set.js"></script>
</block>
<block name="main">
	<div class="main_left">
		<ul>
			<li><a href="{:U('Set/index')}">个人设置</a></li>
			<li><a href="{:U('Set/avatar')}" class="selected">头像设置</a></li>
			<li><a href="{:U('Set/domain')}">个性域名</a></li>
		</ul>
	</div>
	<div class="main_right">
		<h2>头像设置</h2>
		<hr/>
		<p>请上传一张大小不低于200*200px的头像图片</p>
		<div class="avatar">
			<empty name="bigFace">
				<img id="face" src="__IMG__/big.jpg" id="face" alt="" />
			<else/>
				<img id="face" src="__ROOT__/{$bigFace}" id="face" alt="" />
			</empty>		
			<span id="preview_box"><img id="jcrop_preview" src="__IMG__/big.jpg" alt="头像" /></span>
			<a href="javascript:;" class="save" style="margin:10px 0 0 0;display:none;">保存</a>
			<a href="javascript:;" class="cancel" style="margin:10px 0 0 0;display:none;">取消</a>
			<input type="hidden" id="x" name="x">
			<input type="hidden" id="y" name="y">
			<input type="hidden" id="w" name="w">
			<input type="hidden" id="h" name="h">
			<input type="hidden" id="url" name="url">
			<input type="file" name="file" id="file" />
		</div>
	</div>
</block>