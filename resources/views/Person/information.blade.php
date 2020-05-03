<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

    <title>个人资料</title>

    <link href="{{asset('AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/personal.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/infstyle.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('AmazeUI-2.4.2/assets/js/amazeui.js')}}"></script>
    <script src="{{asset('layui/layui/layui.js')}}"></script>

    <link href="{{asset('layui/layui/css/layui.css')}}" rel="stylesheet" type="text/css">

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

            <div class="user-info">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
                </div>
                <hr/>

                <!--头像 -->
                <form class="am-form am-form-horizontal" action="{{url('Home/Infor/saveEditAction')}}" id="form1" method="post">
                    <div class="user-infoPic">

                        <div class="filePic">
                            <input type="file" onchange="showPic()" style="display:none" id="pic"  class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                            <img class="am-circle am-img-thumbnail"  id="img"  src='{{asset("$rows->user_pic")}}' alt="" />

                        </div>
                        <div>
                            <li class="dangq_hongx"><a href="javascript:void(0)" id="bth">上传头像</a></li>
                        </div>
                        <script>
                            //上传图片
                            $('#bth').click(function () {
                                var fd = new FormData();
                                fd.append("pic",pic);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{url('Home/Infor/uploadPic')}}",
                                    data: fd,
                                    processData: false,   // jQuery不要去处理发送的数据
                                    contentType: false,   // jQuery不要去设置Content-Type请求头
                                    success: function(res){
                                        alert('上传成功')
                                    }
                                });
                            })
                        </script>

                        <p class="am-form-help">头像</p>

                        <div class="info-m">
                            @if(Session::get('user'))
                                <div><b>用户名：<i>{{Session::get('user')}}</i></b></div>
                            @else
                                <a href="{{url('Home/Index/login')}}">点我登录修改料</a>
                            @endif
                            <div class="vip">
                                <span></span><a href="#">会员专享</a>

                            </div>

                        </div>
                    </div>


                    <!--个人信息 -->
                    <div class="info-main">

                        {{csrf_field()}}
                        <div class="am-form-group">
                            <label for="user-name2" class="am-form-label" name="">昵称</label>
                            <div class="am-form-content">
                                <input type="text" id="username" value="{{$row->username}}" name="username" placeholder="用户名">
                                <small>昵称长度不能超过40个汉字</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-form-label">姓名</label>
                            <div class="am-form-content">
                                <input type="text" id="name" value="{{$row->name}}" name="name" placeholder="name">

                            </div>
                        </div>
                        {{--                        <div class="layui-form-item">--}}
                        {{--                            <label class="layui-form-label">单选框</label>--}}
                        {{--                            <div class="layui-input-block">--}}
                        {{--                                <input type="radio" name="sex" value="0" title="男">--}}
                        {{--                                <input type="radio" name="sex" value="1" title="女" checked>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="am-form-group">
                            <label class="am-form-label">性别</label>
                            <div class="am-form-content sex">
                                {{--                                <label class="am-radio-inline">--}}
                                {{--                                    <input type="radio" name="sex" id="male" value="male" data-am-ucheck> 男--}}
                                {{--                                </label>--}}
                                {{--                                <label class="am-radio-inline">--}}
                                {{--                                    <input type="radio" name="sex" id="female" value="female" data-am-ucheck> 女--}}
                                {{--                                </label>--}}
                                {{--                                <label class="am-radio-inline">--}}
                                {{--                                    <input type="radio" name="sex" id="secret" value="secret" data-am-ucheck> 保密--}}
                                {{--                                </label>--}}
                                <div class="layui-input-block">
                                    @if($row->sex==0)
                                        <input type="radio" name="sex" value="0" title="男" checked>男
                                        <input type="radio" name="sex" value="1" title="女">女
                                        <input type="radio" name="sex" value="2" title="保密" >保密
                                    @elseif($row->sex==1)
                                        <input type="radio" name="sex" value="0" title="男" >男
                                        <input type="radio" name="sex" value="1" title="女" checked>女
                                        <input type="radio" name="sex" value="2" title="保密" >保密
                                    @else
                                        <input type="radio" name="sex" value="0" title="男" >男
                                        <input type="radio" name="sex" value="1" title="女">女
                                        <input type="radio" name="sex" value="2" title="保密" checked>保密
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-birth" class="am-form-label">生日</label>
                            <div class="am-form-content birth">
                                <div class="birth-select">
                                    <input type="text" value="{{$row->birthday}}" class="layui-input" id="test1" name="test1" placeholder="y-m-d">
                                </div>
                            </div>
                        </div>


                        @if($status !=2)
                            <div class="am-form-group">
                                <label for="user-phone" class="am-form-label">电话</label>
                                <div class="am-form-content">
                                    <input id="phone" name="phone" value="{{$row->phone}}" placeholder="telephonenumber" type="tel">

                                </div>
                            </div>
                        @else
                            <div class="am-form-group">
                                <label for="user-email" class="am-form-label">电子邮件</label>
                                <div class="am-form-content">

                                    <input id="email" name="email" value="{{$row->email}}" placeholder="Email" type="email">

                                </div>
                            </div>
                        @endif
                        <div class="info-btn">
                            <input type="submit" name="submit" id="submit" value="提交资料" class="am-btn am-btn-primary am-btn-sm am-fl">
                        </div>

                    </div>
                </form>
            </div>

        </div>
        <!--底部-->
        @include('Public.footer')
    </div>

    @include('Public.info')
</div>
<script>
    var pic = '';
    // document.getElementById('img').onclick = function () {
    //
    // }
    $("#img").click(function () {
        $("#pic").click();
    });
    function showPic(){
        pic = document.getElementsByTagName('input')[2].files[0];
        var pic_source = window.URL.createObjectURL(pic); // 把图片资源对象,读取成浏览器可以显示的 资源 二进制
        // 把图片资源 动态追加到 img src 属性
        document.getElementById('img').src = pic_source;
        {{--var _token = "{{csrf_token()}}";--}}
        {{--$.get("{{url('Home/Infor/up_pic')}}",{_token:_token},function (data) {--}}
        {{--    if(data.status){--}}

        {{--    }--}}
        {{--},'json')--}}
    }

</script>
<script>
    $('#email').blur(function () {
        email = $(this).val();
        var reg_email = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/;
        if(!reg_email.test(email)){
            alert('邮箱格式不正确！');
        }
    });

    $('#phone').blur(function () {
        phone = $(this).val();
        var reg_phone = /^[1][3,4,5,7,8,9][0-9]{9}$/;
        if(!reg_phone.test(phone)){
            alert('手机格式不正确！');
        }
    });

    var b = new Date();
    var c = b.getFullYear();
    var d = b.getMonth()+1;
    var e = b.getDate();
    var mm = c+"-"+d+"-"+e;

    var time = ""
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '#test1' //指定元素

            ,min: '1900-1-1'
            ,max: mm
            ,done:function (value,data,endDate) {
                time = value;
            }
        });
    });
    $('#salf').click(function () {
        alert(time)
    })

    //图片上传


</script>

</body>

</html>