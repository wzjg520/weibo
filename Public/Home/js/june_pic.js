/**
 * 图片上传插件
 */
$(function(){
	var pic={
		uploadTotal:0,
		uploadLimit:8,
		init:function(){
			
			$("#pic_btn").bind('click',function(){
				var w = $(this).position();				
				pic.uploadify();
				$('.uploadTotal').text(pic.uploadTotal)	
				$('.uploadLimit').text(pic.uploadLimit);
				$('.pic_arrow_top').show();
				$('#pic_box').css({left:w.left,top:w.top+30}).show();
			});
			//绑定关闭按钮
			$('.weibo_pic_header a.close').on('click',function(){
				$('#pic_box').hide();
				$('.pic_arrow_top').hide();
			});
/*
			$(document).on('click',function(e){
				var target = $(e.target)
				if(target.closest('#pic_btn').length==1 || target.closest('.weibo_pic_content .remove').length == 1)return ;
				if(target.closest('#pic_box').length==0){
					$('#pic_box').hide();
					$('.pic_arrow_top').hide();
				}
				
			})
*/
			
		},
		uploadify:function(){
			$('#file').uploadify({
				uploader:THINKPHP['uploader'],
				swf : THINKPHP['uploadify'] + '/uploadify.swf',
				width:120,
				height:35,
				fileTypeDesc:'图片类型',
				buttonCursor:'pointer',
				buttonText:'上传图片',
				fileSizeLimit:'1MB',
				fileTypeExts:'*.jpeg; *.jpg; *.gif; *.png;',
				overrideEvents:['onSelectError','onSelect','onDialogClose'],
				onSelectError:function(file,errorCode,errorMsg){
					switch(errorCode){
						case -110:
							$('#msg').css('background','url('+THINKPHP['img']+'/error.png) no-repeat 20px center').html('不能超过了1M!').dialog('open');
							setTimeout(function(){
								$('#msg').dialog('close');
							},1000)
							break;
					}
				},
				onUploadStart:function(){
					if(pic.uploadTotal==8){
						$('#file').uploadify('stop');
						$('#file').uploadify('cancel');
						$('#msg').css('background','url('+THINKPHP['img']+'/error.png) no-repeat 20px center').html('不能超过了8张!').dialog('open');
						setTimeout(function(){
							$('#msg').dialog('close');
						},1000)
					}else{
						$(".weibo_pic_list").append('<div class="weibo_pic_content"><span class="shadow"></span><span class="remove">删除</span><img class="weibo_pic_thumb"  alt="" /><img src="'+THINKPHP['img']+'/loading_100.png" class="weibo_pic_thumb"></div>');
					}
					
				},
				
				onUploadSuccess:function(file,data,response){
					$(".weibo_pic_list").append('<input type="hidden" name="images" value='+data+'/>');
					var imgUrl=$.parseJSON(data);
					pic.thumb(imgUrl.thumb)
					pic.hover();
					pic.remove();
					pic.uploadTotal++;
					pic.uploadLimit--
					$('.uploadTotal').text(pic.uploadTotal)	
					$('.uploadLimit').text(pic.uploadLimit);				
				}
			})
		},
		
		remove:function(){
			var remove=$('.weibo_pic_content .remove');
			var len=$('.weibo_pic_content .remove').length;
			$(remove[len-1]).on('click',function(e){
				$(this).parent().next('input[name="images"]').remove();
				$(this).parent().remove();
				pic.uploadTotal--
				pic.uploadLimit++
				$('.uploadTotal').text(pic.uploadTotal)	
				$('.uploadLimit').text(pic.uploadLimit);
			})
		},
		
		hover:function(){
			var img=$('.weibo_pic_content');
			var len=$('.weibo_pic_content').length;		
			$(img[len-1]).hover(function(){
				$(this).find('.shadow').stop().fadeIn();
				$(this).find('.remove').stop().fadeIn();			
			},function(){
				$(this).find('.shadow').fadeOut();
				$(this).find('.remove').fadeOut();
			})
		},
		
		thumb:function(src){
			var len=$('.weibo_pic_thumb').length;
			var img=$('.weibo_pic_thumb');
			$(img[len-1]).attr('src',THINKPHP['root']+'/'+src).hide();
			setTimeout(function(){
				if ($(img[len - 1]).width() > 100) {
					$(img[len - 1]).css('left', -($(img[len - 1]).width() - 100) / 2);
				}
				if ($(img[len - 1]).height() > 100) {
					$(img[len - 1]).css('top', -($(img[len - 1]).height() - 100) / 2);
				}
				$(img[len-1]).fadeIn();
			},50)
		},
	}
	
	pic.init();
	
	//图片数量重置
	window.resetCount={
		clear:function(){
			pic.uploadTotal=0
			pic.uploadLimit=8
		}
	}
})
