<extend name="Base/common"/>
<block name="head">
	<link rel="stylesheet" href="__CSS__/set.css">
	<script type="text/javascript" src="__JS__/set.js"></script>
</block>
<block name="main">
	<div class="main_left">
		<ul>
			<li><a href="{:U('Set/index')}" class="selected">个人设置</a></li>
			<li><a href="{:U('Set/avatar')}">头像设置</a></li>
			<li><a href="{:U('Set/domain')}">个性域名</a></li>
		</ul>
	</div>
	<div class="main_right">
		<h2>个人设置</h2>
		<hr/>
		<dl>
			<dd>账号名称：{$user['username']}</dd>
			<dd>邮箱地址：<input type="text" name="email" value="{$user['email']}" class="text"/></dd>
			<dd><span >个人简介：</span><textarea name="intro">{$user['extend']['intro']}</textarea></dd>
			<dd><input type="submit" name="send"  class="button" value="修改"/></dd>
		</dl>
	</div>
</block>