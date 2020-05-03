<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>三级联动</title>
    <script src="{{asset('AmazeUI-2.4.2/assets/js/jquery.min.js')}}" type="text/javascript"></script>
</head>
<body>
<div>
    <div class="col-md-2">
        <select class="form-control" id="s1" name="one">
            <option value="">请选择所在省</option>
            @foreach(..\App\Lib\Position::getPositionType() as $k=>$v)
            <option value="{{$k}}">{{$v}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <select class="form-control" name="two" id="s2">
            <option value="">请选择所在城市</option>
            @foreach($positionType as $v)
            @if($v->pid == 0)
            <option class="s2_type s1_{{$v->tid}}" value="{{$v->id}}">{{$v->name}}</option>
            @endif
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <select class="form-control" name="type_id" id="s3">
            <option value="">请选择所在区域</option>
            @foreach($positionType as $v)
            @if($v->pid > 0)
            <option class="s3_type s2_{{$v->pid}}" value="{{$v->id}}">{{$v->name}}</option>
            @endif
            @endforeach
        </select>
    </div>
</div>


<script>

//三级联动
$("#s1").change(function(){

$(".s2_type").hide();
$(".s3_type").hide();
var id = $(this).val();
$(".s1_"+id).show();
console.log(".s1_"+id)
});

$("#s2").change(function(){
$(".s3_type").hide();
var id = $(this).val();
$(".s2_"+id).show();
console.log(id)
});
</script>
</body>
</html>