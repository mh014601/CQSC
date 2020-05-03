<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;

class AuthController extends Controller
{
    //权限列表
    public function authList(){
        $authList = getTree(idChangeKey(DB::table('auth')->get()));
        $data = compact('authList');
        return view('Admin/Auth/authList',$data);
    }
//权限增加
    public function authAdd(){
        //读取一级权限
        $rows = DB::table('auth')->where('pid',0)->get();
        $data = compact('rows');
        return view('Admin/Auth/authAdd',$data);
    }
//权限增加处理
    public function authAddAction(){
        $pid = Input::get('pid');
        $auth_name = Input::get('auth_name');

        $row = DB::table('auth')->where('auth_name',$auth_name)->first();
        if (!$row){
            if ($pid){
                $route = Input::get('route');
                $data['route'] = $route;
                $data['level'] = 2;
            }else{
                $data['level'] = 1;
            }
            $data['auth_name'] = $auth_name;
            $data['pid'] = $pid;
            $id = DB::table('auth')->insertGetId($data);
            if ($id){
                return redirect(url('Admin/Auth/authList'));
            }
        }else{
            return redirect(url('Admin/Auth/authAdd'));
        }
    }
    public function ajaxAuthName(){
        $authName = Input::get('authName');

        $row = DB::table('auth')->where('auth_name',$authName)->first();

        if ($row){
            $data['status'] = 1;
        }else{
            $data['status'] = 2;
        }
        return response()->json($data);
    }

    public function ajaxAuthDel(){

        $id = Input::get('id');
        $arr = getSonsIdById1($id);
        if (!$arr){
            $row = DB::table('auth')->where('id',$id)->first();
            if ($row){
                DB::table('auth')->where('id',$id)->delete();
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
