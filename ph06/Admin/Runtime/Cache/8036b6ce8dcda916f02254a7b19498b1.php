<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="__PUBLIC__/style/common.css">
<link rel="stylesheet" href="__PUBLIC__/style/style.css">
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.SuperSlide.js"></script>
<script type="text/javascript">
	$(function(){
		$(".sideMenu").slide({
		titCell:"h3",
		targetCell:"ul",
		defaultInex:0,
		effect:'slideDown',
		delayTime:'500',
		trigger:'click',
		triggerTime:'150',
		defaultPlay:true,
		returnDefault:false,
		easing:'easeInQuint',
		endFun:function(){
		scrollWW();
	}
	});
	$(window).resize(function(){
		scrollWW();
	});
	});
function scrollWW(){
	if($(".side").height()<$(".sideMenu").height()){
		$(".scroll").show();
	var pos = $(".sideMenu ul:visible").position.top-38;
		$('.sideMenu').animate({top:-pos});
	}else{
		$(".scroll").hide();
		$('.sideMenu').animate({top:0});
		n=1;
	}
		
	}
var n=1;
function menuScroll(num){
	var Scroll=$('.sideMenu');
	var ScrollP=$('.sideMenu').position();
	if(num==1){
		Scroll.animate({top:Scroll.top-38});
		n=n+1;
	}else{
		if(Scroll.top>-38&&ScrollP.top!=0){
			ScrollP.top=-38;
		}
		if(Scroll.top<0){
			Scroll.animate({top:38+ScrollP.top});
		}else{
			n=1;
		}
		if(n>1){
			n=n-1;
		}
	}
}
</script>

<title>新闻发布平台</title>
</head>
<body>
<div class="top">
<div id="top_t">
<div id="logo" class="f1"><img src="__PUBLIC__/images/yglogo_f.png" width="120"></div>
<div id="photo_info" class="fr">
<div id="photo" class="f1">
<a href="#"><img alt="" src="__PUBLIC__/images/a.png" width="60" height="60"></a>
</div>
<div id="base_info" class="fr">
<div class="ingo_center">您好：
		<?php echo ($u_name); ?>
</div>
<div class="help_info">
<a href="1" id="hp"><img src="__PUBLIC__/images/user_info_03.jpg">&nbsp;帮助</a>
<a href="__ROOT__/index.php?Index/index" id="gy" target="blank">&nbsp;首页</a>
<a href="<?php echo U('Login/loginout');?>" id="out">&nbsp;退出</a>
</div>
</div>
</div>
</div>
</div>
<div style="clear:both;"></div>
<div id="side_here_l" class="fl"></div>
<div class="side">
<div class="sideMenu" style="margin:0 auto">
      <h3>分类管理</h3>
<ul>
<a href="<?php echo U('Type/typeList');?>" target="right"><li>分类列表</li></a>
<a href="<?php echo U('Type/addType');?>" target="right"><li>添加分类</li></a>
</ul>
     <h3>新闻管理</h3>
<ul>
<a href="<?php echo U('News/newsList');?>" target="right"><li>新闻列表</li></a>
<a href="<?php echo U('News/publishNews');?>" target="right"><li>发布新闻</li></a>
</ul>
     <h3>广告管理</h3>
<ul>
<a href="<?php echo U('Ad/adList');?>" target="right"><li>广告列表</li></a>
<a href="<?php echo U('Ad/addAd');?>" target="right"><li>添加广告</li></a>
</ul>
     <h3>评论审核</h3>
<ul>
<a href="<?php echo U('Comment/commentList');?>" target="right"><li>评论列表</li></a>
</ul>
</div>
</div>
<div class="main">
<iframe name="right" id="rightMain" src="<?php echo U('Index/sysMessage');?>" frameborder="no"
   scrolling="auto" width="100%" height="auto" allowtransparency="true"></iframe>
</div>
<div class="bottom">
<div id="bottom_bg">Copyright &nbsp;&copy;英谷教育</div>
</div>
</body>
</html>