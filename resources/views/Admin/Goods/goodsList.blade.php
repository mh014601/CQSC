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
        <li><a href="#">商品列表</a></li>
    </ul>
</div>

<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab2" class="tabson">
            <!-- 搜索 -->
            <form action="{{url('Admin/Goods/goodsList')}}" method="post">
                <input type="hidden" name="search" value="search">
                {{csrf_field()}}
            <ul class="seachform">
                <li>
                    <label>综合查询</label>
                    <input name="keyword" value="{{$keyword}}" type="text" class="scinput" />
                </li>
                <li>
                    <label>分类</label>
                    <div class="vocation">
                        <select class="select3" name="cate_id">
                            <option value="0">全部</option>
                            @foreach($cateList as $v)
                            <option value="{{$v->id}}">{{str_repeat('--',substr_count($v->path,','))}}{{$v->cate_name}}</option>
                                @endforeach
                        </select>
                    </div>
                </li>
                <li>
                    <label>&nbsp;</label>
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
                    <th>商品类别</th>
                    <th>商品名称</th>
                    <th>原价</th>
                    <th>现价</th>
                    <th>图片</th>
                    <th>详情</th>
                    <th>库存</th>
                    <th>包装信息</th>
                    <th>总销量</th>
                    <th>当月销量</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @forelse($rows as $v)
                <tr id="id_{{$v->gid}}">
                    <td>
                        <input name="" type="checkbox" value="" />
                    </td>
                    <td>{{$v->gid}}</td>
                    <td>{{$v->cate_name}}</td>
                    <td>{!! str_replace($keyword,"<span style='color:red;display:inline'>$keyword</span>",$v->good_name) !!}</td>
                    <td>{{$v->old_price}}</td>
                    <td>{{$v->new_price}}</td>
                    <td><img src="{{asset("upload/$v->pic")}}" alt="" width="50px"></td>
                    <td>{{$v->detail}}</td>
                    <td>{{$v->inventory}}</td>
                    <td>{{$v->info}}</td>
                    <td>{{$v->total_sale}}</td>
                    <td>{{$v->month_sale}}</td>
                    <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
                    <td>
                        <a href="{{url('Admin/Goods/goodsEdit',[$v->gid])}}" class="tablelink">编辑</a>
                        <a href="javascript:void(0)" id="del" onclick="goodsDel({{$v->gid}})" class="tablelink">删除</a>
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
                    {{$rows->appends(['keyword' => $keyword,'search'=>$search,'cate_id'=>$cate_id])->links()}}
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
<script>

</script>
<script>
function goodsDel(id) {
    var bool = confirm('你确定要删除吗?');
    var _token = '{{csrf_token()}}';
    if (bool){
        $('#id_'+id).remove();
        $.post("{{url('Admin/Goods/goodsDel')}}",{id:id,_token:_token},function (data) {
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

