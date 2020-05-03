<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>列表页</title>
    <link href="{{asset('Admin/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admin/css/select.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{asset('Admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('Admin/js/jquery.idTabs.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Admin/js/select-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Admin/kindeditor/kindeditor-all.js')}}"></script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">分类列表</a></li>
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
                    <th>商品分类名称</th>

                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @forelse($rows as $v)
                <tr id="id_{{$v->id}}" f="f_{{$v->pid}}" onclick="menu({{$v->id}})">
                    <td>
                        <input name="" type="checkbox" value="" />
                    </td>
                    <td>{{$v->id}}</td>
                    @if(substr_count($v->path,',') == 0)
                        <td style="color: red">{{str_repeat('--',substr_count($v->path,','))}}{{$v->cate_name}}</td>
                        @endif
                    @if(substr_count($v->path,',') == 1)
                        <td style="color: blue">{{str_repeat('--',substr_count($v->path,','))}}{{$v->cate_name}}</td>
                    @endif
                    @if(substr_count($v->path,',') == 2)
                        <td style="color: green">{{str_repeat('--',substr_count($v->path,','))}}{{$v->cate_name}}</td>
                    @endif


                    <td>
                        <a href="#" class="tablelink">查看</a>
                        <a href="javascript:void(0)" onclick="goodsCateDel({{$v->id}})" class="tablelink">删除</a>
                    </td>
                </tr>
                    @empty
                    <tr>
                        <td colspan="4">找不到数据......</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>

            <!-- 分页 -->

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
    function goodsCateDel(id) {
        var bool = confirm('你确定要删除吗?');
        var _token = '{{csrf_token()}}';
        if (bool){

            $.post("{{url('Admin/GoodsCate/goodsCateDel')}}",{id:id,_token:_token},function (data) {
                if (data.status == 1){
                    $('#id_'+id).remove();
                    alert('删除成功!')
                }else if(data.status == 2){
                    alert('请先删除分类下的商品!')
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
