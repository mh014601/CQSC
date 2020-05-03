<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>顶部</title>
    <link href="{{asset('Admin/css/style.css')}}" rel="stylesheet" type="text/css" />
</head>
<body style="background:url({{asset('Admin/images/topbg.gif')}}) repeat-x;">
<!-- 左侧 -->
<div class="topleft">
    <a href="index.html" target="_parent"><img src="{{asset('Admin/images/logo.png')}}" title="系统首页" /></a>
</div>
<!-- 右侧 -->
<div class="topright">
    <ul>

        <li>
            <a href="{{url('/')}}" target="_parent">前台首页</a>
        </li>
        <li>
            <a href="{{url('Admin/Index/loginOut')}}" target="_parent">退出</a>
        </li>
    </ul>

    <div class="user">
        <span>{{$row->ad_name}}</span>
        <i> </i>

    </div>
</div>
</body>

</html>

