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
})
	
	

