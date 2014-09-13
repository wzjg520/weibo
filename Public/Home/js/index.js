$(function(){
	//微博高度保持一致
	keepAlign();
	//微博图片获得焦点
	for (var i = 0; i < $('.images img').length; i++) {
		if ($('.images img').eq(i).width() > 120) {
			$('.images img').eq(i).css('left', -($('.images img').eq(i).width() - 120) / 2);
		} else {
			$('.images img').eq(i).width(120);
		}
		if ($('.images img').eq(i).height() > 120) {
			$('.images img').eq(i).css('top', -($('.images img').eq(i).height() - 120) / 2);
		} else {
			$('.images img').eq(i).height(120);
		}
	}
	//图片点击放大
	$('.oneImage img').click(function(){
		$(this).parent().hide();
		$(this).parent().next('.image_zoom').show();
		var obj=$(this).parent().next('.image_zoom').find('img')
		obj.attr('src',obj.attr('source'));
		keepAlign();
	})
	//图片点击缩小
	$('.image_zoom_in').click(function(){
		$(this).parent().parent().parent().hide();
		$(this).parent().parent().parent().prev('.oneImage').show();
		keepAlign();
	})
	
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
	//发布微博
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
		draggable:false,
		show:'clip',
		closeOnEscape:false,
	}).parent().find('.ui-widget-header').hide();
	//多图浏览放大
	$('#images_zoom').dialog({
		minWidth:580,
		minHeight:20,
		autoOpen:false,
		modal:true,
		resizable:false,
		draggable:false,
		closeOnEscape:true,
	}).parent().find('.ui-widget-header').hide();
	$('#images_zoom').dialog('widget').css({
		'background':'#fafafa',
		'position' : 'fixed',
		'z-index' : 10000,		
	})
	$('.images img').click(function(){
		var _this=this,
		src=$(this).attr('unfold'),
		sourceSrc=$(this).attr('source'),
		k=$(this).attr('key')
		imgLoadEvent(function(obj){
				$('#images_zoom').dialog('open').dialog({
					height: obj.h + 60,
				})
				$('#images_zoom img').attr('src', src)
				$('#images_zoom .image_zoom_source').attr('href',sourceSrc)
				var top = $('#images_zoom').dialog('widget').position().top, left = $('#images_zoom').dialog('widget').position().left;
				$('.image_close').css({
					'position': 'fixed',
					'left': left + 570,
					'top': top - 12,
					'z-index': 10001,
					'display': 'block',
				}).click(function(){
					$(this).hide();
					$('#images_zoom').dialog('close');
				})
				//显示图片翻页
				$('#images_zoom .left,#images_zoom .right').css({
					top: $('#images_zoom').dialog('option', 'height') / 2 - 35,
					'height': 70,
					'border-radius': 8,
					'border-radius': 8,
					'width': 150,
				}).hover(function(){
					$(this).stop().animate({
						opacity: 0.7,
					})
				}, function(){
					$(this).stop().animate({
						opacity: 0,
					})
				})
				//图片翻页
				var imgSourceRight = THINKPHP[k].concat([]), 
					imgSourceLeft = THINKPHP[k].reverse();
				$('#images_zoom .left').click(function(){					
					$(imgSourceLeft).each(function(i, v){
						
						if (v == src) {													
							if(i==imgSourceLeft.length-2){
								var url=imgSourceLeft[0],
								sourceUrl=imgSourceLeft[1]
							}else{
								var url=imgSourceLeft[i+2],
								sourceUrl=imgSourceLeft[i+2]
							}
							console.log(url+'+++++'+sourceUrl)
							console.log(imgSourceLeft)						
							pic(url,sourceUrl)
							src=url
							return false;							
						}
					})
				})
				$('#images_zoom .right').click(function(){
					$(imgSourceRight).each(function(i, v){						
						if (v == src) {					
							if(i==imgSourceRight.length-1){
								var url=imgSourceRight[1],
								sourceUrl=imgSourceRight[0]
							}else{
								var url=imgSourceRight[i+2],
								sourceUrl=imgSourceRight[i+2]
							}
							pic(url,sourceUrl)
							src=url;
							return false;
						}
					})
				})
				keepAlign();
			}, src);
		
	})
	
	
	
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
//屏幕高度保持一致
function keepAlign(){
	if ($('.main_left').height() > 800) {
		$('.main_right').height($('.main_left').height() + 30);
		$('#main').height($('.main_left').height() + 30);
	}
}

//通过URL得到图片的长和高
function imgLoadEvent(callback, url) {//圖片事件加載
	var img = new Image();
	img.onreadystatechange = function () {
		if (this.readyState == "complete") {
			callback({ "w": img.width, "h": img.height });
		}
	}
	img.onload = function () {
	if (this.complete == true)
		callback({ "w": img.width, "h": img.height });
	}
	img.onerror = function () {
		callback({ "w": 0, "h": 0 });
	}
	img.src = url;
}
//图片翻页
function pic(url,sourceUrl){
	imgLoadEvent(function(obj){
		$('#images_zoom').dialog({
			height: obj.h + 60,
		})
		$('#images_zoom img').attr('src', url)
		$('#images_zoom .image_zoom_source').attr('href',sourceUrl)
		var top = $('#images_zoom').dialog('widget').position().top, 
		left = $('#images_zoom').dialog('widget').position().left;
		$('.image_close').css({
			'position': 'fixed',
			'left': left + 570,
			'top': top - 12,
		})
		$('#images_zoom .left,#images_zoom .right').css({
			'top': $('#images_zoom').dialog('option', 'height') / 2 - 35,
			'height': 70,
			'border-radius': 8,
			'border-radius': 8,
			'width': 150,
		})
																			
	},url)
}