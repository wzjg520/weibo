<extend name="Base/common"/>
<block name="head">
	<link rel="stylesheet" href="__CSS__/jquery.Jcrop.css" type="text/css" />
	<link rel="stylesheet" href="__UPLOADIFY__/uploadify.css">
	<link rel="stylesheet" href="__CSS__/set.css">
	<script type="text/javascript" src="__UPLOADIFY__/jquery.uploadify.min.js"></script>
	<script src="__JS__/jquery.Jcrop.js"></script>
	<script type="text/javascript" src="__JS__/set2.js"></script>
	<style>
		#main .main_right .avatar #preview_box1{
			width:300px;
			height:300px;
			position:absolute;
			top:330px;
			right:0px;
			overflow:hidden;
		}
		#main .main_right .avatar #preview_box1 img{
			width:300px;
			height:300px;
		}
		#main .main_right .avatar #preview_box2{
			width:200px;
			height:200px;
			position:absolute;
			top:330px;
			right:310px;
			overflow:hidden;
		}
		#main .main_right .avatar #preview_box2 img{
			width:200px;
			height:200px;
		}
		#main .main_right .avatar #preview_box3{
			width:100px;
			height:100px;
			position:absolute;
			top:330px;
			right:520px;
			overflow:hidden;
		}
		#main .main_right .avatar #preview_box3 img{
			width:100px;
			height:100px;
		}
	</style>
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
				<img id="face" src="__IMG__/big.jpg" width="400px" height="400px" id="face" alt="" />
			<else/>
				<img id="face" src="__ROOT__/{$bigFace}" width="300px" height="300px"  id="face" alt="" />
			</empty>
			<span id="preview_box" style="display:block"><img id="jcrop_preview"  src="__IMG__/big.jpg" alt="头像" /></span>
			
			<span id="preview_box1"><img id="jcrop_preview1" src="__IMG__/big.jpg" alt="头像" /></span>
			<span id="preview_box2"><img id="jcrop_preview2" src="__IMG__/big.jpg" alt="头像" /></span>
			<span id="preview_box3"><img id="jcrop_preview3" src="__IMG__/big.jpg" alt="头像" /></span>		
			
			<a href="javascript:;" class="save" style="margin:10px 0 0 0;display:none;">保存</a>
			<a href="javascript:;" class="cancel" style="margin:10px 0 0 0;display:none;">取消</a>
			<input type="text" id="x" name="x">
			<input type="text" id="y" name="y">
			<input type="text" id="w" name="w">
			<input type="text" id="h" name="h">
			<input type="text" id="url" name="url">
			<input type="file" name="file" id="file" />
		</div>
	</div>
</block>