/**
 * 
 */
$(function(){
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
	
	//微博高度保持一致
	$(window).load(function(){
		keepAlign();
	})
	//头部效果
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
})
	//屏幕高度保持一致
function keepAlign(){
//	setTimeout(function(){
//		if ($('.main_left').height() > 800) {
//			$('.main_right').height($('.main_left').height() + 30);
//			$('#main').height($('.main_left').height() + 30);
//		}
//	},50)
}