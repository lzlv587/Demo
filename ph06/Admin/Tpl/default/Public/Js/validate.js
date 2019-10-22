//代理商注册验证

var validate ={
	registercode : false,
		username : false,
		password : false,
		repassword : false,
		email : false,
}

var msg = '';

$(function(){



	//获取form表单对象
	var register = $( 'form[name=formRegStep1Main]' );

	//验证注册码
	$( 'input[name=registercode]', register ).blur(function(){
		//获取input的val
		var registercode = $(this).val();

		//显示的文字
		var span=$( this ).next();
		//判断注册码是否为空
		if (registercode=='') {
			msg='注册码不能为空';
			span.html( msg ).addClass('msg-error').removeClass('msg-ok');
			validate.registercode=false;
			return;
		}
		//判断注册码的是否6位
		if ( !/^\w{6}$/g.test(registercode) ) {
			msg = '注册码必须由6个字母，数字组成';
			span.html( msg ).addClass('msg-error').removeClass('msg-ok');
			validate.registercode = false;
			return;
		}

		//判断注册码是否有效
		$.post(CONTROL + 'checkRegisterCode', {registercode : registercode}, function (status) {
			if (status) {
				msg = '注册码通过';
				span.html( msg ).addClass('msg-ok').removeClass('msg-error');
				validate.registercode = true;
			} else {
				msg = '注册码无效';
				span.html( msg ).addClass('msg-error').removeClass('msg-ok');
				validate.registercode = false;
			}
		}, 'json');
		
	})





	//验证代理商名
	$( 'input[name=username]', register ).blur(function(){
		//获取input的val
		var username = $(this).val();

		//显示的文字
		var span=$( this ).next();
		//判断代理商名是否为空
		if (username=='') {
			msg='代理商名不能为空';
			span.html( msg ).addClass('msg-error').removeClass('msg-ok');
			validate.username=false;
			return;
		}
		//判断代理商名的是否6位
		if ( !/^\w{4,12}$/g.test(username) ) {
			msg = '代理商名请输入4-12位字母或数字';
			span.html( msg ).addClass('msg-error').removeClass('msg-ok');
			validate.username = false;
			return;
		}

		//判断代理商名是否有效
		$.post(CONTROL + 'checkUserName', {username : username}, function (status) {
			if (status) {
				msg = '代理商名重复';
				span.html( msg ).addClass('msg-error').removeClass('msg-ok');
				validate.username = false;
			} else {			
				msg = '代理商名通过';
				span.html( msg ).addClass('msg-ok').removeClass('msg-error');
				validate.username = true;
			}
		}, 'json');
		
	})


		
	//验证代理商密码
	$( 'input[name=password]', register ).blur(function(){
		//获取input的val
		var password = $(this).val();

		//显示的文字
		var span=$( this ).next();
		//判断代理商密码是否为空
		if (password=='') {
			msg='代理商密码不能为空';
			span.html( msg ).addClass('msg-error').removeClass('msg-ok');
			validate.password=false;
			return;
		}
		//判断代理商名的是否6位
		if ( !/^\w{4,12}$/g.test(password) ) {
			msg = '代理商密码请输入4-12个字符';
			span.html( msg ).addClass('msg-error').removeClass('msg-ok');
			validate.password = false;
			return;
		}else{
			msg = '代理商密码通过';
			span.html( msg ).addClass('msg-ok').removeClass('msg-error');
			validate.password = true;
		}

		
	})


	//验证确认代理商密码
	$( 'input[name=repassword]', register ).blur(function(){
		//获取input的val
		var repassword = $(this).val();

		//显示的文字
		var span=$( this ).next();

		var password = $('#password').val();

		//判断确认代理商密码是否为空
		if (repassword=='') {
			msg='确认密码不能为空';
			span.html( msg ).addClass('msg-error').removeClass('msg-ok');
			validate.repassword=false;
			return;
		}
		//判断确认代理商名
		if ( repassword != password ) {
			msg = '两次密码输入不一致';
			span.html( msg ).addClass('msg-error').removeClass('msg-ok');
			validate.repassword = false;
			return;
		}else{
			msg = '确认密码通过';
			span.html( msg ).addClass('msg-ok').removeClass('msg-error');
			validate.repassword = true;
		}

		
	})



	//验证邮箱
	$( 'input[name=email]', register ).blur(function(){
		//获取input的val
		var email = $(this).val();

		//显示的文字
		var span=$( this ).next();
		//判断代理商密码是否为空
		if (email=='') {
			msg='邮箱不能为空';
			span.html( msg ).addClass('msg-error').removeClass('msg-ok');
			validate.email=false;
			return;
		}
		//判断代理商名的是否6位
		if ( !/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(email) ) {
			msg = '邮箱格式不正确';
			span.html( msg ).addClass('msg-error').removeClass('msg-ok');
			validate.email = false;
			return;
		}else{
			msg = '邮箱通过';
			span.html( msg ).addClass('msg-ok').removeClass('msg-error');
			validate.email = true;
		}

		
	})


})


