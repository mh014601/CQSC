<?php


use function foo\func;
//商品分类
function getSonsIdById($id){
    //静态 防止初始化
    static $arr = [];
    //通过自身id查询是否还有孩子
    $rows = DB::table('cate')->where('pid',$id)->get();
    if ($rows){
        foreach ($rows as $v){
            $id = $v->id;
            $arr[] = $id;
            getSonsIdById($id);
        }
    }
    return $arr;
}
//权限分类
function getSonsIdById1($id){
    //静态 防止初始化
    static $arr = [];
    //通过自身id查询是否还有孩子
    $rows = DB::table('auth')->where('pid',$id)->get();
    if ($rows){
        foreach ($rows as $v){
            $id = $v->id;
            $arr[] = $id;
            getSonsIdById($id);
        }
    }
    return $arr;
}

function getFilename($request){//获得原来文件名
    $old_name = $request->file('pic')->getClientOriginalName();
    //获得文件后缀名
    $ext = $request->file('pic')->getClientOriginalExtension();
    //组成新的文件名
    $filename = $old_name.time().mt_rand(100000,999999).'.'.$ext;


    $bool = $request->file('pic')->move("./upload/",$filename);
    if ($bool){
        return $filename;
    }else{
        return false;
    }

}
//无限极分类
function getTree($arr,$id='id'){
    //定义一个空数组
    $tree = array();
    //遍历传过来的数组
    foreach ($arr as $v){
        //是否存在pid
        if (isset($arr[$v->pid])){
            //&按引用传递  son后面加个空数组是追加  不加的话就会覆盖
            $arr[$v->pid]->son[] = &$arr[$v->$id];
        }else{
            $tree[] = &$arr[$v->$id];
        }
    }
    return $tree;
}

//处理数组  把数组id变成数组的键

function idChangeKey($arr,$id='id'){
    //定义一个空数组
    $temp = [];
    foreach ($arr as $k=>$v){
        $temp[$v->$id] = $v;
    }
    return $temp;
}