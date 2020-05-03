<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

    <title>安全设置</title>

    <link href="{{asset('AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('AmazeUI-2.4.2/assets/js/amazeui.min.js')}}"></script>

    <link href="{{asset('css/personal.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/infstyle.css')}}" rel="stylesheet" type="text/css">
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

            <!--标题 -->
            <div class="user-safety">
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">账户安全</strong> / <small>Set&nbsp;up&nbsp;Safety</small></div>
                </div>
                <hr/>

                <!--头像 -->
                <div class="user-infoPic">

                    <div class="filePic">
                        <img class="am-circle am-img-thumbnail" src="{{asset($rew)}}" alt="" />
                    </div>

                    <p class="am-form-help">头像</p>

                    <div class="info-m">
                        @if(Session::get('user'))
                        <div><b>用户名：<i>{{(Session::get('user'))}}</i></b></div>
                        @endif
                        <div class="safeText">
                            <a href="safety.html">账户安全:<em style="margin-left:20px ;">60</em>分</a>
                            <div class="progressBar"><span style="left: -95px;" class="progress"></span></div>
                        </div>
                    </div>
                </div>

                <b class="line"></b>
                <div class="center">
                    <div class="col-main">
                        <div class="main-wrap">

                            <div class="am-cf am-padding">
                                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong> / <small>Password</small></div>
                            </div>
                            <hr/>
                            <!--进度条-->
                            <div class="m-progress">
                                <div class="m-progress-list">
{{--							<span class="step-1 step">--}}
{{--                                <em class="u-progress-stage-bg"></em>--}}
{{--                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>--}}
{{--                                <p class="stage-name">重置密码</p>--}}
{{--                            </span>--}}
{{--                                    <span class="step-2 step">--}}
{{--                                <em class="u-progress-stage-bg"></em>--}}
{{--                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>--}}
{{--                                <p class="stage-name">完成</p>--}}
{{--                            </span>--}}
                                    <span class="u-progress-placeholder"></span>
                                </div>
                                <div class="u-progress-bar total-steps-2">
                                    <div class="u-progress-bar-inner"></div>
                                </div>
                            </div>
{{--                            <form class="am-form am-form-horizontal" action="{{url('Home/Infor/safetyAction')}}">--}}
                                <div class="am-form-group">
                                    <label for="user-old-password" class="am-form-label">原密码</label>
                                    <div class="am-form-content">
                                        <input type="password" id="password" name="password" placeholder="请输入原登录密码">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-new-password" class="am-form-label" >新密码</label>
                                    <div class="am-form-content">
                                        <input type="password"  name="password1" id="password1" placeholder="请输入新密码">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-confirm-password"   class="am-form-label">确认密码</label>
                                    <div class="am-form-content">
                                        <input type="password" name="password2" id="password2"  placeholder="请再次输入上面的密码">
                                    </div>
                                </div>
                                <div class="info-btn">
                                    <input type="submit" name="submit" id="submit" value="保存修改" >
                                </div>

{{--                            </form>--}}

                        </div>



</div>
</div>
                <script>

                    $('#password').blur(function (){
                        password = $(this).val();
                        var _token = "{{csrf_token()}}"
                        $.get('{{url("Home/Infor/ajax_checkPassword")}}',{password:password,_token:_token},function (data) {
                            if(data.status==1){
                                alert('您输入的密码不正确!')
                            }else{
                             // alert('密码正确!')
                            }

                        },'json');
                    })
                    $('#password1').blur(function () {
                        password1 = $(this).val();
                        var reg_password1 = /^[a-z+A-Z+0-9+]{3,15}$/;
                        if(!reg_password1.test(password1)){
                            alert('对不起！密码格式不正确！');
                        }
                    });
                    $('#password2').blur(function () {
                        password2 = $(this).val();
                        if(password2 !==password1){
                            alert('确认密码新密码不一致!')
                        }
                    })
                    $('#submit').click(function () {

                        password1 = $('#password1').val();

                        var _token = "{{csrf_token()}}";
                        console.log(1)
                        $.get('{{url("Home/Infor/safetyAction")}}',{password1:password1,_token:_token},function (data) {
                            if(data.status== 1){

                            alert('密码修改成功!')
                            return window.location.href="{{url('Home/Index/login')}}";
                        }else{
                            alert('密码修改失败!')
                        }
                        },'json')
                    })
                </script>


            </div>
            </div>
        @include('Public.footer')
            </div>
    @include('Public.info')
            </div>
</body>

</html>