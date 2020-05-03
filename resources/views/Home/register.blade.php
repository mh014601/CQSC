<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>注册</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="{{asset('AmazeUI-2.4.2/assets/css/amazeui.min.css')}}" />
		<link href="{{asset('css/dlstyle.css')}}" rel="stylesheet" type="text/css">
		<script src="{{asset('AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('AmazeUI-2.4.2/assets/js/amazeui.min.js')}}"></script>

        	<script src="{{asset('layui/layui/layui.js')}}"></script>
		<style>
			#dyMobileButton1{margin-left: 10px;border: 1px solid #DDD;padding: 0px;width: 15%;height: 40px;background: #F4F4F4 none repeat scroll 0% 0%;margin-top: 0px;text-align: center;line-height:40px;color: #333;text-decoration: none;position: absolute;right: 0px;bottom: 0px;}
		</style>

	</head>

	<body>

		<div class="login-boxtitle">
			<a href="home/demo.html"><img alt="" src="{{asset('images/logobig.png')}}" /></a>
		</div>

		<div class="res-banner">
			<div class="res-main">
				<div class="login-banner-bg"><span></span><img src="{{asset('images/big.jpg')}}" /></div>
				<div class="login-box">

						<div class="am-tabs" id="doc-my-tabs">
							<ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
								<li class="am-active"><a href="">邮箱注册</a></li>
								<li><a href="">手机号注册</a></li>
							</ul>

							<div class="am-tabs-bd">
								<div class="am-tab-panel am-active">
									<form method="post">

							   <div class="user-email">
										<label for="email"><i class="am-icon-envelope-o"></i></label>
										<input type="email" name="" id="email" placeholder="请输入邮箱账号">
                 </div>
										<div class="verification">
											<label for="code1"><i class="am-icon-code-fork"></i></label>
											<input type="tel" name="" id="code1" placeholder="请输入验证码">
											<div  id="sendMobileCode1" width="60px" height="42px">
												<span id="dyMobileButton1">获取</span></div>
										</div>
                 <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="" id="password" placeholder="设置密码">
                 </div>
                 <div class="user-pass">
								    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
								    <input type="password" name="" id="passwordRepeat" placeholder="确认密码">
                 </div>

                 </form>

								 <div class="login-links">
										<label for="reader-me">
											<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
										</label>
							  	</div>
										<div class="am-cf">
											<input type="submit" name="" id="submit2" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
										</div>

								</div>

								<div class="am-tab-panel">
									<form method="post">
                 <div class="user-phone">
								    <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
								    <input type="tel" name="phone" id="phone" placeholder="请输入手机号">
                 </div>
                                   <div class="verification">
											<label for="code"><i class="am-icon-code-fork"></i></label>
											<input type="tel" name="" id="code" placeholder="请输入验证码">
											<div  id="sendMobileCode" width="60px" height="42px">
												<span id="dyMobileButton">获取</span></div>
										</div>
                 <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="" id="password1" placeholder="设置密码">
                 </div>
                 <div class="user-pass">
								    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
								    <input type="password" name="" id="passwordRepeat1" placeholder="确认密码">
                 </div>
									</form>
								 <div class="login-links">
										<label for="reader-me">
											<input id="reader-me1" type="checkbox"> 点击表示您同意商城《服务协议》
										</label>
							  	</div>
										<div class="am-cf">
											<input type="submit" name="" value="注册" id="submit" class="am-btn am-btn-primary am-btn-sm am-fl">
										</div>

									<hr>
								</div>

								<script>
									$(function() {
									    $('#doc-my-tabs').tabs();
									  })
								</script>

							</div>
						</div>

				</div>
			</div>

			@include('Public.footer')
        </div>
	</body>

</html>
<script>




	//手机号注册页面
	var check1 = false
	var check2 = false
	var chenk3 = false

	//失去焦点时验证手机号的是否合格,验证成功后查询数据库是否存在这个手机号
	$('#phone').blur(function () {
		var reg = /^[1][3,4,5,7,8,9][0-9]{9}$/
		var phone = $('#phone').val()
		var _token = "{{csrf_token()}}"
		if(!reg.test(phone)){
			layui.use('layer', function() {
				var layer = layui.layer;
				layer.msg('请输入正确的手机号');
		})
        }else{
			$.post("{{url('Home/checkphone')}}",{_token:_token,phone:phone},function(data){
				alert(data['messphone'])
				check1 = 1;
            },'json')

		}
	})
	var t = null;
    //点击发送验证码
	$('#dyMobileButton').click(function () {
		t = setInterval(daojishi,1000)
		var phone = $('#phone').val();
		var _token = "{{csrf_token()}}";
		$.get("{{url('Home/reg')}}",{phone:phone,_token:_token},function (data) {
		// alert(data['mess'])
            layui.use('layer', function() {
				var layer = layui.layer;
				layer.msg(data['mess']);

		});
        },'json')
	})
	//失去焦点时验证验证码的正确性
    $("#code").blur(function () {
        var verify = $('#code').val();
		var phone2 = $('#phone').val();
        if(verify!=""){
            var _token = "{{csrf_token()}}";
            $.post("{{url('Home/checkVerify')}}",{_token:_token,verify:verify,phone2:phone2},function(data){
                alert(data["mess1"])
				check2 = 1

            },'json')

    }else{
			   layui.use('layer', function() {
				var layer = layui.layer;
				layer.msg('验证码不能为空');
		})
    }
        })
   //判定密码不为空
	$('#password1').blur(function () {
		var pass = $('#password1').val();
		if(pass == ""){
			alert('密码不能为空')
		}
	})
	//判定连两次密码一致
	$('#passwordRepeat1').blur(function(){
		var pass = $('#password1').val();
		var passrep = $('#passwordRepeat1').val();
		if(pass != passrep) {
			alert('两输入密码不一致')
		}
		check3 = 1
	})
			//点击同意商城服务协议
	var num = 0;
	$('#reader-me1').click(function(){
		num = num + 1;
	})

	$('#submit').click(function () {
		//判断是否同意商城用户服务协议
	var num1 = (num+1)%2;
	var ph = $('#phone').val();
	var pass3 = $('#password1').val();
	if(num1 == 0 && check1 == 1 && check2 == 1 && chenk3 == 1){
		var tl = "{{csrf_token()}}"
		$.post("{{url('Home/regphone')}}",{_token:tl,phone3:ph,pass3:pass3},function (data) {
			layui.use('layer', function () {
				var layer = layui.layer;
				layer.msg(data.mess)
			});
			}, 'json')






		}else{
			alert("请同意用户服务协议")
		}
	})

	var time = 60;
	function daojishi(){
		if(time>1){
			time--;
			// 不让点
			$('#sendSms').attr('disabled','disabled').css('cursor','not-allowed')
			$('#sendSms').text(time)

		}else{
			// 关掉计时器
			clearInterval(t)
			$('#sendSms').removeAttr('disabled').css('cursor','pointer')
			time = 60;
			$('#sendSms').text('重新发送')
		}

	}
</script>

