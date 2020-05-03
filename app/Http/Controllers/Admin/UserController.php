<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;

class UserController extends Controller
{
    public function userList(){
        $keyword = Input::get('keyword');
        $search = Input::get('search');
        if ($search){
            $rows = DB::table('users')->where('name','like',"%$keyword%")->orderBy('add_time','desc')->paginate(2);
        }else{
            $rows = DB::table('users')->orderBy('add_time','desc')->paginate(2);
        }

        $data = compact('rows','keyword','search');
        return view('Admin/User/userList',$data);
    }

    public function userEdit($id){
        $row = DB::table('users')->where('id',$id)->first();
        $data = compact('row');
        return view('Admin/User/userEdit',$data);
    }

    public function userEditAction($id){
        $all = Input::all();
        unset($all['_token']);
        DB::table('users')->where('id',$id)->update($all);
        return redirect(url('Admin/User/userList'));
    }


    public function userDel(){
        $id = Input::get('id');
        if ($id){
            $row = DB::table('users')->where('id',$id)->delete();
            if ($row){
                $data['status'] = 1;
            }else{
                $data['status'] = 2;
            }

        }else{
            $data['status'] = 3;
        }

        return response()->json($data);
    }

    public function userAdd(){
        return view('Admin.User.userAdd');
    }

    public function userAddAction(){
            $username = Input::get('username');
            $password = md5(Input::get('password'));
            $row = DB::table('users')->where('username',$username)->first();
            if (!$row){
                $all = Input::all();
                unset($all['_token']);
                unset($all['password']);
                $all['add_time'] = time();
                $all['password'] = $password;
                $id = DB::table('users')->insertGetId($all);
                if ($id){
                    return redirect(url('Admin/User/userList'));
                }else{
                    return redirect(url('Admin/User/userAdd'));
                }
            }else{
                return redirect(url('Admin/User/userAdd'));
            }
    }
}
