<?php if (!defined('THINK_PATH')) exit(); if(is_array($topicList)): $k = 0; $__LIST__ = $topicList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($k % 2 );++$k;?><dl class="weibo_content_data">
		<dt class="face"><a href="javascript:void(0)"><img src="/weibo/Public/Home/images/small_face.jpg" alt="" ></a></dt>
		<dd class="content">
			<h4><a href="javascript:void(0)"><?php echo ($obj["username"]); ?></a></h4>
			<p style="padding:5px 0 0 0"><?php echo ($obj["content"]); ?></p>					
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
								<img class="show_unfold_pic" src="/weibo/<?php echo ($images['thumb']); ?>" key="ajax_<?php echo ($obj["username"]); ?>_<?php echo ($obj["create"]); ?>" alt="" unfold="/weibo/<?php echo ($images['unfold']); ?>" source="/weibo/<?php echo ($images['source']); ?>" />
							</div>
							<script>
								if(typeof THINKPHP["ajax_<?php echo ($obj["username"]); ?>_<?php echo ($obj["create"]); ?>"] == 'undefined')THINKPHP["ajax_<?php echo ($obj["username"]); ?>_<?php echo ($obj["create"]); ?>"]=[];
								
								if("<?php echo ($obj['images'][0]['unfold']); ?>" != ''){
									THINKPHP["ajax_<?php echo ($obj["username"]); ?>_<?php echo ($obj["create"]); ?>"].push("/weibo/<?php echo ($images['source']); ?>")
									THINKPHP["ajax_<?php echo ($obj["username"]); ?>_<?php echo ($obj["create"]); ?>"].push("/weibo/<?php echo ($images['unfold']); ?>")
									
								}				
							</script><?php endforeach; endif; else: echo "" ;endif; endswitch;?>
			<div class="footer">
				<span class="time"><?php echo ($obj['time']); ?></span>
				<span class="handler">赞(0) | 转播 | 评论 | 收藏</span>
			</div>
		</dd>
	</dl><?php endforeach; endif; else: echo "" ;endif; ?>