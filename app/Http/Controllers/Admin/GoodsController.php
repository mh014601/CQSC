<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;

class GoodsController extends Controller
{
    public function goodsAdd(){
        $rows = DB::table('cate')->orderBy('path','asc')->get();

        $data = compact("rows");
        return view("Admin.Goods.goodsAdd",$data);
    }
    public function goodsList(){
        $paginate = 10;
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
                    ->orderBy('add_time','desc')
                    ->paginate($paginate);
            }
        }else{
            $rows = DB::table('goods')
                ->select("goods.id as gid","good_name","old_price","inventory","info","total_sale",
                    "month_sale","new_price","pic","detail","cate.cate_name","goods.add_time")
                ->leftJoin('cate','cate.id','=','goods.cate_id')
                ->orderBy('add_time','desc')
                ->paginate($paginate);
        }

        $data = compact('rows','cateList','keyword','search','cate_id');
        return view('Admin.Goods.goodsList',$data);
    }
    public function goodsAddAction(Request $request){

            $filename = getFilename($request);

            if (!$filename){
                return redirect(url('Admin/Goods/goodsAdd'));
            }

            $cate_id = Input::get('cate_id');
            if ($cate_id){
                $data = Input::all();
                unset($data['_token']);
                $data['add_time'] = time();
                $data['pic'] = $filename;
                $id = DB::table('goods')->insertGetId($data);

                if ($id){
                    return redirect(url('Admin/Goods/goodsList'));
                }else{
                    unlink('./upload/'.$filename);
                }
            }else{
                //不能添加

            }
    }

    public function goodsDel(){
        $id = Input::get('id');
        $row = DB::table('goods')->where('id',$id)->update(['is_del'=>1]);
        if ($row){
            $data['status'] = 1;
        }else{
            $data['status'] = 2;
        }
        return response()->json($data);
    }

    public function goodsEdit($id){
        $rows = DB::table('cate')->orderBy('path','asc')->get();
        $goods = DB::table('goods')->where('id',$id)->first();
        $data = compact('rows','goods');
        return view('Admin/Goods/goodsEdit',$data);
    }

    public function goodsEditAction(Request $request){
        $id = Input::get('id');
        $info = Input::all();

        unset($info['_token']);
        if ($request->hasFile('pic')){
            //1.生成新图片
                $filename = getFilename($request);
                if ($filename){
                    $info['pic'] = $filename;
                    $goods = DB::table('goods')->find($id);
                    $pic = $goods->pic;
                    //2.删除老图片
                    if (!empty($pic)){
                        if (file_exists('upload/'.$pic)){
                            unlink('upload/'.$pic);
                        }
                    }

                    //删除图片对应的附图  此图对应图片表的记录

                    //修改数据库的路径
                    DB::table('goods')->where('id',$id)->update($info);
                }else{
                    //生成新图片失败
                    return redirect(url('Admin/Goods/goodsEdit',[$id]));
                }
        }else{
            //没有新图片 也要修改数据库
            DB::table('goods')->where('id',$id)->update($info);
        }
        return redirect(url('Admin/Goods/goodsList'));
    }

}
