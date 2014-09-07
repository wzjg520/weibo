$(function(){
	//微博高度保持一致
	if ($('.main_left').height() > 800) {
		$('.main_right').height($('.main_left').height() + 30);
		$('#main').height($('.main_left').height() + 30);
	}
	$('li.app').hover(function(){
		$(this).css({
			'background':'#fff',
			'color':'#333',
		}).find('.list').show()
	},function(){
		$(this).css({
			'background':'',
			'color':'#fff',
		}).find('.list').hide()
	})
	$('.button').button();
	$('.text').on('keyup',function(){
		checkStrLen(this);
	})
	$('.text').on('focus',function(){
		checkStrLen(this);
	})

	$('.weibo_form .button').click(function(){
		var imgPool=[],
			img=$('input[name="images"]'),
			len=img.length;
		for(var i=0;i<len;i++){
			imgPool.push($(img[i]).val());
		}
		if(imgPool.length >0 && $('.text').val()==''){
			
			$("textarea[name='content']").val('分享图片');
		}
		
		if($('.text').val()==''){
			$('#msg').css('background','url('+THINKPHP['img']+'/error.png) no-repeat 20px center').html('您还没有分享新鲜事呀！').dialog('open');
			setTimeout(function(){
				$('#msg').html('...').dialog('close');
				$('.text').focus();
			},1500)
		}else{		
			if(checkStrLen($('.text').get(0))){
				var imgPool=[],
				img=$('input[name="images"]'),
				len=img.length;
			for(var i=0;i<len;i++){
				imgPool.push($(img[i]).val());
			}
				
				$.ajax({
					url:THINKPHP['module']+'/Topic/publish',
					type:'post',
					data:{
						content:$('textarea.text').val(),
						images:imgPool,
					},
					beforeSend:function(){
						$('#msg').css({
							'background':'url('+THINKPHP['img']+'/loading.gif) no-repeat 20px center',
						}).html('正在提交中，请稍等...').dialog('open');
					},
					success:function(text){
						resetCount.clear();
						$('.weibo_pic_content').remove();
						$("input[name='images']").remove();
						$("textarea[name='content']").val('');
						$('.pic_arrow_top').fadeOut();
						$('#pic_box').fadeOut();
						
						
						$('#msg').css('background','url('+THINKPHP['img']+'/success.gif) no-repeat 20px center').html('发表成功！').dialog('open');
							setTimeout(function(){
								$('#msg').html('...').dialog('close');
							},1500) 
						}
				})
				
			}else{
				$('#msg').css('background','url('+THINKPHP['img']+'/error.png) no-repeat 20px center').html('您写的太多了！').dialog('open');
				setTimeout(function(){
					$('#msg').html('...').dialog('close');
					$('.text').focus();
				},1500)
			
			}
		}
	})
	//信息交互框
	$('#msg').dialog({
		width:230,
		height:50,
		autoOpen:false,
		modal:false,
		resizable:false,
		resizable:false,
		draggable:false,
		show:'clip',
		closeOnEscape:false,
	}).parent().find('.ui-widget-header').hide();
})
//检测输入长度
function checkStrLen(obj){
	if($(obj).val().length>0){
			var length=$(obj).val().length;
			var total=280;
			for(var i=0;i<length;i++){
				if($(obj).val().charAt(i).charCodeAt()>255){
					total=total-2;
				}else{
					total=total-1;
				}
			}
			var tmp=total/2
			if(tmp>=0){
				$('.num').html('还可以输入<strong>'+Math.abs(parseInt(tmp))+'</strong>字');
				return true;
			}else{
				$('.num').html('您已经超过了<strong class="red">'+Math.abs(parseInt(tmp))+'</strong>字');
				return false;
			}
		}else{
				$('strong').html(140)
		}
}
