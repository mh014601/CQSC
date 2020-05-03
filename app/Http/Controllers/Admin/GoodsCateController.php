<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;

class GoodsCateController extends Controller
{
    public function goodsCateAdd(){
        $rows = DB::table('cate')->orderBy('path','asc')->get();
        $data = compact('rows');
        return view('Admin/GoodsCate/goodsCateAdd',$data);
    }
//商品分类列表
    public function goodsCateList(){
        $rows = DB::table('cate')->orderBy('path','asc')->get();
        $data = compact('rows');
        return view('Admin.GoodsCate.goodsCateList',$data);
    }

    public function goodsCateAddAction(){
        $cate_name = Input::get('cate_name');
        $id = Input::get('id');
        $row = DB::table('cate')->where('cate_name',$cate_name)->first();
        if (!$row){
            if ($id>0){
                $pid = $id;
                //父类路径
                $row = DB::table('cate')->where('id',$id)->select('path')->first();

                $path = $row->path;
                $data = compact('cate_name','pid');
                $id = DB::table('cate')->insertGetId($data);
                //自己路径

                $path = $path.",$id";
                DB::table('cate')->where('id',$id)->update(['path'=>$path]);
                return redirect(url('Admin/GoodsCate/goodsCateList'));
            }else{
                $pid = 0;
                $data = compact('cate_name','pid');
                $path = DB::table('cate')->insertGetId($data);
                DB::table('cate')->where('id',$id)->update(['path'=>$path]);
                return redirect(url('Admin/GoodsCate/goodsCateList'));
            }
        }else{
            return redirect(url('Admin/GoodsCate/goodsCateAdd'));
        }
    }

    public function goodsCateDel(){
        $id = Input::get('id');

        $arr = getSonsIdById($id);
        if (!$arr){
            $row = DB::table('goods')->where('cate_id',$id)->first();
            if (!$row){
                DB::table('cate')->where('id',$id)->delete();
                $data['status'] = 1;
            }else{
                $data['status'] = 2;
            }
        }else{
            $data['status'] = 3;
        }
        return response()->json($data);
    }
}
