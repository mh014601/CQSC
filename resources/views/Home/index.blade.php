<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>首页</title>

    <link href="{{asset('AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('basic/css/demo.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('css/hmstyle.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('AmazeUI-2.4.2/assets/js/amazeui.min.js')}}"></script>

</head>

<body>
<div class="hmtop">
    <!--顶部导航条 -->
@include('Public.header1')
@include('Public.seach')


    <div class="clear"></div>
</div>
<b class="line"></b>
<div class="shopNav">
    <div class="slideall" style="height: auto;">

@include('Public.header')

        <div class="bannerTwo">
            <!--轮播 -->
            <div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
                <ul class="am-slides">
                    <li class="banner1"><a href="introduction.html"><img src="{{asset('images/ad5.jpg')}}" /></a></li>
                    <li class="banner2"><a><img src="{{asset('images/ad6.jpg')}}" /></a></li>
                    <li class="banner3"><a><img src="{{asset('images/ad7.jpg')}}" /></a></li>
                    <li class="banner4"><a><img src="{{asset('images/ad8.jpg')}}" /></a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>

        <!--侧边导航 -->
        <div id="nav" class="navfull" style="position: static;">
            <div class="area clearfix">
                <div class="category-content" id="guide_2">

                    <div class="category" style="box-shadow:none ;margin-top: 2px;">
                        <ul class="category-list navTwo" id="js_climit_li">
                            @foreach($rows as $v)
                            <li>
                                <div class="category-info">
                                    <h3 class="category-name b-category-name"><i><img src='{{asset("$v->prc")}}'></i><a class="ml-22"  title="{{$v->cate_name}}">{{$v->cate_name}}</a></h3>
                                    <em>&gt;</em></div>
                                <div class="menu-item menu-in top">
                                    <div class="area-in">
                                        <div class="area-bg">
                                            <div class="menu-srot">

                                                <div class="sort-side">
                                                            @foreach($mem["$v->cate_name"] as $k)
                                                    <dl class="dl-sort">
                                                        <dt><span title="{{$k->cate_name}}">{{$k->cate_name}}</span></dt>
                                                                @foreach($las["$k->cate_name"] as $s)
                                                        <dd><a title="{{$s->cate_name}}" href="{{url('Goods/seach')}}?id={{$s->id}}"><span>{{$s->cate_name}}</span></a></dd>
                                                                    @endforeach
                                                    </dl>
                                                            @endforeach


                                                </div>


                                                <div class="brand-side">
                                                    <dl class="dl-sort"><dt><span>实力商家</span></dt>
                                                        <dd><a rel="nofollow" title="呵官方旗舰店" target="_blank" href="#" rel="nofollow"><span  class="red" >呵官方旗舰店</span></a></dd>
                                                        <dd><a rel="nofollow" title="格瑞旗舰店" target="_blank" href="#" rel="nofollow"><span >格瑞旗舰店</span></a></dd>
                                                        <dd><a rel="nofollow" title="飞彦大厂直供" target="_blank" href="#" rel="nofollow"><span  class="red" >飞彦大厂直供</span></a></dd>
                                                        <dd><a rel="nofollow" title="红e·艾菲妮" target="_blank" href="#" rel="nofollow"><span >红e·艾菲妮</span></a></dd>
                                                        <dd><a rel="nofollow" title="本真旗舰店" target="_blank" href="#" rel="nofollow"><span  class="red" >本真旗舰店</span></a></dd>
                                                        <dd><a rel="nofollow" title="杭派女装批发网" target="_blank" href="#" rel="nofollow"><span  class="red" >杭派女装批发网</span></a></dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <b class="arrow"></b>
                            </li>
                            @endforeach
                            @foreach($rows as $v)
                                @if($v->id < 7)
                          <li>
                                <div class="category-info">
                                    <h3 class="category-name b-category-name"><i><img src='{{asset("$v->prc")}}'></i><a class="ml-22" title="点心">{{$v->cate_name}}</a></h3>
                                    <em>&gt;</em></div>
                                <div class="menu-item menu-in top">
                                    <div class="area-in">
                                        <div class="area-bg">
                                            <div class="menu-srot">

                                                <div class="sort-side">
                                                            @foreach($mem["$v->cate_name"] as $k)
                                                    <dl class="dl-sort">
                                                        <dt><span title="{{$k->cate_name}}">{{$k->cate_name}}</span></dt>
                                                                @foreach($las["$k->cate_name"] as $s)
                                                        <dd><a title="{{$s->cate_name}}" href="{{url('Goods/seach')}}?id={{$s->id}}" ><span>{{$s->cate_name}}</span></a></dd>
                                                                    @endforeach
                                                    </dl>
                                                            @endforeach


                                                </div>


                                                <div class="brand-side">
                                                    <dl class="dl-sort"><dt><span>实力商家</span></dt>
                                                        <dd><a rel="nofollow" title="呵官方旗舰店" target="_blank" href="#" rel="nofollow"><span  class="red" >呵官方旗舰店</span></a></dd>
                                                        <dd><a rel="nofollow" title="格瑞旗舰店" target="_blank" href="#" rel="nofollow"><span >格瑞旗舰店</span></a></dd>
                                                        <dd><a rel="nofollow" title="飞彦大厂直供" target="_blank" href="#" rel="nofollow"><span  class="red" >飞彦大厂直供</span></a></dd>
                                                        <dd><a rel="nofollow" title="红e·艾菲妮" target="_blank" href="#" rel="nofollow"><span >红e·艾菲妮</span></a></dd>
                                                        <dd><a rel="nofollow" title="本真旗舰店" target="_blank" href="#" rel="nofollow"><span  class="red" >本真旗舰店</span></a></dd>
                                                        <dd><a rel="nofollow" title="杭派女装批发网" target="_blank" href="#" rel="nofollow"><span  class="red" >杭派女装批发网</span></a></dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <b class="arrow"></b>
                            </li>
                                    @endif
                            @endforeach

                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!--导航 -->
        <script type="text/javascript">
            (function() {
                $('.am-slider').flexslider();
            });
            $(document).ready(function() {
                $("li").hover(function() {
                    $(".category-content .category-list li.first .menu-in").css("display", "none");
                    $(".category-content .category-list li.first").removeClass("hover");
                    $(this).addClass("hover");
                    $(this).children("div.menu-in").css("display", "block")
                }, function() {
                    $(this).removeClass("hover")
                    $(this).children("div.menu-in").css("display", "none")
                });
            })
        </script>


        <!--小导航 -->
        <div class="am-g am-g-fixed smallnav">
            <div class="am-u-sm-3">
                <a href="sort.html"><img src="{{asset('images/navsmall.jpg')}}" />
                    <div class="title">商品分类</div>
                </a>
            </div>
            <div class="am-u-sm-3">
                <a href="#"><img src="{{asset('images/huismall.jpg')}}" />
                    <div class="title">大聚惠</div>
                </a>
            </div>
            <div class="am-u-sm-3">
                <a href="#"><img src="{{asset('images/mansmall.jpg')}}" />
                    <div class="title">个人中心</div>
                </a>
            </div>
            <div class="am-u-sm-3">
                <a href="#"><img src="{{asset('images/moneysmall.jpg')}}" />
                    <div class="title">投资理财</div>
                </a>
            </div>
        </div>


        <!--各类活动-->
        <div class="row">
            <li><a><img src="{{asset('images/row1.jpg')}}"/></a></li>
            <li><a><img src="{{asset('images/row2.jpg')}}"/></a></li>
            <li><a><img src="{{asset('images/row3.jpg')}}"/></a></li>
            <li><a><img src="{{asset('images/row4.jpg')}}"/></a></li>
        </div>
        <div class="clear"></div>
        <!--走马灯 -->

        <div class="marqueenTwo">
            <span class="marqueen-title"><i class="am-icon-volume-up am-icon-fw"></i>商城头条<em class="am-icon-angle-double-right"></em></span>
            <div class="demo">

                <ul>
                    <li class="title-first"><a target="_blank" href="#">
                            <img src="{{asset('images/TJ2.jpg')}}"></img>
                            <span>[特惠]</span>洋河年末大促，低至两件五折
                        </a></li>
                    <li class="title-first"><a target="_blank" href="#">
                            <span>[公告]</span>商城与广州市签署战略合作协议
                            <img src="{{asset('images/TJ.jpg')}}"></img>
                            <p>XXXXXXXXXXXXXXXXXX</p>
                        </a></li>
                    <li><a target="_blank" href="#"><span>[特惠]</span>女生节商城爆品1分秒	</a></li>
                    <li><a target="_blank" href="#"><span>[公告]</span>华北、华中部分地区配送延迟</a></li>
                    <li><a target="_blank" href="#"><span>[特惠]</span>家电狂欢千亿礼券 买1送1！</a></li>
                    <li><a target="_blank" href="#"><span>[特惠]</span>洋河年末大促，低至两件五折</a></li>
                    <li><a target="_blank" href="#"><span>[公告]</span>华北、华中部分地区配送延迟</a></li>

                </ul>

            </div>
        </div>
        <div class="clear"></div>

    </div>



    <script type="text/javascript">
        if ($(window).width() < 640) {
            function autoScroll(obj) {
                $(obj).find("ul").animate({
                    marginTop: "-39px"
                }, 500, function() {
                    $(this).css({
                        marginTop: "0px"
                    }).find("li:first").appendTo(this);
                })
            }
            $(function() {
                setInterval('autoScroll(".demo")', 3000);
            })
        }
    </script>
</div>
<div class="shopMainbg">
    <div class="shopMain" id="shopmain">

        <!--热门活动 -->

        <div class="am-container">

            <div class="sale-mt">
                <i></i>
                <em class="sale-title">限时秒杀</em>
                <div class="s-time" id="countdown">
                    <span class="hh">01</span>
                    <span class="mm">20</span>
                    <span class="ss">59</span>
                </div>
            </div>


            <div class="am-g am-g-fixed sale">
                <div class="am-u-sm-3 sale-item">
                    <div class="s-img">
                        <a href="# "><img src="{{asset('images/sale3.jpg')}}" /></a>
                    </div>
                    <div class="s-info">
                        <a href="#"><p class="s-title">ZEK 原味海苔</p></a>
                        <div class="s-price">￥<b>9.90</b>
                            <a class="s-buy" href="#">秒杀</a>
                        </div>
                    </div>
                </div>

                <div class="am-u-sm-3 sale-item">
                    <div class="s-img">
                        <a href="# "><img src="{{asset('images/sale2.jpg')}}" /></a>
                    </div>
                    <div class="s-info">
                        <a href="#"><p class="s-title">ZEK 原味海苔</p></a>
                        <div class="s-price">￥<b>9.90</b>
                            <a class="s-buy" href="#">秒杀</a>
                        </div>
                    </div>
                </div>

                <div class="am-u-sm-3 sale-item">
                    <div class="s-img">
                        <a href="# "><img src="{{asset('images/sale1.jpg')}}" /></a>
                    </div>
                    <div class="s-info">
                        <a href="#"><p class="s-title">ZEK 原味海苔</p></a>
                        <div class="s-price">￥<b>9.90</b>
                            <a class="s-buy" href="#">秒杀</a>
                        </div>
                    </div>
                </div>

                <div class="am-u-sm-3 sale-item">
                    <div class="s-img">
                        <a href="# "><img src="{{asset('images/sale2.jpg')}} " /></a>
                    </div>
                    <div class="s-info">
                        <a href="#"><p class="s-title">ZEK 原味海苔</p></a>
                        <div class="s-price">￥<b>9.90</b>
                            <a class="s-buy" href="#">秒杀</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="clear "></div>

{{--         @foreach($rows as $v)--}}
{{--        <div class="f1">--}}
{{--            <!--甜点-->--}}

{{--            <div class="am-container " >--}}
{{--                <div class="shopTitle ">--}}
{{--                    <h4 class="floor-title" style="width: 100px">{{$v->cate_name}}</h4>--}}
{{--                    <div class="floor-subtitle"><h3>每一道{{$v->cate_name}}都有一个故事</h3></div>--}}
{{--                    <div class="today-brands " style="right:0px ;top:13px;">--}}
{{--                        <a href="# ">桂花糕</a>|--}}
{{--                        <a href="# ">奶皮酥</a>|--}}
{{--                        <a href="# ">栗子糕 </a>|--}}
{{--                        <a href="# ">马卡龙</a>|--}}
{{--                        <a href="# ">铜锣烧</a>|--}}
{{--                        <a href="# ">豌豆黄</a>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}

{{--            @foreach($mem["$v->cate_name"] as $b)--}}
{{--            <div class="am-g am-g-fixed floodSix ">--}}
{{--                <div class="am-u-sm-5 am-u-md-3 text-one list">--}}
{{--                    <div class="word">--}}
{{--                        <a class="outer" href="#"><span class="inner"><b class="text">{{$b->cate_name}}</b></span></a>--}}

{{--                    </div>--}}
{{--                    <a href="# ">--}}
{{--                        <img src="{{asset('images/5.jpg')}}" />--}}
{{--                        <div class="outer-con ">--}}
{{--                            <div class="title ">--}}
{{--                                甜品大礼包开抢啦--}}
{{--                            </div>--}}
{{--                            <div class="sub-title ">--}}
{{--                                当小鱼儿恋上软豆腐--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <div class="triangle-topright"></div>--}}
{{--                </div>--}}

{{--                <div class="am-u-sm-7 am-u-md-5 am-u-lg-2 text-two big">--}}

{{--                    <div class="outer-con ">--}}
{{--                        <div class="title ">--}}
{{--                            生日蛋糕--}}
{{--                        </div>--}}
{{--                        <div class="sub-title ">--}}
{{--                            ¥13.8--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <a href="# "><img src="{{asset('images/act1.png')}}" /></a>--}}
{{--                </div>--}}

{{--                <li>--}}
{{--                    <div class="am-u-md-2 am-u-lg-2 text-three">--}}
{{--                        <div class="boxLi"></div>--}}
{{--                        <div class="outer-con ">--}}
{{--                            <div class="title ">--}}
{{--                                蒸蛋糕--}}
{{--                            </div>--}}
{{--                            <div class="sub-title ">--}}
{{--                                ¥4.8--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                        <a href="# "><img src="{{asset('images/1.jpg')}} " /></a>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div class="am-u-md-2 am-u-lg-2 text-three sug">--}}
{{--                        <div class="boxLi"></div>--}}
{{--                        <div class="outer-con ">--}}
{{--                            <div class="title ">--}}
{{--                                脱水蛋糕--}}
{{--                            </div>--}}
{{--                            <div class="sub-title ">--}}
{{--                                ¥4.8--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                        <a href="# "><img src="{{asset('images/2.jpg')}} " /></a>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div class="am-u-sm-4 am-u-md-5 am-u-lg-4 text-five">--}}
{{--                        <div class="boxLi"></div>--}}
{{--                        <div class="outer-con ">--}}
{{--                            <div class="title ">--}}
{{--                                瑞士卷--}}
{{--                            </div>--}}
{{--                            <div class="sub-title ">--}}
{{--                                ¥4.8--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                        <a href="# "><img src="{{asset('images/5.jpg')}}" /></a>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div class="am-u-sm-4 am-u-md-2 am-u-lg-2 text-six">--}}
{{--                        <div class="boxLi"></div>--}}
{{--                        <div class="outer-con ">--}}
{{--                            <div class="title ">--}}
{{--                                软面包--}}
{{--                            </div>--}}
{{--                            <div class="sub-title ">--}}
{{--                                ¥4.8--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                        <a href="# "><img src="{{asset('images/3.jpg')}}" /></a>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div class="am-u-sm-4 am-u-md-2 am-u-lg-4 text-six">--}}
{{--                        <div class="boxLi"></div>--}}
{{--                        <div class="outer-con ">--}}
{{--                            <div class="title ">--}}
{{--                                海绵蛋糕--}}
{{--                            </div>--}}
{{--                            <div class="sub-title ">--}}
{{--                                ¥4.8--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                        <a href="# "><img src="{{asset('images/4.jpg')}}" /></a>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            </div>--}}
{{--            @endforeach--}}
{{--            <div class="clear "></div>--}}
{{--        </div>--}}
{{--       @endforeach--}}



@include('Public.footer')
    </div>
</div>
</div>
</div>

@include('Public/right')
<script type="text/javascript " src="{{asset('basic/js/quick_links.js')}} "></script>
</body>

</html>