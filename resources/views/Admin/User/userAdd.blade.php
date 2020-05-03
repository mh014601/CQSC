<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="{{asset('Admin/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admin/css/select.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{asset('Admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('Admin/js/jquery.idTabs.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Admin/js/select-ui.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('layui/layui/css/layui.css')}}"  media="all">

</head>
<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">添加管理员</a></li>
    </ul>
</div>

<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="{{url('Admin/User/userAddAction')}}" method="post">
                {{csrf_field()}}
                <ul class="forminfo">
                    <li>
                        <label>用户名<b>*</b></label>
                        <input name="username" type="text" class="dfinput" placeholder="请填写用户名"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>姓名<b>*</b></label>
                        <input name="name" type="text" class="dfinput" placeholder="请填写姓名"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>密码<b>*</b></label>
                        <input id="pass" name="password" type="text" class="dfinput" placeholder="请填写密码"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>确认密码<b>*</b></label>
                        <input id="repass" type="text" class="dfinput" placeholder="请确认密码"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>出生日期<b>*</b></label>
                        {{--                        <input name="birthday" type="text" class="dfinput" placeholder="请确认密码"  style="width:518px;"/>--}}

                        <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
                            <input name="birthday" type="text" class="layui-input" id="test-limit1">
                        </div>
                    </li>

                    <li>
                        <label>状态<b>*</b></label>
                        <label for="open"></label>启用: <input checked="checked" name="status" id="open" type="radio" value="1" />
                        <label for="down"></label>禁用: <input name="status" id="down" type="radio" value="2" />
                    </li>

                    <li>
                        <label>性别<b>*</b></label>
                        <label for="open"></label>男: <input checked="checked" name="sex" id="open" type="radio" value="0" />
                        <label for="down"></label>女: <input name="sex" id="down" type="radio" value="1" />
                    </li>



                    <li>
                        <label>地址<b>*</b></label>
                        <input name="address" type="text" class="dfinput" placeholder="请确认地址"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>&nbsp;</label>
                        <input name="" type="submit" class="btn" value="添加"/>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    $('#repass').blur(function () {
        var pass =  $('#pass').val();
        var repass =  $('#repass').val();
        if(!(pass == repass)){
            alert('请保持密码和确认密码一致!!!')
        }
    })

</script>
<script src="{{asset('layui/layui/layui.js')}}" charset="utf-8"></script>

<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        // //执行一个laydate实例
        // laydate.render({
        //     elem: '#test1' //指定元素
        // });

        //限定可选日期
        var b = new Date();
        var c = b.getFullYear();
        var d = b.getMonth()+1;
        var e = b.getDate();
        var mm = c+"-"+d+"-"+e;
        var ins22 = laydate.render({
            elem: '#test-limit1'
            ,min: '1949-10-1'
            ,max: mm

        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $(".select1").uedSelect({
            width : 345
        });
        $(".select2").uedSelect({
            width : 167
        });
        $(".select3").uedSelect({
            width : 100
        });

    });
</script>
</html>

