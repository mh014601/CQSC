你正在为"{{$role->role_name}}"分配权限

<script src="https://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
<style>
    li{
        list-style-type: none;
    }
</style>

<form action="{{url('Admin/Role/assignAuthAction')}}" method="post">
    {{csrf_field()}}
@forelse($rows as $v)
<ul>
    <li><input type="checkbox" class="chk" name="auth_id[]" value="{{$v->aid}}" myid="{{$v->aid}}"
               pid="{{$v->pid}}" checkSel="sel_{{$v->pid}}" ch="ch_{{$v->aid}}"
               @if($v->issel == 1)
                   checked
               @endif
        >{{$v->auth_name}}</li>

        <li>
    <ul>
        @if(isset($v->son))
        @forelse($v->son as $v1)
        <li><input type="checkbox" class="chk" name="auth_id[]" value="{{$v1->aid}}" myid="{{$v1->aid}}"
                   pid="{{$v1->pid}}" checkSel="sel_{{$v1->pid}}"
                   @if($v1->issel == 1)
                   checked
                    @endif
            >{{$v1->auth_name}}</li>
            @empty
            没有数据...
        @endforelse
            @endif
    </ul>
        </li>

</ul>
    @empty
    没有数据...
@endforelse
    <input type="hidden" name="role_id" value="{{$id}}">
    <input type="submit">
</form>

<script>
$('.chk').click(function () {
    var sel = $(this).is(':checked');
    var myid = $(this).attr('myid');
    var pid = $(this).attr('pid');
    if (sel){
        //孩子选中
        $("input[checkSel='sel_"+myid+"']").prop('checked','checked');
        //父亲选中
        $("input[ch='ch_"+pid+"']").prop('checked','checked');
    }else{
        //父亲不选中  都不选
        $("input[checkSel='sel_"+myid+"']").removeAttr('checked');
        var flag = true;
        $("input[checkSel='sel_"+pid+"']").each(function () {
            if($(this).is(':checked')){
                flag = false;
            }
        });
        if (flag){
            $("input[ch='ch_"+pid+"']").removeAttr('checked');
        }
    }
})
</script>