<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>左侧菜单页</title>
    <link href="{{asset('Admin/css/style.css')}}" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="{{asset('Admin/js/jquery.js')}}"></script>
</head>
<body style="background:#f0f9fd;">
<div class="lefttop"><span></span>后台管理</div>
<dl class="leftmenu">
    <dd>
        <div class="title">
            <span><img src="{{asset('Admin/images/leftico01.png')}}" /></span>系统管理
        </div>
        <ul class="menuson">
            <li class="active">
                <div class="header">
                    <cite></cite>
                    <a href="{{url('Admin/Index/main')}}" target="main">后台首页</a>
                    <i></i>
                </div>
            </li>
        </ul>
    </dd>
    @foreach($rows as $v)
    <dd>
        <div class="title">
            <span><img src="{{asset('Admin/images/leftico01.png')}}" /></span>{{$v->auth_name}}
        </div>

        <ul class="menuson">
            @if(isset($v->son))
            @foreach($v->son as $v1)
                @if(!(strpos($v1->route,'Del') || strpos($v1->route,'Edit') || strpos($v1->route,'assignAuth')))
            <li>
                <div class="header">
                    <cite></cite>
                    <a href="{{url($v1->route)}}" target="main">{{$v1->auth_name}}</a>
                    <i></i>
                </div>
            </li>
                @endif
            @endforeach
                @endif
        </ul>

    </dd>
@endforeach
</dl>
</body>
<script type="text/javascript">
    $(function(){
        //导航切换
        $(".menuson .header").click(function(){
            var $parent = $(this).parent();
            $(".menuson>li.active").not($parent).removeClass("active open").find('.sub-menus').hide();

            $parent.addClass("active");
            if(!!$(this).next('.sub-menus').size()){
                if($parent.hasClass("open")){
                    $parent.removeClass("open").find('.sub-menus').hide();
                }else{
                    $parent.addClass("open").find('.sub-menus').show();
                }
            }
        });

        // 三级菜单点击
        $('.sub-menus li').click(function(e) {
            $(".sub-menus li.active").removeClass("active")
            $(this).addClass("active");
        });

        $('.title').click(function(){
            var $ul = $(this).next('ul');
            $('dd').find('.menuson').slideUp();
            if($ul.is(':visible')){
                $(this).next('.menuson').slideUp();
            }else{
                $(this).next('.menuson').slideDown();
            }
        });
    })
</script>
</html>
