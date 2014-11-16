$(function () {
	var rand=Math.floor(Math.random()*5)+1;
	$('body').css({
		'background':"url('"+THINKPHP['img']+"/login_bg"+rand+".jpg') no-repeat left top",
		'background-size':'100% 100%',
	})
	$('#button').button();
	$('.reg').click(function(){
		$('#reg_form').dialog('open');
	})
	//注册
	$('#reg_form').dialog({
			width:350,
			height:300,
			colseText:'关闭',
			modal:true,
			autoOpen:false,
			resizable:false,
			show:'clip',
			title:'注册新用户',
			buttons:{
				'注册':function(){
					$(this).submit();
				}
			},
		}).validate({
			onkeyup:false,
			submitHandler:function(form){
				$('#verify_form').dialog('open');						
			},
			errorLabelContainer : 'ol.errors',
			wrapper : 'li',
			showErrors : function (errorMap, errorList) {
				var errors = this.numberOfInvalids();
				if (errors > 0) {
					$('#reg_form').dialog('option', 'height', errors * 20 + 300);
				} else {
					$('#reg_form').dialog('option', 'height', 300);
				}
				this.defaultShowErrors();
			},
			highlight:function(element,errorclass){
				$(element).css('border','1px solid red');
				$(element).next('span').html('').removeClass('succ');
			},
			unhighlight:function(element,errorclass){
				$(element).css('border','1px solid green');
				$(element).next('span').html('&nbsp;').addClass('succ');
			},
			rules:{
				username:{
					required:true,
					inAt:true,
					rangelength:[2,20],
					remote:{
						url:THINKPHP['module']+'/User/checkUsername',
						type:'post',
						beforeSend:function (){
							$('#username').next('span').html('&nbsp').removeClass('succ').addClass('loading');
							
						},
						complete:function(jqXHR){
							if(jqXHR.responseText == 'true'){
								$('#username').next('span').html('&nbsp').removeClass('loading').addClass('succ');
							}else{
								$('#username').next('span').html('&nbsp').removeClass('succ').removeClass('loading');
							}
						}
					}
				},
				password:{
					required:true,
					minlength:6,
					maxlength:20,
				},
				repassword:{
					required:true,
					equalTo:'#password',
				},
				email:{
					required:true,
					email:true,
					remote:{
						url:THINKPHP['module']+'/User/checkEmail',
						type:'post',
						beforeSend:function (){
							$('#email').next('span').html('&nbsp').removeClass('succ').addClass('loading');
						},
						complete:function(jqXHR){
							if(jqXHR.responseText == 'true'){
								$('#email').next('span').html('&nbsp').removeClass('loading').addClass('succ');
							}else{
								$('#email').next('span').html('&nbsp').removeClass('succ').removeClass('loading');
							}
						}
					}
				}
			},
			messages:{
				username:{
					required:'账号不得为空',
					inAt:'不得包含@符',
					rangelength:jQuery.format('账号必须在{0},{1}之间'),
					remote:'该账号已被注册',					
				},
				password:{
					required:'密码必须填写',
					minlength:'密码大于{0}位',
					maxlength:'密码必须小于{1}位',
				},
				repassword:{
					required:'确认密码不得为空',
					equalTo:'确认密码必须和密码一致',
				},
				email:{
					required:'邮箱不得为空',
					email:'邮箱格式不正确',
					remote:'邮箱已被注册',
				}
			}
		})
	//登陆
	$('#login').validate({
		onkeyup:false,
		submitHandler:function(form){
			$(form).ajaxSubmit({
				url:THINKPHP['login'],
				type:'post',
				beforeSend:function(){
					$('#loading').dialog('open');
				},
				success:function(responseTEXT){
						if(responseTEXT=='true'){
							$('#loading').css('background','url('+THINKPHP['img']+'/success.gif) no-repeat 20px center').html('登陆成功,正在跳转...');
							setTimeout(function(){
								location.href=THINKPHP['index'];
							},1000)
						}else{
							$('#loading').css('background','url('+THINKPHP['img']+'/error.png) no-repeat 20px center').html('账号或密码错误...');
							setTimeout(function(){
								$('#loading').dialog('close');
								$('#loading').css('background','url('+THINKPHP['img']+'/error.png) no-repeat 20px center').html('数据交互中...');
							},1000)
						}
					}
				
			})				
		},
		rules:{
			username:{
				required:true,
				rangelength:[2,20],
			},
			password:{
				required:true,
				rangelength:[6,20],
			}
		},
		messages:{
			username:{
				required:'账号不得为空',
				rangelength:'长度在{0},{1}位之间'
			},
			password:{
				required:'密码必填',
				rangelength:'长度{0},{1}位之间',
			}
		}
	});
	//信息交互框
	$('#loading').dialog({
		width:210,
		height:40,
		autoOpen:false,
		modal:true,
		resizable:false,
		resizable:false,
		draggable:false,
		show:'clip',
		closeOnEscape:false,
	}).parent().find('.ui-widget-header').hide();
	//验证码
	$('#verify_form').dialog({
		width:300,
		height:270,
		autoOpen:false,
		modal:true,
		buttons:{
			'完成':function(e){
				$(this).submit();
			},
		},
		title:'验证码',
		resizable:false,
		draggable:false,
		show:'clip',
		closeOnEscape:false,
	}).validate({
		onkeyup:false,
		submitHandler:function(form){
			$('#reg_form').ajaxSubmit({
					url:THINKPHP['module']+'/User/register',
					type:'post',
					data:{
						verify:$('#verify').val(),
					},
					beforeSubmit:function(){
						$('#loading').dialog('open');
						$('#reg_form').dialog('widget').find('button').eq(1).button('disable');
						$('#verify_form').dialog('widget').find('button').eq(1).button('disable');
					},
					success:function(responseTEXT){
						if(responseTEXT){
							$('#reg_form').dialog('widget').find('button').eq(1).button('enable');
							$('#verify_form').dialog('widget').find('button').eq(1).button('enable');
							$('#loading').css('background','url('+THINKPHP['img']+'/success.gif) no-repeat 20px center').html('数据新增成功...');
							setTimeout(function(){
								if(imgSrc.indexOf('?') > 0){
									$('#verify_form .verifyImg').attr('src',imgSrc+'&random='+Math.random());
								}else{
									$('#verify_form .verifyImg').attr('src',imgSrc+'?random='+Math.random())
								}
								$('#reg_form').dialog('close');
								$('#verify_form').dialog('close');
								$('#loading').dialog('close');
								$('#reg_form').resetForm();
								$('#verify_form').resetForm();
								$('#reg_form span.star').removeClass('succ').html('*');
								$('#verify_form span.star').removeClass('succ').html('*');
								$('#loading').css('background','url('+THINKPHP['img']+'/loading.gif) no-repeat 20px center').html('数据交互中');
							},1000)
						}
					}					
				})
		},
		errorLabelContainer : 'ol.errors',
			wrapper : 'li',
			showErrors : function (errorMap, errorList) {
				var errors = this.numberOfInvalids();
				if (errors > 0) {
					$('#verify_form').dialog('option', 'height', errors * 20 + 270);
				} else {
					$('#verify_form').dialog('option', 'height', 270);
				}
				this.defaultShowErrors();
			},
			highlight:function(element,errorclass){
				$(element).css('border','1px solid red');
				$(element).next('span').html('').removeClass('succ');
			},
			unhighlight:function(element,errorclass){
				$(element).css('border','1px solid green');
				$(element).next('span').html('&nbsp;').addClass('succ');
			},
			rules:{
				verify:{
					required:true,
					remote:{
						url:THINKPHP['module']+'/User/checkVerify',
						type:'post',
						beforeSend:function (){
							$('#verify').next('span').html('&nbsp').removeClass('succ').addClass('loading');
							
						},
						complete:function(jqXHR){
							if(jqXHR.responseText == 'true'){
								$('#verify').next('span').html('&nbsp').removeClass('loading').addClass('succ');
							}else{
								$('#verify').next('span').html('&nbsp').removeClass('succ').removeClass('loading');
							}
						}
					}
				}
			},
			messages:{
				verify:{
					required:'验证码不能为空',
					remote:'验证码错误',
				}
			},
			
	});
	//邮箱自动补全
	$('#email').autocomplete({
        autoFocus: true,
        source: function(request, response){
            var hosts = ['qq.com', '163.com', 'gmail.com', '126.com', 'sina.com'], term = request.term, host = '', //域名
 				name = term, //用户名
 				ix = term.indexOf('@'), //是否存在@
 				result = []; //最重要输出的
            result.push(term) //第一条提醒是自己输入的
            if (ix > 1) {
                name = term.slice(0, ix);
                host = term.slice(ix + 1);
            }
            if (name) {
                var findedHost = host ? $.grep(hosts, function(value, index){
                    return value.indexOf(host) > -1;
                }) : hosts;
                var findedResults = $.map(findedHost, function(value, index){
                    return name + '@' + value;
                })
            }
            result = result.concat(findedResults);
            response(result)
        }
    })
	//更换验证码
	var imgSrc=$('#verify_form .verifyImg').attr('src')
	$('#verify_form .changeImg').click(function(){
		if(imgSrc.indexOf('?') > 0){
			$('#verify_form .verifyImg').attr('src',imgSrc+'&random='+Math.random());
		}else{
			$('#verify_form .verifyImg').attr('src',imgSrc+'?random='+Math.random())
		}
	})
	//自定义验证，不包含@
	$.validator.addMethod('inAt', function (value, element) {
		var text = /^[^@]+$/i;
		return this.optional(element) || (text.test(value));
	}, '存在@符号');
	
});

