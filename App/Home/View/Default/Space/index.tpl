<extend name="Base/common"/>
<block name="head">
	<link rel="stylesheet" href="__CSS__/space.css">
</block>
<block name="main">
	<div class="main_left">
		<div class="header">
			<dl>
				<dt>
					<empty name="bigFace">
						<img src="__IMG__/big.jpg" alt="头像" />
					<else/>
						<img src="__ROOT__/{$bigFace}" alt="头像" />	
					</empty>	
				</dt>
				<dd class="username">{$user['username']}</dd>
				<dd class="intro">个人简介：{$user.extend.intro}</dd>
			</dl>
		</div>
	</div>
	<div class="main_right">
	</div>
</block>