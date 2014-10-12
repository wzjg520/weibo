<extend name="Base/common"/>
<block name="head">
	<link rel="stylesheet" href="__CSS__/set.css">
	<script type="text/javascript" src="__JS__/set.js"></script>
</block>
<block name="main">
	<div class="main_left">
		<ul>
			<li><a href="{:U('Set/index')}">个人设置</a></li>
			<li><a href="{:U('Set/avatar')}">头像设置</a></li>
			<li><a href="{:U('Set/domain')}" class="selected">个性域名</a></li>
		</ul>
	</div>
	<div class="main_right">
		<h2>个性域名设置</h2>
		<hr/>
		<dl class="domain">
			<dd>个性域名必须是由长度4到10位之间的数字，或字母组成，且未被注册，一经注册不得更改。</dd>
			<empty name="domain">
				<dd><input type="text" name="domain" class="domain_text" value="{$domain}" /> <strong style="color:red;line-height:25px;">*</strong></dd>
				<dd><input type="submit" name="send" value="设置域名" class="submit" /></dd>
				<else/>
				您的个性域名地址为：<a href="__ROOT__/june/{$domain}" target="_blank">http://{:$_SERVER['SERVER_NAME']}__ROOT__/june/{$domain}</a>
			</empty>
		</dl>
	</div>
</block>