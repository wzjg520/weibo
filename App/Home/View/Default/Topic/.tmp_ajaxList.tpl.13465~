<volist name="topicList" id="obj" key="k">				
	<dl class="weibo_content_data">
		<dt class="face">
			<empty name="obj.face">
				<empty name="obj.domain">
					<a href="{:U('Space/index',array('id'=>$obj['uid']))}"><img src="__IMG__/small_face.jpg" alt="" ></a>
					<else/>
					<a href="__ROOT__/june/{$obj.domain}"><img src="__IMG__/small_face.jpg" alt="" ></a>
				</empty>				
			<else/>
				<empty name="obj.domain">
					<a href="{:U('Space/index',array('id'=>$obj['uid']))}"><img src="__ROOT__/{$obj['face']->small}" alt="2" ></a>
					<else/>
					<a href="__ROOT__/june/{$obj.domain}"><img src="__ROOT__/{$obj['face']->small}" alt="2" ></a>
				</empty>							
			</empty>
		</dt>
		<dd class="content">
			<h4>
				<empty name="obj.domain">
					<a href="{:U('Space/index',array('id'=>$obj['uid']))}">{$obj.username}</a>
					<else/>
					<a href="__ROOT__/june/{$obj.domain}">{$obj.username}</a>
				</empty>
			</h4>
			<p style="padding:5px 0 0 0">{$obj.content}</p>					
			<switch name="obj.count">
				<case value="0"></case>
				<case value="1">
					<div class="oneImage"><img src="__ROOT__/{$obj['images'][0]['thumb']}" alt="" /></div>
					<div class="image_zoom" style="display:none;">
						<ol>
							<li><a href="javascript:void(0)" class="image_zoom_in">收起</a></li>
							<li ><a target="_blank" class="image_zoom_source" href="__ROOT__/{$obj['images'][0]['source']}">原图</a></li>
						</ol>
						<img source="__ROOT__/{$obj['images'][0]['unfold']}" src="__IMG__/loading_100.png" alt="" />
					</div>
				</case>
				<default/>
						<volist name="obj.images" id="images">
															
							<div class="images">
								<img class="show_unfold_pic" src="__ROOT__/{$images['thumb']}" key="ajax_{$obj.username}_{$obj.create}" alt="" unfold="__ROOT__/{$images['unfold']}" source="__ROOT__/{$images['source']}" />
							</div>
							<script>
								if(typeof THINKPHP["ajax_{$obj.username}_{$obj.create}"] == 'undefined')THINKPHP["ajax_{$obj.username}_{$obj.create}"]=[];
								
								if("{$obj['images'][0]['unfold']}" != ''){
									THINKPHP["ajax_{$obj.username}_{$obj.create}"].push("__ROOT__/{$images['source']}")
									THINKPHP["ajax_{$obj.username}_{$obj.create}"].push("__ROOT__/{$images['unfold']}")
									
								}				
							</script>
						</volist>
			</switch>
			<div class="footer">
				<span class="time">{$obj['time']}</span>
				<span class="handler">赞(0) | 转播 | 评论 | 收藏</span>
			</div>
		</dd>
	</dl>
</volist>