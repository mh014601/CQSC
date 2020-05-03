<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

    <title>我的足迹</title>

    <link href="{{asset('AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <link href="{{asset('css/personal.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/footstyle.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('layui/layui/layui.js')}}"></script>
</head>

<body>
<!--头 -->
<header>
    <article>
        <div class="mt-logo">
            <!--顶部导航条 -->
        @include('Public.header1')

            <!--悬浮搜索框-->

            @include('Public.seach1')

            <div class="clear"></div>
        </div>
        </div>
    </article>
</header>
<div class="nav-table">
    @include('Public.header')
</div>
<b class="line"></b>
<div class="center">
    <div class="col-main">
        <div class="main-wrap">

            <div class="user-foot">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的足迹</strong> / <small>Browser&nbsp;History</small></div>
                </div>
                <hr/>

                <!--足迹列表 -->
                {{--        当天商品足迹信息            --}}
                <div>
                    <div class="goods-date" data-date="2015-12-21">
                        <span><i class="month-lite">{{$today}}</i><i class="date-desc">今天</i></span>
                        <del class="am-icon-trash goods-All" ad="today"></del>
                        <s class="line"></s>
                    </div>

                    <p id="tishi_today" style="color: red"></p>

                    <div class="goods-date" id="goods_today" >
                        @if(!$todayR)
                            <p id="today2" style="color: red">今天的数据为空</p>
                        @else
                            @foreach($todayRows as $rows)
                                <div class="goods" id="goods_{{$rows->id}}">
                                    <div class="goods-box first-box">
                                        <div class="goods-pic">
                                            <div class="goods-pic-box">
                                                <a class="goods-pic-link" href="{{url('Home/Goods/goodsInfo')}}?id={{$rows->id}}" title="{{$rows->good_name}}">
                                                    <img src='{{asset("upload/$rows->pic")}}' class="goods-img"></a>
                                            </div>
                                            <a class="goods-delete delete_goods" href="javascript:void(0);" ad="{{$rows->id}}" ><i class="am-icon-trash"></i></a>
                                        </div>

                                        <div class="goods-attr">
                                            <div class="good-title">
                                                <a class="title" href="{{url('Home/Goods/goodsInfo')}}?id={{$rows->id}}" >{{$rows->good_name}}</a>
                                            </div>
                                            <div class="goods-price">
										<span class="g_price">
                                        <span>¥</span><strong>{{$rows->new_price}}</strong>
										</span>
                                                <span class="g_price g_price-original">
                                        <span>¥</span><strong>{{$rows->old_price}}</strong>
										</span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="goods-num">
                                                <div class="match-recom">
                                                    <a href="{{url('Goods/seach')}}?id={{$rows->cate_id}}" class="match-recom-item" cate="{{$rows->cate_id}}">找相似</a>
                                                    <a href="{{url('Goods/seach')}}?id={{$rows->cate_id}}" class="match-recom-item" >找搭配</a>
                                                    <i><em></em><span></span></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>


                </div>

                <div class="clear"></div>
                {{--        一周足迹         --}}
                <div>
                    <div class="goods-date" data-date="2015-12-17">
                        <span><i class="month-lite"></i><i class="day-lite"></i>	<i class="date-desc">一周的足迹</i></span>
                        <a href="javascript:void(0)">
                            <del class="am-icon-trash goods-All" ad="week"></del>
                        </a>
                        <s class="line"></s>
                    </div>
                    <p id="tishi_week" style="color: red"></p>
                    <div class="goods-date" id="goods_week" >
                        @if(!$weekR)
                            <p id="week2" style="color: red">数据为空.........</p>
                        @else
                            @foreach($weekRows as $rows)
                                <div class="goods" id="goods_{{$rows->id}}" >
                                    <div class="goods-box first-box">
                                        <div class="goods-pic">
                                            <div class="goods-pic-box">
                                                <a class="goods-pic-link" href="{{url('Goods/goodsInfo')}}?id={{$rows->id}}" title="{{$rows->good_name}}">
                                                    <img src='{{asset("upload/$rows->pic")}}' class="goods-img"></a>
                                            </div>
                                            <a class="goods-delete delete_goods" href="javascript:void(0);" ad="{{$rows->id}}"><i class="am-icon-trash"></i></a>
                                        </div>

                                        <div class="goods-attr">
                                            <div class="good-title">
                                                <a class="title" href="{{url('Goods/goodsInfo')}}?id={{$rows->id}}" >{{$rows->good_name}}</a>
                                            </div>
                                            <div class="goods-price">
										<span class="g_price">
                                        <span>¥</span><strong>{{$rows->new_price}}</strong>
										</span>
                                                <span class="g_price g_price-original">
                                        <span>¥</span><strong>{{$rows->old_price}}</strong>
										</span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="goods-num">
                                                <div class="match-recom">
                                                    <a href="{{url('Goods/seach')}}?id={{$rows->cate_id}}" class="match-recom-item" cate="{{$rows->cate_id}}">找相似</a>
                                                    <a href="{{url('Goods/seach')}}?id={{$rows->cate_id}}" class="match-recom-item" >找搭配</a>
                                                    <i><em></em><span></span></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <!--底部-->
        @include('Public.footer')
    </div>

    @include('Public.info')
</div>

</body>
<script>
    {{--         整体历史记录删除           --}}
    $('.goods-All').click(function(){
        var ad = $(this).attr('ad');
        var today = "toady";
        layui.use('layer', function () {
            layer.confirm('你确定删除浏览记录？', {
                btn: ['是的','取消'] //按钮
            }, function(){
                var _token = "{{csrf_token()}}";
                $.post("{{url('Goods/footAction')}}",{_token:_token,ad:ad},function(status){
                    if (status){

                        // alert("goods_"+ad);
                        $('#goods_'+ad).remove();

                        $("#tishi_"+ad).text("没有历史记录! 快快选购自己喜欢的商品吧!");

                        layer.msg('删除成功!', {icon: 1});
                        //     // $('#goods_'+ad).text("没有历史记录! 快快选购自己喜欢的商品吧!");
                        // }else{
                        //     $('#goods_'+ad).remove();
                        //     layer.msg('删除成功!', {icon: 1});
                        //     //
                        // }
                    }
                },'json');
            })
        })
    })
</script>
<script>
    {{--           删除单条浏览记录             --}}
    $('.delete_goods').click(function(){
        var product_id = $(this).attr('ad');
        layui.use("layer",function(){
            layer.confirm('你确定要删除吗？', {
                btn: ['是的','取消'] //按钮
            }, function(){
                // alert(product_id);
                var _token = "{{csrf_token()}}";
                $.post("{{url('Goods/footAction')}}",{_token:_token,product_id:product_id},function(status){
                    if (status){
                        $("#goods_"+product_id).remove();
                        layer.msg('删除成功!', {icon: 1});
                    }
                },'json')
            })
        })
    })

</script>
</html>
