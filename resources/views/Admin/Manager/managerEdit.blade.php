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
</head>
<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">系统设置</a></li>
    </ul>
</div>

<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="{{url('Admin/Manager/managerEditAction')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$row->id}}">
                <ul class="forminfo">
                    <li>
                        <label>管理员名称<b>*</b></label>
                        <input name="ad_name" type="text" id="ad" class="dfinput" placeholder="请填写管理员名称"  style="width:518px;" value="{{$row->ad_name}}"/>
                        <span id="spa"></span>
                    </li>
                    <li>
                        <label>状态<b>*</b></label>
                        <label for="open"></label>启用: <input @if($row->status == 1)
                                                             checked="checked"
                                                             @endif name="status" id="open" type="radio" value="1" />
                        <label for="down"></label>禁用: <input name="status" @if($row->status == 2)
                        checked="checked"
                                                             @endif id="down" type="radio" value="2" />
                    </li>

                    <li>
                        <label>所属角色<b>*</b></label>
                        <div class="vocation">
                            <select name="role_id" class="select1">
                                <option value="0">请选择角色</option>
                                @foreach($roles as $v)
                                    <option value="{{$v->id}}">
                                        {{$v->role_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </li>

                    <li>
                        <label>&nbsp;</label>
                        <input name="" type="submit" class="btn" value="修改"/>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    $('#ad').blur(function () {
        var ad_name = $('#ad').val();
        var aid = $("input[name='id']").val()
        $.post("{{url('Admin/Manager/ajaxManagerName')}}",{ad_name:ad_name,aid:aid},function (data) {
                    if (data.status == 1){
                        $('#spa').text('用户名已存在...')
                    }else if(data.status == 2){
                        $('#spa').text('这是你没修改前用户名')
                    }else{
                        $('#spa').text('用户名可用')
                    }
        },'json')
    })
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

