<div class="hmtop">
    <!--顶部导航条 -->
    <div class="am-container header">
        <ul class="message-l">
            <div class="topMessage">

                <div class="menu-hd">


                    @if(Session::get('user'))

                        欢迎你:{{Session::get('user')}}

                        <a href="{{url('Home/login')}}" target="_top" class="h">退出</a>

                    @else
                        <a href="{{url('Home/login')}}" target="_top" class="h">登录</a>

                        <a href="{{url('Home/register')}}" target="_top">免费注册</a>
                    @endif


                    {{--                    <a href="{{url('Home/login')}}" target="_top" class="h">亲，请登录</a>--}}
                    {{--                    <a href="{{url('Home/register')}}" target="_top">免费注册</a>--}}



                </div>
            </div>
        </ul>
        <ul class="message-r">
            <div class="topMessage home">
                <div class="menu-hd"><a href="{{url('/')}}" target="_top" class="h">商城首页</a></div>
            </div>
            <div class="topMessage my-shangcheng">
                <input type="hidden" value="{{session()->get('uid')??''}}">
                <div class="menu-hd MyShangcheng"><a href="{{url('Home/Infor/information')}}" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
            </div>
            <div class="topMessage mini-cart">
                <div class="menu-hd"><a id="mc-menu-hd" href="{{url('Goods/shopcart')}}??''" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h"></strong></a></div>
            </div>
            <div class="topMessage favorite">
                <div class="menu-hd"><a href="{{url('Goods/collection')}}" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
            </div>
        </ul>
    </div>





{{--@include('public.header',['title'=>'首页'])--}}
<!--悬浮搜索框-->

