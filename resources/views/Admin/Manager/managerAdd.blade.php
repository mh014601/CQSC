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
    <script type="text/javascript" src="{{asset('Admin/kindeditor/kindeditor-all.js')}}"></script>
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
            <form action="{{url('Admin/Manager/managerAddAction')}}" method="post">
                {{csrf_field()}}
            <ul class="forminfo">
                <li>
                    <label>管理员名称<b>*</b></label>
                    <input name="ad_name" type="text" class="dfinput" placeholder="请填写管理员名称"  style="width:518px;"/>
                </li>

                <li>
                    <label>密码<b>*</b></label>
                    <input id="pass" name="ad_pass" type="text" class="dfinput" placeholder="请填写密码"  style="width:518px;"/>
                </li>

                <li>
                    <label>确认密码<b>*</b></label>
                    <input id="repass" name="repass" type="text" class="dfinput" placeholder="请确认密码"  style="width:518px;"/>
                </li>

                <li>
                    <label>状态<b>*</b></label>
                    <label for="open"></label>启用: <input checked="checked" name="status" id="open" type="radio" value="1" />
                    <label for="down"></label>禁用: <input name="status" id="down" type="radio" value="2" />
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

