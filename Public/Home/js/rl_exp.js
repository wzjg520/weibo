/*
*	评论表情渲染JS
*	@author:	小毛
*	@data:		2013年2月17日
*	@version:	1.0
*	@rely:		jQuery
*/
$(function(){
	/*
	*		参数说明
	*		baseUrl:	【字符串】表情路径的基地址
	*		pace:		【数字】表情弹出层淡入淡出的速度
	*		dir:		【数组】保存表情包文件夹名字
	*		text:		【二维数组】保存表情包title文字
	*		num:		【数组】保存表情包表情个数
	*		isExist:	【数组】保存表情是否加载过,对于加载过的表情包不重复请求。
	*/
	var rl_exp = {
		baseUrl:	THINKPHP['img'],
		pace:		200,
		dir:		['a','b','c','d'],
		text:[			/*表情包title文字，自己补充*/
			[
				'a_0','a_1','a_2','a_3','a_4','a_5','a_6','a_7','a_8','a_9','a_10','a_11','a_12','a_13','a_14','a_15','a_16','a_17','a_18','a_19',
				'a_20','a_21','a_22','a_23','a_24','a_25','a_26','a_27','a_28','a_29','a_30','a_31','a_32','a_33','a_34','a_35','a_36','a_37','a_38','a_39',
				'a_40','a_41','a_42','a_43','a_44','a_45','a_46','a_47','a_48','a_49','a_50','a_51','a_52','a_53','a_54','a_55','a_56','a_57','a_58','a_59',
				'a_60','a_61','a_62','a_63','a_64','a_65','a_66','a_67','a_68','a_69','a_70','a_71','a_72','a_73','a_74','a_75','a_76','a_77','a_78','a_79',
				'a_80','a_81','a_82','a_83','a_84','a_85','a_86','a_87','a_88','a_89','a_90','a_91','a_92','a_93','a_94','a_95'
			],
			[
				'b_0','b_1','b_2','b_3','b_4','b_5','b_6','b_7','b_8','b_9','b_10','b_11','b_12','b_13','b_14','b_15','b_16','b_17','b_18','b_19',
				'b_20','b_21','b_22','b_23','b_24','b_25','b_26','b_27','b_28','b_29','b_30','b_31','b_32','b_33','b_34','b_35','b_36','b_37','b_38','b_39',
				'b_40','b_41','b_42','b_43','b_44','b_45','b_46','b_47','b_48','b_49','b_50','b_51','b_52','b_53','b_54','b_55','b_56','b_57','b_58','b_59',
				'b_60','b_61','b_62','b_63','b_64','b_65','b_66','b_67','b_68','b_69','b_70','b_71','b_72','b_73','b_74','b_75','b_76','b_77','b_78','b_79',
				'b_80','b_81','b_82','b_83','b_84','b_85','b_86','b_87','b_88','b_89','b_90','b_91','b_92','b_93','b_94','b_95'
			],
			[
				'c_0','c_1','c_2','c_3','c_4','c_5','c_6','c_7','c_8','c_9','c_10','c_11','c_12','c_13','c_14','c_15','c_16','c_17','c_18','c_19',
				'c_20','c_21','c_22','c_23','c_24','c_25','c_26','c_27','c_28','c_29','c_30','c_31','c_32','c_33','c_34','c_35','c_36','c_37','c_38','c_39',
				'c_40','c_41','c_42','c_43','c_44','c_45','c_46','c_47','c_48','c_49','c_50','c_51','c_52','c_53','c_54','c_55','c_56','c_57','c_58','c_59',
				'c_60','c_61','c_62','c_63','c_64','c_65','c_66','c_67','c_68','c_69','c_70','c_71','c_72','c_73','c_74','c_75','c_76','c_77','c_78','c_79',
				'c_80','c_81','c_82','c_83','c_84','c_85','c_86','c_87','c_88','c_89','c_90','c_91','c_92','c_93','c_94','c_95'
			],
			[
				'd_0','d_1','d_2','d_3','d_4','d_5','d_6','d_7','d_8','d_9','d_10','d_11','d_12','d_13','d_14','d_15','d_16','d_17','d_18','d_19',
				'd_20','d_21','d_22','d_23','d_24','d_25','d_26','d_27','d_28','d_29','d_30','d_31','d_32','d_33','d_34','d_35','d_36','d_37','d_38','d_39',
				'd_40','d_41','d_42','d_43','d_44','d_45','d_46','d_47','d_48','d_49','d_50','d_51','d_52','d_53','d_54','d_55','d_56','d_57','d_58','d_59',
				'd_60','d_61','d_62','d_63','d_64','d_65','d_66','d_67','d_68','d_69','d_70','d_71','d_72','d_73','d_74','d_75','d_76','d_77','d_78','d_79',
				'd_80','d_81','d_82','d_83','d_84','d_85','d_86','d_87','d_88','d_89','d_90','d_91','d_92','d_93','d_94','d_95'
			],
		],
		num:		[84,46,82,69],
		isExist:	[0,0,0,0],
		bind:	function(i){
			$("#rl_bq .rl_exp_main").eq(i).find('.rl_exp_item').each(function(){
				$(this).bind('click',function(){
					rl_exp.insertText(document.getElementById('rl_exp_input'),'['+$(this).find('img').attr('title')+']');
					$('#rl_bq').hide();
					$('.face_arrow_top').hide();
				});
			});
		},
		/*加载表情包函数*/
		loadImg:function(i){
			var node = $("#rl_bq .rl_exp_main").eq(i);
			for(var j = 0; j<rl_exp.num[i];j++){
				var domStr = 	'<li class="rl_exp_item">' + 
									'<img src="' + rl_exp.baseUrl + '/face/' + rl_exp.dir[i] + '/' + j + '.gif" alt="' + rl_exp.text[i][j] + 
									'" title="' + rl_exp.text[i][j] + '" />' +
								'</li>';
				$(domStr).appendTo(node);
			}
			rl_exp.isExist[i] = 1;
			rl_exp.bind(i);
		},
		/*在textarea里光标后面插入文字*/
		insertText:function(obj,str){
			obj.focus();
			if (document.selection) {
				var sel = document.selection.createRange();
				sel.text = str;
			} else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
				var startPos = obj.selectionStart,
					endPos = obj.selectionEnd,
					cursorPos = startPos,
					tmpStr = obj.value;
				obj.value = tmpStr.substring(0, startPos) + str + tmpStr.substring(endPos, tmpStr.length);
				cursorPos += str.length;
				obj.selectionStart = obj.selectionEnd = cursorPos;
			} else {
				obj.value += str;
			}
		},
		init:function(){
			$("#rl_bq > ul.rl_exp_tab > li > a").each(function(i){
				$(this).bind('click',function(){
					if( $(this).hasClass('selected') )
						return;
					if( rl_exp.isExist[i] == 0 ){
						rl_exp.loadImg(i);
					}

					$("#rl_bq > ul.rl_exp_tab > li > a.selected").removeClass('selected');
					$(this).addClass('selected');
					$('#rl_bq .rl_selected').removeClass('rl_selected').hide();
					$('#rl_bq .rl_exp_main').eq(i).addClass('rl_selected').show();
				});
			});
			/*绑定表情弹出按钮响应，初始化弹出默认表情。*/
			$("#rl_exp_btn").bind('click',function(){
				if( rl_exp.isExist[0] == 0 ){
					rl_exp.loadImg(0);
				}
				var w = $(this).position();
				$('.face_arrow_top').show();
				$('#rl_bq').css({left:w.left,top:w.top+30}).show();
			});
			/*绑定关闭按钮*/
			$('#rl_bq a.close').bind('click',function(){
				$('#rl_bq').hide();
				$('.face_arrow_top').hide();
			});
			/*绑定document点击事件，对target不在rl_bq弹出框上时执行rl_bq淡出，并阻止target在弹出按钮的响应。*/
			$(document).bind('click',function(e){
				var target = $(e.target);
				if( target.closest("#rl_exp_btn").length == 1 )
					return;
				if( target.closest("#rl_bq").length == 0 ){
					$('#rl_bq').hide();
					$('.face_arrow_top').hide();
				}
			});
		}
	};
	rl_exp.init();	//调用初始化函数。
});