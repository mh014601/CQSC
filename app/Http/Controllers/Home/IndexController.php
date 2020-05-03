<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class Indexcontroller extends Controller
{
    //主页
   public function index(){
    //商品主页分类标签的遍历
       $rows =  DB::table('cate')->where('pid',0)->get()->toArray();
    //下级分类遍历
    foreach($rows as $m){
           $mem["$m->cate_name"] =  DB::table('cate')->where('pid',"$m->id")->get()->toArray();
                //遍历出来每一个类型
            foreach($mem["$m->cate_name"] as $b) {
                //每个分类下的具体类型
              $las["$b->cate_name"] = DB::table('cate')->where('pid',"$b->id")->get()->toArray();
//              dd($las["$b->fname"]);
            }
    }
    //将结果拼到一个数组里面
       //查询数据库里面的所有商品的id和分类id
    $rows = ['rows'=>$rows,'mem'=>$mem,'las'=>$las];
    //返回到模板
            return view('Home/index',$rows);
   }
}
