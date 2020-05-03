<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
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
        <li><a href="#">添加权限</a></li>
    </ul>
</div>

<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="{{url('Admin/Auth/authAddAction')}}" method="post">
                {{csrf_field()}}
            <ul class="forminfo">

                <li>
                    <label>所属权限<b>*</b></label>
                    <div class="vocation">
                        <select name="pid" id="sel" class="select1">
                            <option value="0">根权限</option>
                            @foreach($rows as $v)
                                <option value="{{$v->id}}">
                                    {{$v->auth_name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </li>

                <li>
                    <label>权限名称<b>*</b></label>
                    <input name="auth_name" type="text" id="auth" class="dfinput" placeholder="请填写权限名称"  style="width:518px;"/>
                    <span id="info"></span>
                </li>

                <li id="hid">
                    <label>路由<b>*</b></label>
                    <input name="route" type="text" class="dfinput" placeholder="请填写路由"  style="width:518px;"/>
                </li>



                <li>
                    <label>&nbsp;</label>
                    <input name="" type="submit" id="sub" class="btn" value="添加"/>
                </li>
            </ul>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    $('#hid').css("display","none");

    $('#sel').change(function () {
        var x = $(this).val()
        if(x>0){
            $('#hid').css("display","block");
        }else{
            $('#hid').css("display","none");
        }
    })
</script>
<script>

    $('#sub').attr('disabled','disabled').css({'cursor':'not-allowed','background':'#999'})
    $('#auth').blur(function () {
        var authName = $('#auth').val();
        if(authName){
            $.post("{{url('Admin/Auth/ajaxAuthName')}}",{authName:authName},function (data) {
                if (data.status == 1){
                    $('#info').text('权限已存在')
                    $('#sub').attr('disabled','disabled').css({'cursor':'not-allowed','background':'#999'})
                }else if(data.status == 2){
                    $('#info').text('权限可用')
                    $('#sub').removeAttr('disabled').css({'cursor':'pointer','background':'blue'})
                }
            },'json')
        }else{
            alert('请填写权限...')
        }


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

        //加载富文本编辑器
        KindEditor.ready(function(K) {
            K.create('#content', {
                allowFileManager : true,
                filterMode:true,
                afterBlur:function(){
                    this.sync("#content");
                }
            });
        });
    });
</script>
</html>

