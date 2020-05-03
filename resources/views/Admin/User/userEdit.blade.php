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
        <li><a href="#">系统设置</a></li>
    </ul>
</div>

<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="{{url('Admin/User/userEditAction',[$row->id])}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <ul class="forminfo">
                    <li>
                        <label>真实姓名<b>*</b></label>
                        <input id="name" value="{{$row->name}}" name="name" type="text" class="dfinput" placeholder="请填写真实姓名"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>用户名<b>*</b></label>
                        <input id="username" value="{{$row->username}}" name="username" type="text" class="dfinput" placeholder="请填写用户名"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>电话<b>*</b></label>
                        <input id="phone" value="{{$row->phone}}" name="phone" type="text" class="dfinput" placeholder="请填写电话"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>电子邮箱<b>*</b></label>
                        <input id="email" value="{{$row->email}}" name="email" type="text" class="dfinput" placeholder="请填写商品库存"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>性别<b>*</b></label>
                        <label for="man">男:<input name="sex" type="radio"
                                                  @if($row->sex ==0)
                                                          checked = "checked"
                                                          @endif
                                                  id="man" value="0"></label>
                        <label for="woman">女:<input name="sex" type="radio"
                                                    @if($row->sex ==1)
                                                    checked = "checked"
                                                    @endif
                                                    id="woman" value="1"></label>
                    </li>

                    <li>
                        <label>生日<b>*</b></label>
                        <input name="birthday" type="text" value="{{$row->birthday}}" class="dfinput" placeholder="请填写生日"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>地址<b>*</b></label>
                        <input id="address" value="{{$row->address}}" name="address" class="dfinput" style="width:518px;"/>
                    </li>

                    <li>
                        <label>积分<b>*</b></label>
                        <input name="jifen" type="text" value="{{$row->jifen}}" class="dfinput" style="width:518px;"/>
                    </li>

                    <li>
                        <label>状态<b>*</b></label>
                        <label for="open">启用:<input type="radio" name="status"
                                                  @if($row->status ==1)
                                                  checked = "checked"
                                                  @endif
                                                  id="open" value="1"></label>
                        <label for="down">禁用:<input type="radio" name="status"
                                                    @if($row->status ==2)
                                                    checked = "checked"
                                                    @endif
                                                    id="down" value="2"></label>
                    </li>

                    <li>
                        <label>&nbsp;</label>
                        <input name="" id="sub" type="submit" class="btn" value="修改"/>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>

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


