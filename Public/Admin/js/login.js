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
				url:'baidu.com'
			})
		}
	})
})