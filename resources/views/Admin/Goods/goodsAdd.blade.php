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
        <li><a href="#">添加商品</a></li>
    </ul>
</div>

<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="{{url('Admin/Goods/goodsAddAction')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
            <ul class="forminfo">
                <li>
                    <label>商品名称<b>*</b></label>
                    <input id="good_name" name="good_name" type="text" class="dfinput" placeholder="请填写商品名称"  style="width:518px;"/>
                </li>

                <li>
                    <label>商品价格<b>*</b></label>
                    <input id="new_price" name="new_price" type="text" class="dfinput" placeholder="请填写商品价格"  style="width:518px;"/>
                </li>

                <li>
                    <label>商品库存<b>*</b></label>
                    <input id="inventory" name="inventory" type="text" class="dfinput" placeholder="请填写商品库存"  style="width:518px;"/>
                </li>

                <li>
                    <label>商品图片<b>*</b></label>
                    <input name="pic" type="file" class="dfinput" placeholder="请填写商品图片"  style="width:518px;"/>
                </li>

                <li>
                    <label>商品详情<b>*</b></label>
                    <textarea id="content" name="detail" style="width:700px;height:250px;"></textarea>
                </li>

                <li>
                    <label>商品包装信息<b>*</b></label>
                    <input name="info" type="text" class="dfinput" placeholder="请填写商品包装信息"  style="width:518px;"/>
                </li>

                <li>
                    <label>所属分类<b>*</b></label>
                    <div class="vocation">
                        <select class="select1" name="cate_id" id="selectCate">
                            <option value="0">请选择分类</option>
                            @foreach($rows as $v)
                                <option value="{{$v->id}}"> |--{{str_repeat("--",substr_count($v->path,','))}}
                                    {{$v->cate_name}}</option>
                                @endforeach
                        </select>
                    </div>
                </li>

                <li>
                    <label>&nbsp;</label>
                    <input name="" id="sub" type="submit" class="btn" value="添加"/>
                </li>
            </ul>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    $('#sub').attr('disabled','disabled').css({'cursor':'not-allowed','background':'#999'})
    // $('#good_name').blur(function () {
    //     window.good_name = $('#good_name').val();
    //     console.log(good_name)
    // })
    // $('#new_price').blur(function () {
    //     window.good_price = $('#new_price').val();
    //     console.log(good_price)
    // })
    // $('#inventory').blur(function () {
    //     window.good_inventory = $('#inventory').val();
    //     console.log(good_inventory)
    // })
    $('#selectCate').change(function () {
        var good_name = $('#good_name').val();
        var good_price = $('#new_price').val();
        var good_inventory = $('#inventory').val();
            if ($(this).val() > 0 && good_name && good_price && good_inventory){
                $('#sub').removeAttr('disabled').css({'cursor':'pointer','background':'blue'});
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

