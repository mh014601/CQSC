<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use Session;
class ManagerController extends Controller
{
    //添加管理员
    public function managerAdd(){
        $roles = DB::table('role')->get();
        $date = compact('roles');
        return view('Admin.Manager.managerAdd',$date);
    }
    //管理员列表  查询管理员
    public function managerList(){

        $keyword = Input::get('keyword');
        $row = DB::table('admin')->where('flag',Session::get('flag'))->first();
        if (!$keyword){
            $rows = DB::table('admin as a')
                ->leftJoin('admin_role as ar','a.id','=','ar.admin_id')
                ->leftJoin('role as r','r.id','=','ar.role_id')
                ->select('a.id','a.ad_name','a.add_time','a.status','r.role_name')
                ->orderBy('add_time','desc')
                ->paginate(2);
        }else{
//            DB::connection()->enableQueryLog();#开启执行日志
            $rows = DB::table('admin as a')
                ->leftJoin('admin_role as ar','a.id','=','ar.admin_id')
                ->leftJoin('role as r','r.id','=','ar.role_id')
                ->where('ad_name','like',"%$keyword%")
                ->orderBy('add_time','desc')
                ->paginate(2);

//            print_r(DB::getQueryLog());   //获取查询语句、参数和执行时间
        }
        $roles = DB::table('role')->get();
        $data = compact('keyword','rows','row','roles');
        return view('Admin.Manager.managerList',$data);
    }
    //添加管理员处理
    public function managerAddAction(){
        $ad_name = Input::get('ad_name');
        $ad_pass = md5(Input::get('ad_pass'));
        $role_id = Input::get('role_id');
        $add_time = time();
        $status = Input::get('status');
        $flag = md5($ad_name.'$ad_pass');


        $row = DB::table('admin')->where(['ad_name'=>$ad_name])->first();
        if (!$row){
            $data = compact('ad_name','ad_pass','add_time','status','flag');
            $id = DB::table('admin')->insertGetId($data);
            if ($id){
                DB::table('admin_role')->insertGetId(['admin_id'=>$id,'role_id'=>$role_id]);
                return redirect(url('Admin/Manager/managerList'));
            }
        }else{
            return redirect(url('Admin/Manager/managerAdd'));
        }

    }
//管理员删除
    public function managerDel(){
        $id = Input::get('id');
        if (isset($id) && $id>0){
            DB::table('admin')->where('id',$id)->delete();
//            return redirect(url('Admin/Manager/managerList'));
            $data['status'] = 1;
        }
        return response()->json($data);
    }
    //管理员编辑
    public function managerEdit($id){

        $row = DB::table('admin')->where('id',$id)->first();
        $roles = DB::table('role')->get();
        $data = compact('row','roles','id');
        return view('Admin.Manager.managerEdit',$data);
    }
//管理员编辑处理
    public function managerEditAction(){
        $id = Input::get('id');
        $role_id = Input::get('role_id');
        $ad_name = Input::get('ad_name');
        $status = Input::get('status');

        //通过id来排除自己
        $row = DB::table('admin')->where('ad_name',$ad_name)->first();

        if ($row){

            return redirect(url('Admin/Manager/managerEdit',$id));
        }else{
            $data['ad_name'] = $ad_name;
            $data['status'] = $status;
            DB::table('admin')->where('id',$id)->update($data);
            DB::table('admin_role')->where('admin_id',$id)->update(['role_id'=>$role_id]);
            return redirect(url('Admin/Manager/managerList'));
        }
    }

    public function ajaxManagerName(){
        $ad_name = Input::get('ad_name');
        $id = Input::get('aid');
        //通过id来排除自己
        $row = DB::table('admin')->where('ad_name',$ad_name)->first();
        if ($row){
            //通过id来排除自己
            $da = DB::table('admin')->where('ad_name',$ad_name)->where('id','!=',$id)->first();
            if ($da){
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
