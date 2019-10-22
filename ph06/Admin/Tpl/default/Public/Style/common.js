$(function(){
	//表格行，鼠标放上去变色
	$(".tr:odd").css("background", "#FFFCEA");
	$(".tr:odd").each(function(){
		$(this).hover(function(){
			$(this).css("background-color", "#FFE1FF");
		}, function(){
			$(this).css("background-color", "#FFFCEA");
		});
	});
	$(".tr:even").each(function(){
		$(this).hover(function(){
			$(this).css("background-color", "#FFE1FF");
		}, function(){
			$(this).css("background-color", "#fff");
		});
	}); 

	/*ie6,7下拉框美化*/
    if ( $.browser.msie ){
    	if($.browser.version == '7.0' || $.browser.version == '6.0'){
    		$('.select').each(function(i){
			   $(this).parents('.select_border,.select_containers').width($(this).width()+5); 
			 });
    		
    	}
    }
 
});
/**
* 设置表单的值
* @author zhaoxin <775460970@qq.com>
*/
function setValue (name, value){
    var first = name.substr(0,1), input, i = 0, val;
    if(value === "") return;
    if("#" === first || "." === first){
      input = $(name);
    } else {
      input = $("[name='" + name + "']");
    }

    if(input.eq(0).is(":radio")) { //单选按钮
      input.filter("[value='" + value + "']").each(function(){this.checked = true});
    } else if(input.eq(0).is(":checkbox")) { //复选框
      if(!$.isArray(value)){
        val = new Array();
        val[0] = value;
      } else {
        val = value;
      }
      for(i = 0, len = val.length; i < len; i++){
        input.filter("[value='" + val[i] + "']").each(function(){this.checked = true});
      }
    } else {  //其他表单选项直接设置值
      input.val(value);
    }
 }