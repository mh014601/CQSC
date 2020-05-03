<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>欢迎登录后台管理系统</title>
    <link href="{{asset('Admin/css/style.css')}}" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="{{asset('Admin/js/jquery.js')}}"></script>
    <script src="{{asset('Admin/js/cloud.js')}}" type="text/javascript"></script>
</head>
<style>
    .aa{
        position: absolute;
        left: 620px;
        top: 300px;

    }
</style>

<body style="background-color:#1c77ac; background-image:url({{asset('Admin/images/light.png')}}); background-repeat:no-repeat; background-position:center top; overflow:hidden;">

<div id="mainBody">
    <div id="cloud1" class="cloud"></div>
    <div id="cloud2" class="cloud"></div>
</div>

<div class="logintop">
    <span>欢迎登录后台管理界面平台</span>
    <ul>
        <li><a href="#">回首页</a></li>
        <li><a href="#">帮助</a></li>
        <li><a href="#">关于</a></li>
    </ul>
</div>

<div class="loginbody">
    <span class="systemlogo"></span>
    <div class="aa">
        <form action="{{url('Admin/Index/loginAction')}}" method="post">
            {{csrf_field()}}
            <ul>
                <li><input name="ad_name" type="text" class="loginuser" placeholder="用户名"  /></li>

                <li class="yzm">
                    <span><input id="cap" value="" name="captcha" type="text" placeholder="验证码" /></span>
                    <cite><img onclick="this.src = this.src+'?rand='+Math.random()"
                               src="{{url('Admin/Index/verify')}}" alt=""></cite>

                </li>
                <li class="loginuser"><input type="submit"></li>

            </ul>
        </form>
    </div>
</div>

</body>

<script language="javascript">
    $(function(){
        $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
        $(window).resize(function(){
            $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
        })
    });
</script>
</html>

