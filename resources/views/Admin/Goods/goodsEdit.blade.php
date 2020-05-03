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
            <form action="{{url('Admin/Goods/goodsEditAction')}}?id={{$goods->id}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <ul class="forminfo">
                    <li>
                        <label>商品名称<b>*</b></label>
                        <input id="good_name" value="{{$goods->good_name}}" name="good_name" type="text" class="dfinput" placeholder="请填写商品名称"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>商品原价<b>*</b></label>
                        <input id="new_price" value="{{$goods->new_price}}" name="old_price" type="text" class="dfinput" placeholder="请填写商品价格"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>商品现价<b>*</b></label>
                        <input id="new_price" name="new_price" type="text" class="dfinput" placeholder="请填写商品价格"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>商品库存<b>*</b></label>
                        <input id="inventory" value="{{$goods->inventory}}" name="inventory" type="text" class="dfinput" placeholder="请填写商品库存"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>商品原图片<b>*</b></label>
                        <img src="{{asset("upload/$goods->pic")}}" alt="">
                    </li>

                    <li>
                        <label>商品图片<b>*</b></label>
                        <input name="pic" type="file" class="dfinput" placeholder="请填写商品图片"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>商品详情<b>*</b></label>
                        <textarea id="content" value="{{$goods->detail}}" name="detail" style="width:700px;height:250px;"></textarea>
                    </li>

                    <li>
                        <label>商品包装信息<b>*</b></label>
                        <input name="info" type="text" value="{{$goods->info}}" class="dfinput" placeholder="请填写商品包装信息"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>所属分类<b>*</b></label>
                        <div class="vocation">
                            <select class="select1" name="cate_id" id="selectCate">
                                <option value="0">请选择分类</option>
                                @foreach($rows as $v)
                                    <option value="{{$v->id}}"
                                    @if($v->id == $goods->cate_id)
                                        selected
                                        @endif
                                    >
                                        |--{{str_repeat("--",substr_count($v->path,','))}}
                                        {{$v->cate_name}}</option>
                                @endforeach
                            </select>
                        </div>
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


