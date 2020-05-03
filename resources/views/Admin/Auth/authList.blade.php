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
        <li><a href="#">权限列表</a></li>
    </ul>
</div>

<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab2" class="tabson">
            <!-- 搜索 -->
            <form action="{{url('Admin/Manager/managerList')}}" method="post">
                {{csrf_field()}}
                <ul class="seachform">
                    <li>
                        <label>查询权限</label>
                        <input name="keyword" type="text" class="scinput" />
                    </li>
                    <li>

                        <input name="" type="submit" class="scbtn" value="查询"/>
                    </li>
                </ul>
            </form>
            <!-- 列表 -->
            <table class="tablelist">
                <thead>
                <tr>
                    <th><input name="" type="checkbox" value="" checked="checked"/></th>
                    <th>编号<i class="sort"><img src="{{asset('Admin/images/px.gif')}}" /></i></th>
                    <th>权限名称</th>
                    <th>路由</th>
                    <th>等级</th>

                        <th>操作</th>

                </tr>
                </thead>
                <tbody>
                @forelse($authList as $v)
                    <tr id="id_{{$v->id}}" f="f_{{$v->pid}}" onclick="menu({{$v->id}})">
                        <td >
                            <input name="" type="checkbox" value="" />
                        </td>
                        <td>{{$v->id}}</td>
                        <td style="font-weight: bolder">{{$v->auth_name}}</td>
                        <td>{{$v->route}}</td>
                        <td>{{$v->level}}</td>
                        <td>
                            <a href="javascript:void(0)" class="tablelink">查看</a>
                            <a href="javascript:void(0)" onclick="ajaxAuthDel({{$v->id}})" class="tablelink">删除</a>
                        </td>
                    </tr>
@if(isset($v->son))
    @forelse($v->son as $v1)
                    <tr id="id_{{$v1->id}}" f="f_{{$v1->pid}}" onclick="menu({{$v1->id}})">
                        <td >
                            <input name="" type="checkbox" value="" />
                        </td>
                        <td>{{$v1->id}}</td>
                        <td >----{{$v1->auth_name}}</td>
                        <td>{{$v1->route}}</td>
                        <td>{{$v1->level}}</td>
                        <td>
                            <a href="javascript:void(0)" class="tablelink">查看</a>
                            <a href="javascript:void(0)" onclick="ajaxAuthDel({{$v1->id}})" class="tablelink">删除</a>
                        </td>
                    </tr>
                    @empty
        <tr >
            <td colspan="6" style="color: red" >找不到数据.........</td>
        </tr>
        @endforelse
                    @endif
                @empty
                    <tr >
                        <td colspan="6" style="color: red" >找不到数据.........</td>
                    </tr>
                </tbody>
                @endforelse
            </table>

            <!-- 分页 -->

        </div>
    </div>
</div>
</body>
<script>
    $("tr[f!='f_0']").hide();
    function menu(id) {
        $("tr[f='f_"+id+"']").toggle();

    }
</script>
<script>
    function ajaxAuthDel(id) {
        var bool = confirm('你确定要删除吗?');
        if (bool){
            $.post("{{url('Admin/Auth/ajaxAuthDel')}}",{id:id},function (data) {
                if (data.status == 1){
                    $('#id_'+id).remove();
                    alert('删除成功!')
                }else if(data.status == 2){
                    alert('删除失败!')
                }else if(data.status == 3){
                    alert('请先删除子分类!')
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


