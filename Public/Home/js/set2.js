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
			uploader:THINKPHP['avatar'],	//后台处理地址
			swf:THINKPHP['uploadify']+'/uploadify.swf',  //uploadify.swf文件存放地址
			buttonText:'上传头像',	//选择描述文字
			fileSizeLimit:'1MB',	//上传限制最大1M 
			fileTypeDesc:'上传图片',	//按钮文字
			fileTypeExts:'*.gif;*.png;*.jpeg;*.jpg;',	//允许上传图片
			multi:false,	//是否支持多文件上传
			buttonCursor:'pointer',		//按钮手形
			overrideEvents:['onSelectError','onDialogClose','onSelect'],	//重写默认事件
			onSelectError:function(file,errorCode,errorMsg){	//错误提示，只做了上传大小提示
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
			onUploadStart:function(){	//上传开始
				$('#msg').css({
						'background':'url('+THINKPHP['img']+'/loading.gif) no-repeat 15px 8px',
				}).html('正在上传中，请稍等...').dialog('open');
			},
			onUploadSuccess:function(file,data,response){		//上传成功
				$('#msg').dialog('close')

				//上传成功后初始化预览图片
				$('#face,#jcrop_preview1').attr('src',THINKPHP['root']+'/'+$.parseJSON(data));
				$('#jcrop_preview2').attr('src',THINKPHP['root']+'/'+$.parseJSON(data));
				$('#jcrop_preview3').attr('src',THINKPHP['root']+'/'+$.parseJSON(data));
				


//				$('#preview_box').fadeIn();
				$('#url').val($.parseJSON(data));	
				//头像加载完成之后执行插件			
				$('#face').one('load',function(){
					//隐藏上传按钮
					$('#file').hide();
					$('.save, .cancel').button().show();
					//明天把这个拉出来
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
			jcrop.destroy();		//删除裁剪对象，不能裁剪了
			$('#file').fadeIn();	//隐藏upload按钮
			$('#face,#jcrop_preview').attr('src',THINKPHP['root']+'/Public/Home/images/1.jpg');	//还原默认头像
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
					$('.save, .cancel').button().hide();
					// $('#face').attr('src',THINKPHP['root']+'/'+$.parseJSON(data)['big']+'?random='+Math.random()).css({
					// 	width:'auto',
					// 	height:'auto',
					// });
					
					$('#jcrop_preview').attr('src',THINKPHP['root']+'/'+$.parseJSON(data)['big']+'?random='+Math.random()).css({
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


			var rx1 = $('#preview_box1').width() / c.w;
			var ry1 = $('#preview_box1').height() / c.h;
			$('#jcrop_preview1').css({
				width: Math.round(rx1 * $('#face').width()) + 'px',
				height: Math.round(ry1 * $('#face').height()) + 'px',
				marginLeft: '-' + Math.round(rx1 * c.x) + 'px',
				marginTop: '-' + Math.round(ry1 * c.y) + 'px'
			});

			var rx2 = $('#preview_box2').width() / c.w;
			var ry2 = $('#preview_box2').height() / c.h;
			$('#jcrop_preview2').css({
				width: Math.round(rx2 * $('#face').width()) + 'px',
				height: Math.round(ry2 * $('#face').height()) + 'px',
				marginLeft: '-' + Math.round(rx2 * c.x) + 'px',
				marginTop: '-' + Math.round(ry2 * c.y) + 'px'
			});

			var rx3 = $('#preview_box3').width() / c.w;
			var ry3 = $('#preview_box3').height() / c.h;
			$('#jcrop_preview3').css({
				width: Math.round(rx3 * $('#face').width()) + 'px',
				height: Math.round(ry3 * $('#face').height()) + 'px',
				marginLeft: '-' + Math.round(rx3 * c.x) + 'px',
				marginTop: '-' + Math.round(ry3 * c.y) + 'px'
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

	
	

