<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>

    <link href="{{asset('Admin/css/select.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{asset('Admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('Admin/js/jquery.idTabs.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Admin/js/select-ui.min.js')}}"></script>
    <script src="{{asset('layui/layui/layui.js')}}" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('layui/layui/css/layui.css')}}"/>
</head>
<body>



<div class="formbody" >
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="{{url('Admin/Role/roleAddAction')}}" method="post">
                {{csrf_field()}}
            <ul class="forminfo" >
                <li style="text-align: center">
                    <label style="font-size: 30px;">角色名称:</label>
                    <input name="role_name" id="role" value="" type="text" class="dfinput" placeholder="请填写角色名称"  style="width:200px;height: 35px;"/>
                    <span id="info"></span>
                </li>


                <div class="layui-form" lay-filter="layuiadmin-form-role" id="layuiadmin-form-role" style="padding: 20px 30px 0 0;">

                    <div class="layui-form-item" id="test">
                        <label class="layui-form-label">权限范围</label>

                    @foreach($rows as $v)
                        <ul class="layui-input-block" style="margin-top: 10px ;">
                            <li>
                                <input type="checkbox" class="parent" name="auth_id[]" value="{{$v->aid}}"  lay-skin="primary" title="{{$v->auth_name}}">
                                <ul>
                                    @foreach($v->son as $v1)
                                    <input type="checkbox" name="auth_id[]" value="{{$v1->aid}}"  lay-skin="primary" title="{{$v1->auth_name}}">
                                        @endforeach
                                </ul>
                            </li>
                        </ul>
                    @endforeach


                    </div>
                </div>


                <li style="text-align: center">
                    <label>&nbsp;</label>
                    <input name="" type="submit" id="sub"class="layui-btn layui-btn-normal" value="添加"/>
                </li>
            </ul>
            </form>
        </div>
    </div>
</div>
</body>

<script type="text/javascript">

    layui.use(['table','form','jquery'], function() {
        var form = layui.form,
            table = layui.table,
            $=layui.jquery;

        form.on('checkbox()', function(data){

            var pc =  data.elem.classList //获取选中的checkbox的class属性

            /* checkbox处于选中状态  */
            if(data.elem.checked==true){//并且当前checkbox为选中状态
                /*如果是parent节点 */
                if(pc=="parent"){  //如果当前选中的checkbox class里面有parent
                    //获取当前checkbox的兄弟节点的孩子们是 input[type='checkbox']的元素
                    var c =$(data.elem).siblings().children("input[type='checkbox']");

                    c.each(function(){//遍历他们的孩子们
                        var e = $(this); //添加layui的选中的样式   控制台看元素
                        $(this).prop('checked','checked');
                        e.next().addClass("layui-form-checked");
                    });
                }else{/*如果不是parent*/
                    //选中子级选中父级
                    $(data.elem).parent().parent().children("input[type='checkbox']").prop('checked','checked')
                    $(data.elem).parent().prev().addClass("layui-form-checked");
                }

            }else{	/*checkbox处于 false状态*/

                //父级没有选中 取消所有的子级选中
                if(pc=="parent"){/*判断当前取消的是父级*/
                    var c =$(data.elem).siblings().children("input[type='checkbox']");
                    c.each(function(){
                        var e = $(this);
                        $(this).removeAttr('checked');
                        e.next().removeClass("layui-form-checked")
                    });
                }else{/*不是父级*/

                    var c = $(data.elem).siblings("div");
                    var count =0;
                    c.each(function(){//遍历他们的孩子们
                        //如果有一个==3那么久说明是处于选中状态
                        var is =  $(this).get(0).classList;
                        if(is.length==3){
                            count++;
                        }
                    });
                    //如果大于0说明还有子级处于选中状态
                    if(count>0){

                    }else{/*如果不大于那么就说明没有子级处于选中状态那么就移除父级的选中状态*/
                        $(data.elem).parent().parent().children("input[type='checkbox']").removeAttr('checked')
                        $(data.elem).parent().prev().removeClass("layui-form-checked");
                    }
                }
            }
        });

    });

</script>
<script>
    $('.layui-form-checked')
</script>
<script>

    $('#sub').attr('disabled','disabled').css({'cursor':'not-allowed','background':'#999'})
    $('#role').blur(function () {
        var roleName = $('#role').val();
        if(roleName){
            $.post("{{url('Admin/Role/ajaxRoleName')}}",{roleName:roleName},function (data) {
                if (data.status == 1){
                    $('#info').text('角色已存在')
                    $('#sub').attr('disabled','disabled').css({'cursor':'not-allowed','background':'#999'})
                }else if(data.status == 2){
                    $('#info').text('角色可用')
                    $('#sub').removeAttr('disabled').css({'cursor':'pointer','background':'#1E9FFF'})
                }
            },'json')
        }else{
            alert('请填写角色...')
        }

    })
</script>

</html>

