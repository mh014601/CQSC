<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

    <title>地址管理</title>

    <link href="{{asset('AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/personal.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/addstyle.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('AmazeUI-2.4.2/assets/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('AmazeUI-2.4.2/assets/js/amazeui.js')}}"></script>
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

            <div class="user-address">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
                </div>
                <hr/>
                <ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">
                        {{--该用户下的所有收货地址--}}
                    @forelse( $rews1 as $k)
                    <li class="user-addresslist" id="li_{{$k->id}}" onclick="check()" adid="{{$k->id}}">
                        <span class="new-option-r"><i class="am-icon-check-circle"></i>默认地址</span>
                        <p class="new-tit new-p-re">
                            <span class="new-txt" id="user_{{$k->id}}">{{$k->username}}</span>
                            <span class="new-txt-rd2" id="phone_{{$k->id}}">{{$k->phone}} </span>
                        </p>
                        <div class="new-mu_l2a new-p-re">
                            <p class="new-mu_l2cw">
                                <span class="title">地址：</span>
                                <span class="province" id="pro_{{$k->id}}">{{$k->pro}}</span>
                                <span class="city" id="cit_{{$k->id}}">{{$k->cit}}</span>
                                <span class="dist" id="are_{{$k->id}}">{{$k->are}}</span>
                                <span class="street" id="info_{{$k->id}}">{{$k->address}}</span></p>
                        </div>
                        <div class="new-addr-btn">
                            <a href="javascript:void(0);" onclick="edit({{$k->id}})"><i class="am-icon-edit"></i>编辑</a>
                            <span class="new-addr-bar">|</span>
                            <a href="javascript:void(0);" onclick="delClick({{$k->id}});"><i class="am-icon-trash"></i>删除</a>
                        </div>
                    </li>
                    @empty

                        快来添加你的第一个地址吧...........

                    @endforelse
                </ul>
                <div class="clear"></div>
                <a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
                <!--例子-->
                <div class="am-modal am-modal-no-btn" id="doc-modal-1">

                    <div class="add-dress">

                        <!--标题 -->
                        <div class="am-cf am-padding">
                            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
                        </div>
                        <hr/>

                        <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                            <form class="am-form am-form-horizontal" id="form1" method="post">

                                <div class="am-form-group">
                                    <label for="user-name" class="am-form-label">收货人</label>
                                    <div class="am-form-content">
                                        <input type="text" id="user-name" placeholder="收货人" >
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-form-label" >手机号码</label>
                                    <div class="am-form-content">
                                        <input id="user-phone" placeholder="手机号必填" type="email">

                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-address" class="am-form-label">所在地</label>
                                    <div class="am-form-content address">
                                        <select id="pro">
                                            <option value="0">请选择省</option>
                                            @foreach($rows1 as $pro)
                                            <option value="{{$pro->id}}">{{$pro->area_name}}</option>
                                            @endforeach
                                        </select>
                                        <select id="cit">
                                            <option value="0">请选择市</option>

                                        </select>
                                        <select id="are">
                                            <option value="0">请选择区</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="am-form-group">
                                    <label for="user-intro" class="am-form-label">详细地址</label>
                                    <div class="am-form-content">
                                        <textarea class="" rows="3" id="user-intro" placeholder="输入详细地址"></textarea>
                                        <small>100字以内写出你的详细地址...</small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <a class="am-btn am-btn-danger" onclick="salfadd()">保存</a>
                                        <a href="javascript: void(0)" class="am-close am-btn am-btn-danger"  data-am-modal-close>取消</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

            <script type="text/javascript">
                $(document).ready(function() {
                    $(".new-option-r").click(function() {
                        $(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
                    });

                    var $ww = $(window).width();
                    if($ww>640) {
                        $("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
                    }

                })
            </script>

            <div class="clear"></div>

        </div>
        <!--底部-->
        @include('Public.footer')
    </div>

 @include('Public.info')
</div>

</body>

</html>


<script>
    $('#pro').on('change','',function(){
        $('#are option').not($('#are option').first()).remove();
        // 获取省份id
        var id = $(this).val();
        if(id != 0){
            flag3 = true
        }
        var _token = "{{csrf_token()}}"
        // 根据省份id 查询所有市区信息
        $.get("{{url('Person/address1')}}",{id:id,_token:_token},function (data) {
            var str = '';
            for(var i in data){
                str += '<option value="'+data[i].id+'">'+data[i].area_name+"</option>";
            }
            $('#cit option').not($('#cit option').first()).remove();
            $('#cit').append(str);
        },'json');
    })
    $('#cit').on('change','',function(){
        var id = $(this).val();
        var _token = "{{csrf_token()}}"
        // 根据省份id 查询所有市区信息
        $.get("{{url('Person/address1')}}",{id:id,_token:_token},function (data) {
            var str = '';
            for(var i in data){
                str += '<option>'+data[i].area_name+"</option>";
            }
            $('#are option').not($('#are option').first()).remove();
            $('#are').append(str);

        },'json');
    })
    //地址的三级联动

    var flag1 = false    //收货人
    var flag3 = false    //地址
    var flag2 = false    //手机号
    var flag4 = false    //详细地址
    //失去焦点验证收货人是否为空  不为空的话将标识改为false
    $('#user-name').blur(function () {
        user_name = $(this).val()
        if (user_name != ''){
            flag1 = true
        }else{
            flag1 = false
            layui.use('layer', function() {
                var layer = layui.layer;
                layer.msg('收货人不能为空');
            });
        }
    })
    //手机号
    $('#user-phone').blur(function () {
        var reg = /^[1][3,4,5,7,8,9][0-9]{9}$/
        user_name = $(this).val()
        if (user_name != ''){
            if(reg.test(user_name)) {
                flag2 = true
            }else{
                layui.use('layer', function() {
                    var layer = layui.layer;
                    layer.msg('请输入11位有效的手机号');
                });
                flag2 = false
            }
        }else{

            flag2 = false
            layui.use('layer', function() {
                var layer = layui.layer;
                layer.msg('收货人手机号不能为空');
            });
            // alert('收货人手机号不能为空')
        }
    })
    $('#user-intro').blur(function () {
        user_name = $(this).val()
        if (user_name != ''){
            flag4 = true
        }else{
            flag4 = false
            layui.use('layer', function() {
                var layer = layui.layer;
                layer.msg('请填写详细地址');
            });
            // alert('请填写详细地址')
        }
    })
//ajax提交地址信息
function salfadd(){
        //获取省
 var pro = $('#pro').find("option:selected").text();
 //获取市
 var cit = $('#cit').find("option:selected").text();
 //获取县
 var are = $('#are').find("option:selected").text();

//获取收货人姓名
var user = $('#user-name').val();
//收货人手机号
var phone = $('#user-phone').val();
//收货人详细信息
var info = $('#user-intro').val();
//用户id
    var id = 1;

//地址列表id
    if($('#addid').length>0){
    var id11 = $('#addid').val()
}else{
    var id11 = 'a';
}
    console.log(id11);

    if(flag1 &&flag2 &&flag3 &&flag4) {
    var _token = "{{csrf_token()}}"
        $.post("{{url('Person/addaddre')}}",{user:user,_token:_token,phone:phone,pro:pro,cit:cit,are:are,info:info,aid:id11},function (data) {
            console.log(data.mess)
            var mess = data.mess+',3秒后自动刷新本页面'
                layui.use('layer', function() {
                    var layer = layui.layer;
                    layer.msg(mess);
                });

            setTimeout(function(){
                window.location.href="{{url('Person/address')}}?uid="+id+"";
            },3000);
        },'json')
    }else{
        layui.use('layer', function() {
            var layer = layui.layer;
            layer.msg('请完善信息后再提交');
        });
    }
}
</script>


<script>
    //删除
    function delClick(id){
        $('#li_'+id+'').remove();
        var _token = "{{csrf_token()}}"
        $.post("{{url('Person/clearAddre')}}",{id:id,_token:_token},function (data) {
            layui.use('layer', function() {
                var layer = layui.layer;
                layer.msg(data.mess);
            });
        },'json')
    }


    //编辑
    function edit(id){
        var user1 = $('#user_'+id+'').text()
        var phone1 = $('#phone_'+id+'').text()
        var info1 = $('#info_'+id+'').text()

        // var pro1 = $('#pro_'+id+'').text()
        // var cit1 = $('#cit__'+id+'').text()
        // var are1 = $('#are_'+id+'').text()

        $('#user-intro').text(info1)
        $('#user-name').val(user1)
        $('#user-phone').val(phone1)

        // $("#pro").find("option[value = '"+pro1+"']").attr("selected","selected")
        // $("#cit").find("option[value = '"+cit1+"']").attr("selected","selected")
        // $("#are").find("option[value = '"+are1+"']").attr("selected","selected")
        // $("#pro option[text='+pro1+']").attr("selected", "selected");

        $('#form1').after(
       '<input type="hidden" id="addid" value="'+id+'">'
        )
    }




    //商品第一次遍历出来的时候  显示默认
    var flag ="{{$statu}}"
    if(flag) {
        $('.user-addresslist').each(function () {
            adid = $(this).attr('adid');

            if (adid == flag) {
                $('#li_' + flag + '').addClass('defaultAddr')
            }
        });
    }
    //设置默认
   function check()
    {

            $('.user-addresslist').each(function(){
                if ($(this).hasClass("defaultAddr")){
                    adid = $(this).attr('adid');

                    var _token = "{{csrf_token()}}"


                    $.post("{{url('Person/setdefa')}}",{adid:adid,_token:_token},function (data) {
                        // alert(data['mess1'])
                        layui.use('layer', function() {
                            var layer = layui.layer;
                            layer.msg(data['mess1']);
                        });

                    },'json')
                }
            });


    }
</script>