<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>结算页面</title>

    <link href="{{asset('AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('basic/css/demo.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/cartstyle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/jsstyle.css')}}" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="{{asset('AmazeUI-2.4.2/jquery-1.11.0.js')}}"></script>
    <script src="{{asset('AmazeUI-2.4.2/assets/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('layui/layui/layui.js')}}"></script>

</head>

<body>

<!--顶部导航条 -->
@include('Public.header1')

<!--悬浮搜索框-->

@include('Public.seach')

<div class="clear"></div>
<div class="concent">
    <!--地址 -->
    <div class="paycont">
        <div class="address">
            <h3>确认收货地址 </h3>
            <div class="control">
                <div class="tc-btn createAddr theme-login am-btn am-btn-danger">使用新地址</div>
            </div>
            <div class="clear"></div>
            <ul>

                @forelse($add as $k)

                <div class="per-border"></div>
{{--                <li class="user-addresslist defaultAddr">--}}
                <li class="user-addresslist" aid="add_{{$k->status}}" pid="{{$k->id}}" id="add_{{$k->id}}" onclick="set({{$k->id}})">
{{--                    <input type="hidden" id="add_{{$k->status}}" >--}}
                    <div class="address-left">
                        <div class="user DefaultAddr">

										<span class="buy-address-detail">
                   <span class="buy-user">{{$k->username}} </span>
										<span class="buy-phone">{{$k->phone}}</span>
										</span>
                        </div>
                        <div class="default-address DefaultAddr">
                            <span class="buy-line-title buy-line-title-type">收货地址：</span>
                            <span class="buy--address-detail">
								   <span class="province">{{$k->pro}}</span>
										<span class="city">{{$k->cit}}</span>
										<span class="dist">{{$k->are}}</span>
										<span class="street">{{$k->address}}</span>
										</span>

                            </span>
                        </div>
{{--                        <ins class="deftip">默认地址</ins>--}}
                    </div>
                    <div class="address-right">
                        <a href="../person/address.html">
                            <span class="am-icon-angle-right am-icon-lg"></span></a>
                    </div>
                    <div class="clear"></div>

                    <div class="new-addr-btn">




                        <a href="javascript:void(0);" onclick="delClick({{$k->id}});">删除</a>
                    </div>

                </li>

            @empty
                还没有收货地址,快来添加第一个收货地址吧.......
                    @endforelse

            </ul>
            <script>
                function delClick(id) {

                    $('#add_'+id+'').remove()
                    var _token = "{{csrf_token()}}"
                    $.post("{{url('Person/clearAddre')}}",{id:id,_token:_token},function (data) {
                        layui.use('layer', function() {
                            var layer = layui.layer;
                            layer.msg(data.mess);
                        });
                    },'json')
                }
            </script>

            <div class="clear"></div>
        </div>
        <!--物流 -->
        <div class="logistics">
            <h3>选择物流方式</h3>
            <ul class="op_express_delivery_hot">
                <li data-value="yuantong" class="OP_LOG_BTN  selected" id="op_1" pid="圆通"><i class="c-gap-right" style="background-position:0px -468px"></i>圆通<span></span></li>
                <li data-value="shentong" class="OP_LOG_BTN " id="op_2" pid="申通"><i class="c-gap-right" style="background-position:0px -1008px"></i>申通<span></span></li>
                <li data-value="yunda" class="OP_LOG_BTN  " id="op_3"><i class="c-gap-right" style="background-position:0px -576px" pid="韵达"></i>韵达<span></span></li>
                <li data-value="zhongtong" class="OP_LOG_BTN op_express_delivery_hot_last " id="op_4" pid="中通"><i class="c-gap-right" style="background-position:0px -324px"></i>中通<span></span></li>
                <li data-value="shunfeng" class="OP_LOG_BTN  op_express_delivery_hot_bottom" pid="顺丰" id="op_5"><i class="c-gap-right" style="background-position:0px -180px"></i>顺丰<span></span></li>
            </ul>
        </div>
        <div class="clear"></div>

        <!--支付方式-->
        <div class="logistics">
            <h3>选择支付方式</h3>
            <ul class="pay-list">
                <li class="pay card selected" pid="银联"><img src="../images/wangyin.jpg" />银联<span></span></li>
                <li class="pay qq" pid="微信"><img src="../images/weizhifu.jpg" />微信<span></span></li>
                <li class="pay taobao" pid="支付宝"><img src="../images/zhifubao.jpg" />支付宝<span></span></li>
            </ul>
        </div>
        <div class="clear"></div>

        <!--订单 -->
        <div class="concent">
            <div id="payTable">
                <h3>确认订单信息</h3>
                <div class="cart-table-th">
                    <div class="wp">

                        <div class="th th-item">
                            <div class="td-inner">商品信息</div>
                        </div>
                        <div class="th th-price">
                            <div class="td-inner">单价</div>
                        </div>
                        <div class="th th-amount">
                            <div class="td-inner">数量</div>
                        </div>
                        <div class="th th-sum">
                            <div class="td-inner">金额</div>
                        </div>
                        <div class="th th-oplist">
                            <div class="td-inner">配送方式</div>
                        </div>

                    </div>
                </div>
                <div class="clear"></div>
                @forelse($rows as $v)
                <tr class="item-list">

                    <div class="bundle  bundle-last">

                        <div class="bundle-main">
                            <ul class="item-content clearfix">
                                <div class="pay-phone">
                                    <li class="td td-item">
                                        <div class="item-pic">
                                            <a href="#" class="J_MakePoint">
                                                <img src="../images/kouhong.jpg_80x80.jpg" class="itempic J_ItemImg"></a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-basic-info">
                                                <a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v->pname}}</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="td td-info">
                                        <div class="item-props">
                                            <span class="sku-line">口味：{{$v->taste}}</span>
                                            <span class="sku-line">包装：{{$v->pack}}</span>
                                        </div>
                                    </li>
                                    <li class="td td-price">
                                        <div class="item-price price-promo-promo">
                                            <div class="price-content">
                                                <em class="J_Price price-now">{{$v->price}}</em>
                                            </div>
                                        </div>
                                    </li>
                                </div>
                                <li class="td td-amount">
                                    <div class="amount-wrapper ">
                                        <div class="item-amount ">
                                            <span class="phone-title">购买数量</span>
                                            <div class="sl">
{{--                                                <input class="min am-btn" name="" type="button" value="-" />--}}
{{--                                                <input class="text_box" name="" type="text" value="{{$v->pnum}}" style="width:30px;" />--}}
                                                {{$v->pnum}}
{{--                                                <input class="add am-btn" name="" type="button" value="+" />--}}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="td td-sum">
                                    <div class="td-inner">
                                        <em tabindex="0" class="J_ItemSum number" id="em_{{$v->id}}">{{sprintf("%.2f",$v->price*$v->pnum)}}</em>
                                    </div>
                                </li>
                                <input type="hidden" name="sum" class="sum" value="{{sprintf("%.2f",$v->price*$v->pnum)}}">
                                <li class="td td-oplist">
                                    <div class="td-inner">
                                        <span class="phone-title">配送方式</span>
                                        <div class="pay-logis">
                                            包邮
                                        </div>
                                    </div>
                                </li>

                            </ul>
                            <div class="clear"></div>

                        </div>
                        </div>
                </tr>
                @empty
                    当前还没有商品需要结算
                @endforelse
                <div class="clear"></div>
            </div>


        </div>
        <div class="clear"></div>
        <div class="pay-total">
            <!--留言-->
            <div class="order-extra">
                <div class="order-user-info">
                    <div id="holyshit257" class="memo">
                        <label>买家留言：</label>
                        <input type="text" id="info22" title="选填,对本次交易的说明（建议填写已经和卖家达成一致的说明）" placeholder="选填,建议填写和卖家达成一致的说明" class="memo-input J_MakePoint c2c-text-default memo-close">
                        <div class="msg hidden J-msg">
                            <p class="error">最多输入500个字符</p>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <!--含运费小计 -->
        <div class="buy-point-discharge ">
            <p class="price g_price ">
                合计（含运费） <span>¥</span><em class="pay-sum" id="sum">0</em>
            </p>
        </div>

        <!--信息 -->
        <div class="order-go clearfix">
            <div class="pay-confirm clearfix">
                <div class="box">
                    <div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
                        <span class="price g_price ">
                                    <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">244.00</em>
											</span>
                    </div>

                    <div id="holyshit268" class="pay-address">

                        <p class="buy-footer-address">
                            <span class="buy-line-title buy-line-title-type">寄送至：</span>
                            <span class="buy--address-detail">
								   <span class="province" id="pro">{{$add1[0]->pro??''}}</span>
												<span class="city" id="cit">{{$add1[0]->cit??''}}</span>
												<span class="dist" id="are">{{$add1[0]->are??''}}</span>
												<span class="street" id="address">{{$add1[0]->address??''}}</span>
												</span>
                            </span>
                        </p>
                        <p class="buy-footer-address">
                            <span class="buy-line-title">收货人：</span>
                            <span class="buy-address-detail">
                                         <span class="buy-user" id="username">{{$add1[0]->username??''}} </span>
												<span class="buy-phone" id="phone">{{$add1[0]->phone??''}}</span>
												</span>
                        </p>
                    </div>
                </div>

                <div id="holyshit269" class="submitOrder">
                    <div class="go-btn-wrap">
                        <a id="J_Go" class="btn-go" tabindex="0" title="点击此按钮，提交订单" >提交订单</a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
</div>


@include('Public.footer');


</div>
<div class="theme-popover-mask"></div>
<div class="theme-popover">

    <!--标题 -->
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add address</small></div>
    </div>
    <hr/>

    <div class="am-u-md-12">
        <form class="am-form am-form-horizontal">

            <div class="am-form-group">
                <label for="user-name" class="am-form-label">收货人</label>
                <div class="am-form-content">
                    <input type="text" id="user-name" placeholder="收货人">
                </div>
            </div>

            <div class="am-form-group">
                <label for="user-phone" class="am-form-label">手机号码</label>
                <div class="am-form-content">
                    <input id="user-phone" placeholder="手机号必填" type="email">
                </div>
            </div>

            <div class="am-form-group">
                <label for="user-phone" class="am-form-label">所在地</label>
                <div class="am-form-content address">
                    <script src="{{asset('js/area.js')}}"></script>
                    <select name="province" id="province">
                        <option value="请选择">请选择</option>
                    </select>
                    <select name="city" id="city">
                        <option value="请选择">请选择</option>
                    </select>
                    <select name="town" id="town">
                        <option value="请选择">请选择</option>
                    </select>


                </div>
            </div>

            <div class="am-form-group">
                <label for="user-intro" class="am-form-label">详细地址</label>
                <div class="am-form-content">
                    <textarea class="" rows="3" id="small" placeholder="输入详细地址"></textarea>
                    <small>100字以内写出你的详细地址...</small>
                </div>
            </div>

            <div class="am-form-group theme-poptit">
                <div class="am-u-sm-9 am-u-sm-push-3">
                    <div class="am-btn am-btn-danger" onclick="add_address()">保存</div>
                    <div class="am-btn am-btn-danger close">取消</div>
                </div>
            </div>
        </form>
    </div>
    <input type="hidden" id="order_id" value="{{$rows[0]->order_id}}">
</div>
<script>
    // 设置收货地址
    function set(id) {
        $('.user-addresslist').each(function () {
            if($(this).hasClass('defaultAddr')){
                $(this).removeClass("defaultAddr");
            }

        })
        $('#add_'+id+'').addClass("defaultAddr")
        // 更改结算时的地址
        var _token = "{{csrf_token()}}"
        $.post("{{url('Goods/shipAddress')}}",{id:id,_token:_token},function(data){
            if(data){
                $('#pro').text(data.pro)
                $('#cit').text(data.cit)
                $('#are').text(data.are)
                $('#address').text(data.address)
                $('#username').text(data.username)
                $('#phone').text(data.phone)
            }
        },'json')
    }

</script>
<script>
    // 总金额
    var sum1 = 0
    $('.sum').each(function () {
        sum2 = $(this).val()
        sum1 = parseInt(sum1) + parseInt(sum2)
    })
    sum1 = sum1.toFixed(2)
    $('#sum').text(sum1)
    $('#J_ActualFee').text(sum1)

</script>

<script>
    function add_address() {
        var user = $('#user-name').val();
        var phone = $('#user-phone').val();

        var info = $('#small').val()

       var pro =  $('#province').val();

       var cit =  $('#city').val();
       var are =  $('#town').val();
       var aid = 'a';
        var _token = "{{csrf_token()}}"
        if(user != '' && phone != '' && info != '' && pro != '请选择' && cit != '请选择' && are != '请选择'){
        $.post("{{url('Person/addaddre')}}",{aid:aid,user:user,_token:_token,phone:phone,pro:pro,cit:cit,are:are,info:info},function (data) {
            var mess = data.mess+',3秒后自动刷新本页面'
            layui.use('layer', function() {
                var layer = layui.layer;
                layer.msg(mess);
            });

            setTimeout(function(){
                history.go(0);
            },3000);
        },'json')
            }else{
            alert('请完善信息后再提交')
        }
    }
</script>
<div class="clear"></div>
</body>

</html>
<script>

    $(document).ready(function($) {

        var $ww = $(window).width();

        $('.theme-login').click(function() {
//					禁止遮罩层下面的内容滚动
            $(document.body).css("overflow","hidden");

            $(this).addClass("selected");
            $(this).parent().addClass("selected");


            $('.theme-popover-mask').show();
            $('.theme-popover-mask').height($(window).height());
            $('.theme-popover').slideDown(200);

        })

        $('.theme-poptit .close,.btn-op .close').click(function() {

            $(document.body).css("overflow","visible");
            $('.theme-login').removeClass("selected");
            $('.item-props-can').removeClass("selected");
            $('.theme-popover-mask').hide();
            $('.theme-popover').slideUp(200);
        })


    });
</script>
<script>
    //支付方式
    $('.pay').each(function () {
        $('.pay').click(function () {
            $('.pay').removeClass('selected');
            $(this).addClass('selected')
        })
    })
</script>
<script>
    显示默认
    $('.user-addresslist').each(function () {
        // stat = $(this).attr("aid");
        if ($(this).attr("aid") == 'add_1'){
            $(this).addClass("defaultAddr")
        }else{
            alert('还没有设置默认地址,请选择收货地址')
        }
    })

</script>
<script>
    $('.OP_LOG_BTN').each(function () {
        $('.OP_LOG_BTN').click(function () {
            $('.OP_LOG_BTN').removeClass('selected');
            $(this).addClass('selected')
        })
    })
</script>


<script>
    $('#J_Go').click(function () {
        //获取地址id
        var addid = '';
       $('.user-addresslist').each(function(){
           if ($(this).hasClass('defaultAddr')){
            addid = $(this).attr('pid')
           }
       })
        if(addid == ''){
            alert('请填写收货人地址信息')
            return false
        }
        //获取快递信息
        $('.OP_LOG_BTN').each(function(){
            if ($(this).hasClass('selected')){
                express_type = $(this).attr('pid')
            }
        })
        //获取支付信息类型
        $('.pay').each(function(){
            if ($(this).hasClass('selected')){
                pay_type = $(this).attr('pid')
            }
        })
        //获取订单id
        var order_id = $('#order_id').val();
       //获取留言
        var info = $('#info22').val()
        var _token="{{csrf_token()}}"
        $.post("{{url('Goods/updateOrder')}}",{_token:_token,pay_type:pay_type,express_type:express_type,addid:addid,order_id:order_id,info:info},function (data) {
            if(data.mess == 1){
                window.location.href="{{url('Goods/sucess')}}?order="+order_id+"";
            }else{
                layui.use('layer', function() {
                    var layer = layui.layer;
                    layer.msg('服务器压力过大,请稍后再试');
                });
                setTimeout(function(){
                    history.go(0);
                },3000);
            }
        },'json')
    })
</script>
<script>
    var province=$("#province"),city=$("#city"),town=$("#town");
    for(var i=0;i<provinceList.length;i++){
        addEle(province,provinceList[i].name);
    }
    function addEle(ele,value){
        var optionStr="";
        optionStr="<option value="+value+">"+value+"</option>";
        ele.append(optionStr);
    }
    function removeEle(ele){
        ele.find("option").remove();
        var optionStar="<option value="+"请选择"+">"+"请选择"+"</option>";
        ele.append(optionStar);
    }
    var provinceText,cityText,cityItem;
    province.on("change",function(){
        provinceText=$(this).val();
        $.each(provinceList,function(i,item){
            if(provinceText == item.name){
                cityItem=i;
                return cityItem
            }
        });
        removeEle(city);
        removeEle(town);
        $.each(provinceList[cityItem].cityList,function(i,item){
            addEle(city,item.name)
        })
    });
    city.on("change",function(){
        cityText=$(this).val();
        removeEle(town);
        $.each(provinceList,function(i,item){
            if(provinceText == item.name){
                cityItem=i;
                return cityItem
            }
        });
        $.each(provinceList[cityItem].cityList,function(i,item){
            if(cityText == item.name){
                for(var n=0;n<item.areaList.length;n++){
                    addEle(town,item.areaList[n])
                }
            }
        });
    });
</script>