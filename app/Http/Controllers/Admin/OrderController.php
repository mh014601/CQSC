<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;

class OrderController extends Controller
{
    public function orderList(){
        $keyword = Input::get('keyword');
        $search = Input::get('search');

        if($search && $keyword){
            $rows = DB::table('order as o')
                ->leftjoin('users as u','o.uid','=','u.uid')
                ->leftjoin('goods as g','g.id','=','o.pid')
                ->leftjoin('add_address as ad','ad.id','=','o.add_id')
                ->where('name','like',"%$keyword%")
                ->paginate(1);
        }else{
            $rows = DB::table('order as o')
                ->leftjoin('users as u','o.uid','=','u.uid')
                ->leftjoin('goods as g','g.id','=','o.pid')
                ->leftjoin('add_address as ad','ad.id','=','o.add_id')
                ->select('o.id','o.order_id','u.name','g.good_name','o.pnum','ad.address','o.status','o.pay_type','o.express_type','o.time')
                ->paginate(1);
        }



        $data = compact('rows','keyword','search');

        return view('Admin/Order/orderList',$data);
    }

    public function orderEdit($id){
        $row = DB::table('order as o')
            ->leftjoin('users as u','o.uid','=','u.uid')
            ->leftjoin('goods as g','g.id','=','o.pid')
            ->leftjoin('add_address as ad','ad.id','=','o.add_id')
            ->select('o.id','o.order_id','u.name','g.good_name','o.pnum','ad.address','o.status','o.pay_type','o.express_type','o.time')
            ->where('o.id',$id)
            ->first();
        $data = compact('row','id');
        return view('Admin.Order.orderEdit',$data);
    }

    public function orderEditAction(){
        $id = Input::get('id');

        $row = DB::table('order as o')
            ->leftjoin('users as u','o.uid','=','u.uid')
            ->leftjoin('goods as g','g.id','=','o.pid')
            ->leftjoin('add_address as ad','ad.id','=','o.add_id')
            ->select('o.id','o.order_id','u.name','g.good_name','o.pnum','ad.address','o.status','o.pay_type','o.express_type','o.time')
            ->where('o.id',$id)
            ->first();

        if ($row){
            $data['ad.address'] = Input::get('address');
            $data['o.express_type'] = Input::get('express_type');
            DB::table('order as o')
                ->leftjoin('users as u','o.uid','=','u.uid')
                ->leftjoin('goods as g','g.id','=','o.pid')
                ->leftjoin('add_address as ad','ad.id','=','o.add_id')
                ->where('o.id',$id)
                ->update($data);
            return redirect(url('Admin/Order/orderList'));
        }else{
            return redirect(url('Admin/Order/orderEdit',[$id]));
        }
    }
}
