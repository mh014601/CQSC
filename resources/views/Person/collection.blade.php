<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

    <title>我的收藏</title>

    <link href="{{asset('AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <link href="{{asset('css/personal.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/colstyle.css')}}" rel="stylesheet" type="text/css">
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

            <div class="user-collection">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的收藏</strong> / <small>My&nbsp;Collection</small></div>
                    &nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0)"><del class="am-icon-trash goods-All" ></del></a>
                    <s class="line"></s>
                </div>
                <hr/>
                <div class="you-like">
                    <div class="s-content">

                        @foreach( $rows as $v)
                            <div class="s-item-wrap">
                                <div class="s-item">

                                    <div class="s-pic">
                                        <a href="{{url('Goods/info')}}?id={{$v->id}}" class="s-pic-link">
                                            <img src='{{asset("upload/$v->pic")}}' alt="4折抢购!十二生肖925银女戒指,时尚开口女戒" title="4折抢购!十二生肖925银女戒指,时尚开口女戒" class="s-pic-img s-guess-item-img">
                                            {{--                                        <span class="tip-title">已下架</span>--}}
                                        </a>
                                    </div>

                                    <div class="s-info">
                                        <div class="s-title"><a href="{{url('Home/Goods/goodsInfo')}}?id={{$v->id}}" title="4折抢购!十二生肖925银女戒指,时尚开口女戒">{{$v->good_name}}</a></div>
                                        <div class="s-new_price-box">
                                            <span class="s-new_price"><em class="s-new_price-sign">¥</em><em class="s-value">{{$v->new_price}}</em></span>
                                            <span class="s-history-new_price"><em class="s-new_price-sign">¥</em><em class="s-value">{{$v->old_price}}</em></span>
                                        </div>
                                        <div class="s-extra-box">
                                            <span class="s-comment">好评: 99.93%</span>
                                            <span class="s-sales">月销: {{$v->month_sale}}</span>
                                        </div>
                                    </div>
                                    <div class="s-tp">
                                        <a href="{{url('Goods/seach')}}?id={{$v->cate_id}}">
                                            <span class="ui-btn-loading-before">找相似</span>
                                        </a>
                                        <i class="am-icon-trash"></i>
                                        <p>
                                            <a href="javascript:void(0);" class="c-nodo J_delFav_btn">取消收藏</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <script>
                        $('.goods-All').click(function(){
                            layui.use("layer",function(){
                                layer.confirm('是否要删除所有收藏？', {
                                    btn: ['是的','取消'] //按钮
                                }, function(){
                                    var _token = "{{csrf_token()}}";
                                    $.post("{{url('Goods/collectionAction')}}",{_token:_token},function(status){
                                        if (status) {
                                            $('.s-content').remove();
                                            layer.msg('删除成功!', {icon: 1});
                                        }
                                    },'json')
                                })
                            })
                        })
                    </script>
                </div>
            </div>
        </div>
        <!--底部-->
        @include('Public.footer')
    </div>

    @include('Public.info')
</div>

</body>

</html>
