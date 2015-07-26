;$(function () {
	$('#nav').tree({
		url : THINKPHP['module']+'/Index/getNav',
		lines : true,
		checkbox : true,
		onLoadSuccess : function(node, data){
            var _this = this;
            if(data){
                $(data).each(function(){
                    if(this.state == 'closed'){
                        $(_this).tree('expandAll');
                    }
                });
            }
		},
		
		onClick : function(node){
			console.log(node)
		}
		
	});
});
