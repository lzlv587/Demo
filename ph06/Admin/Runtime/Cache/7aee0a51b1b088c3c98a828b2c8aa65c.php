<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>新闻发布系统</title>
<link href="__PUBLIC__/Style/login.css" rel="stylesheet" type="text/css">
<script src="__PUBLIC__/Js/jquery.js" language="javascript" type="text/javascript"></script>
<script type="text/javascript"></script>
</head>
<body>
<div class="view-container">
<div id="account_login" class="account-box-wrapper">
<div class="account-box">
<form name="form1" method="post" action="<?php echo U('Login/dologin');?>">
<div class="account-form-title">
<div class="logo"><img src="__PUBLIC__/images/yglogo.png" width="100"></div>
<label>管理登录</label>
</div>
<div class="account-input-area">
<input name="u_name" type="text" placeholder="用户名">
</div>
<div class="account-input-area">
<input type="password" name="u_password" placeholder="密码">
</div>
<div class="account-input-area">
<input id="vdcode" type="text" name="validate" style="text-transform:uppercase;width:238px;"/>
<img id="vdimgck" align="absmiddle" onClick="this.src=this.src+'?'" style="cursor:pointer;width:100px;
height:44px,margin-left:30px;"alt="看不清，点击更换！" src="<?php echo U('verify');?>"/>
</div>
<button class="account-button login-btn" type="submit" name="sm1" onclick="this.form.submit();">
<span>登录</span></button>
</form>
</div>
</div>
</div>
</body>
</html>