/**
 * june
 */

$(function(){
	//登陆
	$('#login').dialog({
		width:350,
		height:200,
		modal:true,
		shadow:true,
		iconCls:'icon-tip',
		title:'管理登陆',
		buttons:'#btn'
	});
	
	//数据验证 用户名
	$('#manager').validatebox({
		required:true,
		missingMessage:'请输入管理员名称',
		invalidMessage:'管理员名称不得为空！'
	})
	
	//密码
	$('#password').validatebox({
		required:true,
		validType:'length[6,30]',
		missingMessage:'请输入管理员密码',
		invalidMessage:'管理员密码在6-30位之间！'
	})
	
	//点击登陆
	$('#btn a').click(function(){
		if(!$('#manager').validatebox('isValid')){
			$('#manager').focus();
		}else if(!$('#password').validatebox('isValid')){
			$('#password').focus();
		}else{
			$.ajax({
				url : THINKPHP['module']+'/Login/checkManager',
				type : 'post',
				data : {
					'manager' : $('#manager').val(),
					'password' : $('#password').val()
				},
				beforeSend : function(){
					$.messager.progress();
				},
				
				complete : function(xhr, status){					
					if('success' == status){
						if(xhr.responseText>0){
							location.href = THINKPHP['index'];							
						}else{
							$.messager.alert('验证失败', '账号或密码错误', 'warning')
						};
					}else{
						$.messager.alert('网络错误', '服务器暂时未响应', 'warning')
					}
					$.messager.progress('close');
				}
			})
		}
	})
})