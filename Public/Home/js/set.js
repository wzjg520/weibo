$(function(){
	$(".button").button().click(function(){
		$.ajax({
			url:THINKPHP['module']+'/Set/updateUser',
			type:'POST',
			data:{
				'email':$("input[name='email']").val(),
				'intro':$("textarea[name='intro']").val(),
			},
			beforeSend:function(){
				$('#msg').css({
					'background':'url('+THINKPHP['img']+'/loading.gif) no-repeat 20px center'
				}).html('正在提交中，请稍等...').dialog('open')
			},
			success:function(data,response,status){
				if(response=='success'){				
					$('#msg').css('background','url('+THINKPHP['img']+'/success.gif) no-repeat 20px center').html('修改成功！').dialog('open');
					setTimeout(function(){
						$('#msg').html('...').dialog('close');
					},1500) 
					
				}
				
			}
		})
	})
	//图片裁剪页面调用
	if($('#file').length>0){
		//头像上传
		$('#file').uploadify({
			uploader:THINKPHP['avatar'],
			swf:THINKPHP['uploadify']+'/uploadify.swf',
			buttonText:'上传头像',
			fileSizeLimit:'1MB',
			fileTypeDesc:'上传图片',
			fileTypeExts:'*.gif;*.png;*.jpeg;*.jpg;',
			multi:false,
			buttonCursor:'pointer',
			overrideEvents:['onSelectError','onDialogClose','onSelect'],
			onSelectError:function(file,errorCode,errorMsg){
				switch(errorCode){
					case -110:
						$('#msg').css({
							'background':'url('+THINKPHP['img']+'/error.png) no-repeat 18px 8px',
						}).html('上传文件不能超过1MB').dialog('open');
						setTimeout(function(){
							$('#msg').dialog('close');
						},2000)
						break;
				}
			},
			onUploadStart:function(){
				$('#msg').css({
						'background':'url('+THINKPHP['img']+'/loading.gif) no-repeat 15px 8px',
				}).html('正在上传中，请稍等...').dialog('open');
			},
			onUploadSuccess:function(file,data,response){
				$('#msg').dialog('close')
				$('#face,#jcrop_preview').attr('src',THINKPHP['root']+'/'+$.parseJSON(data));
				$('#preview_box').fadeIn();
				$('#url').val($.parseJSON(data));
				$('.save, .cancel').button().show();
				$('#face').one('load',function(){
					//隐藏上传按钮
					$('#file').hide();
					jcrop=$.Jcrop('#face',{
						onSelect:    showPreview,
			            bgColor:     'black',
						onChange:showPreview,
			            bgOpacity:   0.5,
			            setSelect:   [ 100, 100, 200, 200 ],
						aspectRatio:1,
					});
					
				})		
			}	
		})
		//点击取消裁剪图片
		$('.cancel').click(function(e){
			$('.save, .cancel').button().hide();
			jcrop.destroy();
			$('#file').fadeIn();
			$('#face,#jcrop_preview').attr('src',THINKPHP['root']+'/Public/Home/images/1.jpg');
			return nothing(e);
		})
		//点击保存图片
		$('.save').click(function(e){
			$.ajax({
				url:THINKPHP['module']+'/File/crop',
				type:'post',
				data:{
					x:$('#x').val(),
					y:$('#y').val(),
					w:$('#w').val(),
					h:$('#h').val(),
					url:$('#url').val(),
				},
				beforeSend:function(){
					$('#msg').css({
						'background':'url('+THINKPHP['img']+'/loading.gif) no-repeat 15px 8px',
					}).html('头像保存中，请稍等...').dialog('open');
				},
				success:function(data,reponse,state){
					jcrop.destroy();
					$('#jcrop_preview').fadeOut();
					$('.save, .cancel').button().hide();
					$('#face').attr('src',THINKPHP['root']+'/'+$.parseJSON(data)['big']+'?random='+Math.random()).css({
						width:'auto',
						height:'auto',
					});
					$('#file').fadeIn();
					$('#msg').css('background','url('+THINKPHP['img']+'/success.gif) no-repeat 15px 8px').html('头像保存成功！').dialog('open');
					setTimeout(function(){
						$('#msg').dialog('close');
					},500)
				}			
			})
		})
		//显示头像右侧缩略图
		function showPreview(c){
			$('#x').val(c.x)
			$('#y').val(c.y)
			$('#w').val(c.w)
			$('#h').val(c.h)
			var rx = $('#preview_box').width() / c.w;
			var ry = $('#preview_box').height() / c.h;
			$('#jcrop_preview').css({
				width: Math.round(rx * $('#face').width()) + 'px',
				height: Math.round(ry * $('#face').height()) + 'px',
				marginLeft: '-' + Math.round(rx * c.x) + 'px',
				marginTop: '-' + Math.round(ry * c.y) + 'px'
			});
		};
		// A handler to kill the action
		// Probably not necessary, but I like it 
		function nothing(e){
			e.stopPropagation();
			e.preventDefault();
			return false;
		}; 	
	}
	//设置个性域名调用
	if($('.domain').length>0){
		$('.domain .submit').button().click(function(){
			$.ajax({
				url:THINKPHP['root']+'/Set/setDomain',
				type:'post',
				data:{
					domain:$('.domain_text').val(),
				},
				beforeSend:function(){
					$('#msg').css({
						'background':'url('+THINKPHP['img']+'/loading.gif) no-repeat 15px 8px',
					}).html('个性域名设置中...').dialog('open');
				},
				success:function(){
					$('#msg').css('background','url('+THINKPHP['img']+'/success.gif) no-repeat 15px 8px').html('个性域名设置成功！').dialog('open');					
					setTimeout(function(){
						$('#msg').dialog('close');
						location.reload();
					},500)
				}
			})
		})
	}
})

	
	

