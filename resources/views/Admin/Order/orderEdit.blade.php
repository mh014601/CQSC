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
            <form action="{{url('Admin/Order/orderEditAction')}}?id={{$row->id}}" method="post" >
                {{csrf_field()}}
                <ul class="forminfo">
                    <li>
                        <label>订单号<b>*</b></label>
                        <input id="order_id" disabled="disabled" value="{{$row->order_id}}" name="order_id" type="text" class="dfinput" placeholder="请填写商品名称"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>用户<b>*</b></label>
                        <input id="name_a" disabled="disabled" value="{{$row->name}}" name="name_a" type="text" class="dfinput" placeholder="请填写商品价格"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>商品名字<b>*</b></label>
                        <input id="good_name" disabled="disabled" name="good_name" value="{{$row->good_name}}" type="text" class="dfinput" placeholder="请填写商品价格"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>商品数量<b>*</b></label>
                        <input id="pnum" disabled="disabled" value="{{$row->pnum}}" name="pnum" type="text" class="dfinput" placeholder="请填写商品库存"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>送货地址<b>*</b></label>
                        <input id="address" value="{{$row->address}}" name="address" type="text" class="dfinput" placeholder="请填写商品库存"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>状态<b>*</b></label>
                        <label for="open"></label>已支付: <input disabled="disabled" @if($row->status == 0)
                                                             checked="checked"
                                                             @endif name="status" id="open" type="radio" value="0" />
                        <label for="down"></label>未支付: <input name="status" disabled="disabled" @if($row->status == 1)
                        checked="checked"
                                                             @endif id="down" type="radio" value="1" />
                    </li>

                    <li>
                        <label>支付方式<b>*</b></label>
                        <input name="pay_type" disabled="disabled" type="text" value="{{$row->pay_type}}" class="dfinput" placeholder="请填写商品包装信息"  style="width:518px;"/>
                    </li>

                    <li>
                        <label>快递方式<b>*</b></label>
                        <input name="express_type" type="text" value="{{$row->express_type}}" class="dfinput" placeholder="请填写商品包装信息"  style="width:518px;"/>
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



