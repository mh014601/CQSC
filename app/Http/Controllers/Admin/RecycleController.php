<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;

class RecycleController extends Controller
{
    public function goodsRecycle(){
        $paginate = 4;
        $cateList = DB::table('cate')->orderBy('path','asc')->get();

        //1.进网页 没点查询
        //2.点查询 (综合查询有值  分类查询有值   都有值   都没值)
        //没点查询和点查询都没值可以放在一起
        $keyword = Input::get('keyword');
        $search = Input::get('search');
        $cate_id = Input::get('cate_id');
        if ($search && ($keyword || $cate_id)){
            //综合查询有值 分类查询没值
            if ($keyword && !$cate_id){
                $rows = DB::table('goods')
                    ->select("goods.id as gid","good_name","old_price","inventory","info","total_sale",
                        "month_sale","new_price","pic","detail","cate.cate_name","goods.add_time")
                    ->leftJoin('cate','cate.id','=','goods.cate_id')
                    ->where('good_name','like',"%$keyword%")
                    ->where('is_del',1)
                    ->orderBy('add_time','desc')
                    ->paginate($paginate);
            }elseif ($cate_id && !$keyword){
                //分类查询有值   综合查询没值
                $id_arr = getSonsIdById($cate_id);
                array_unshift($id_arr,$cate_id);
                $rows = DB::table('goods')
                    ->select("goods.id as gid","good_name","old_price","inventory","info","total_sale",
                        "month_sale","new_price","pic","detail","cate.cate_name","goods.add_time")
                    ->leftJoin('cate','cate.id','=','goods.cate_id')
                    ->whereIn('cate_id',$id_arr)
                    ->where('is_del',1)
                    ->orderBy('add_time','desc')
                    ->paginate($paginate);
            }else{
                //都有值
                $id_arr = getSonsIdById($cate_id);
                array_unshift($id_arr,$cate_id);
                $rows = DB::table('goods')
                    ->select("goods.id as gid","good_name","old_price","inventory","info","total_sale",
                        "month_sale","new_price","pic","detail","cate.cate_name","goods.add_time")
                    ->leftJoin('cate','cate.id','=','goods.cate_id')
                    ->where('good_name','like',"%$keyword%")
                    ->where('cate_id',$id_arr)
                    ->where('is_del',1)
                    ->orderBy('add_time','desc')
                    ->paginate($paginate);
            }
        }else{
            $rows = DB::table('goods')
                ->select("goods.id as gid","good_name","old_price","inventory","info","total_sale",
                    "month_sale","new_price","pic","detail","cate.cate_name","goods.add_time")
                ->leftJoin('cate','cate.id','=','goods.cate_id')
                ->where('is_del',1)
                ->orderBy('add_time','desc')
                ->paginate($paginate);
        }

        $data = compact('rows','cateList','keyword','search','cate_id');
        return view('Admin.Recycle.goodsRecycle',$data);
    }

    public function goodsReduction($id){
        if ($id){
            DB::table('goods')->where('id',$id)->update(['is_del'=>0]);
            return redirect(url('Admin/Recycle/goodsRecycle'));
        }
    }

    public function goodsRecycleDel(){
        $id = Input::get('id');
        if($id){
            $row = DB::table('goods')->where('id',$id)->delete();
            if ($row){
                $data['status'] = 1;
            }else{
                $data['status'] = 2;
            }
            return response()->json($data);
        }

    }
}
