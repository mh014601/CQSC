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
        <li><a href="#">订单列表</a></li>
    </ul>
</div>

<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab2" class="tabson">
            <!-- 搜索 -->
            <form action="{{url('Admin/Order/orderList')}}" method="post">
                <input type="hidden" name="search" value="search">
                {{csrf_field()}}
                <ul class="seachform">
                    <li>
                        <label>综合查询</label>

                        <input name="keyword" value="{{$keyword}}" type="text" class="scinput" />

                    </li>

                    <li>
                        <label>&nbsp;</label>
                        <input name="" id="sub" type="submit" class="scbtn" value="查询"/>
                    </li>
                </ul>
            </form>
            <!-- 列表 -->
            <table class="tablelist">
                <thead>
                <tr>
                    <th><input name="" type="checkbox" value="" checked="checked"/></th>
                    <th>编号<i class="sort"><img src="{{asset('Admin/images/px.gif')}}" /></i></th>
                    <th>订单号</th>
                    <th>用户</th>
                    <th>商品</th>
                    <th>商品数量</th>
                    <th>地址</th>
                    <th>订单状态</th>
                    <th>支付方式</th>
                    <th>快递方式</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @forelse($rows as $v)
                    <tr id="id_{{$v->id}}">
                        <td>
                            <input name="" type="checkbox" value="" />
                        </td>
                        <td>{{$v->id}}</td>
                        <td>{{$v->order_id}}</td>

                        <td>{!! str_replace($keyword,"<span style='color:red;display:inline'>$keyword</span>",$v->name) !!}</td>
                        <td>{{$v->good_name}}</td>
                        <td>{{$v->pnum}}</td>
                        <td>{{$v->address}}</td>
                        <td>
                            @if($v->status == 0)
                                <span>已支付</span>
                            @endif
                            @if($v->status == 1)
                                <span>未支付</span>
                            @endif
                        </td>
                        <td>{{$v->pay_type}}</td>
                        <td>{{$v->express_type}}</td>
{{--                        <td>{{date('Y-m-d H:i:s',$v->time)}}</td>--}}
                        <td>{{$v->time}}</td>
                        <td>
                            <a href="{{url('Admin/Order/orderEdit',[$v->id])}}" class="tablelink">编辑</a>
{{--                            <a href="javascript:void(0)" id="del" onclick="userDel({{$v->id}})" class="tablelink">删除</a>--}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13">找不到数据......</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <!-- 分页 -->
            <div class="pagin">
                <div class="message">共<i class="blue">{{$rows->total()}}</i>条记录，当前显示第&nbsp;<i class="blue">{{$rows->currentPage()}}</i>页</div>
                <ul class="paginList">
                    {{$rows->appends(['keyword'=>$keyword,'search'=>$search])->links()}}

                </ul>
            </div>
        </div>
    </div>
</div>
</body>
<script>

</script>
<script>
    function userDel(id) {
        var bool = confirm('你确定要删除吗?');
        if (bool){
            $('#id_'+id).remove();
            $.post("{{url('Admin/User/userDel')}}",{id:id},function (data) {
                if (data.status == 1){
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


