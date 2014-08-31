/**
 * 图片上传插件
 */
$(function(){
	var pic={
		init:function(){
			
			$("#pic_btn").bind('click',function(){
				var w = $(this).position();
				pic.uploadify();
				$('.pic_arrow_top').show();
				$('#pic_box').css({left:w.left,top:w.top+30}).show();
			});
			//绑定关闭按钮
			$('.weibo_pic_header a.close').on('click',function(){
				$('#pic_box').hide();
				$('.pic_arrow_top').hide();
			});
			$(document).on('click',function(e){
				var target = $(e.target)
				if(target.closest('#pic_btn').length==1)return ;
				if(target.closest('#pic_box').length==0){
					$('#pic_box').hide();
					$('.pic_arrow_top').hide();
				}
				
			})
			
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
				fileTypeExts:'*.jpeg;*.jgp;*.gif;*.png;',
				onUploadSuccess:function(file,data,response){
					alert(data)
				}
			})
		}
	}
	pic.init()
})
