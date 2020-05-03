<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>列表页</title>
    <link href="{{asset('Admin/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admin/css/select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Common/css/app.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{asset('Admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('Admin/js/jquery.idTabs.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Admin/js/select-ui.min.js')}}"></script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">角色列表</a></li>
    </ul>
</div>

<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab2" class="tabson">
            <!-- 搜索 -->

            <!-- 列表 -->
            <table class="tablelist">
                <thead>
                <tr>
                    <th><input name="" type="checkbox" value="" checked="checked"/></th>
                    <th>编号<i class="sort"><img src="{{asset('Admin/images/px.gif')}}" /></i></th>
                    <th>角色名称</th>
                    <th>操作</th>

                </tr>
                </thead>
                <tbody>
                @forelse($roles as $v)
                    <tr id="id_{{$v->id}}">
                        <td >
                            <input name="" type="checkbox" value="" />
                        </td>
                        <td>{{$v->id}}</td>
                        <td>{{$v->role_name}}</td>
                            <td>
                                <a href="{{url('Admin/Role/assignAuth')}}?id={{$v->id}}" class="tablelink">权限管理</a>
                                <a href="javascript:void(0)" onclick="delRole({{$v->id}})" class="tablelink">删除</a>
                            </td>

                    </tr>
                @empty
                    <tr >
                        <td colspan="6" style="color: red" >找不到数据.........</td>
                    </tr>
                </tbody>
                @endforelse
            </table>

            <!-- 分页 -->
            <div class="pagin">
                <div class="message">共<i class="blue">{{$roles->total()}}</i>条记录，当前显示第&nbsp;<i class="blue">{{$roles->currentPage()}}</i>页</div>
                <ul class="paginList">
                    {{$roles->links()}}
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    function delRole(id) {
        // alert(1);
        //删除
        var bool = confirm('确定要删除吗?');
        if(bool){
            //显示
            var aid = 'id_'+id;
            $('#'+aid).remove();
            //数据库删除
            $.post("{{url('Admin/Role/ajaxRoleDel')}}",{id:id},function ($data) {
                if ($data.status == 1){
                    alert('删除成功!')
                }

            },'json')
        }
    }
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
        $("#usual1 ul").idTabs();
        $('.tablelist tbody tr:odd').addClass('odd');
    });
</script>
</html>


