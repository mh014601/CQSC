<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;

class RoleController extends Controller
{
    //角色列表
    public function roleList(){
        $roles = DB::table('role')->paginate(5);
        $data = compact('roles');
        return view('Admin/Role/roleList',$data);
    }
//分配权限页面
    public function assignAuth(){
        $id = Input::get('id');
        $role = DB::table('role')->find($id);
        $my_rows = DB::table('role as r')
            ->leftJoin('role_auth as ra','r.id','=','ra.role_id')
            ->leftJoin('auth as a','ra.auth_id','=','a.id')
            ->select('r.id','r.role_name','a.auth_name','a.route','a.level','a.pid','a.id as aid')
            ->where('r.id',$id)
            ->get()
            ->toArray();
        $rows = DB::table('auth as a')
            ->leftJoin('role_auth as ra','a.id','=','ra.role_id')
            ->leftJoin('role as r','ra.auth_id','=','r.id')
            ->select('r.id','r.role_name','a.auth_name','a.route','a.level','a.pid','a.id as aid')
            ->get()
            ->toArray();
        $my_rows = idChangeKey($my_rows,'aid');

        $rows = idChangeKey($rows,'aid');

        foreach ($rows as $k=>$v){
            if (array_key_exists($k,$my_rows)){
                $rows[$k]->issel  =1;
            }else{
                $rows[$k]->issel  =0;
            }
        }

        $rows = getTree($rows,'aid');

        $data = compact('role','rows','id');
        return view('Admin/Role/assignAuth',$data);
    }
//分配权限处理
    public function assignAuthAction(){
        $role_id = Input::get('role_id');
        if (isset($role_id)){

            $auth_ids = Input::get('auth_id');
            DB::table('role_auth')->where('role_id',$role_id)->delete();
            foreach ($auth_ids as $v){
                $data[] = ['role_id'=>$role_id,'auth_id'=>$v];
            }
            DB::table('role_auth')->insert($data);
            return redirect(url('Admin/Role/roleList'));
        }

    }

    //角色增加
    public function roleAdd(){
        $rows = DB::table('auth as a')
            ->leftJoin('role_auth as ra','a.id','=','ra.role_id')
            ->leftJoin('role as r','ra.auth_id','=','r.id')
            ->select('r.id','r.role_name','a.auth_name','a.route','a.level','a.pid','a.id as aid')
            ->get()
            ->toArray();
        $rows = idChangeKey($rows,'aid');
        $rows = getTree($rows,'aid');
        $data = compact('rows');
        return view('Admin/Role/roleAdd',$data);
    }

    //角色增加处理
    public function roleAddAction(){
        $role_name = Input::get('role_name');
        $row = DB::table('role')->where('role_name',$role_name)->first();
        if (!$row){
            $id = DB::table('role')->insertGetId(['role_name'=>$role_name]);
            if ($id){
                $auth_ids = Input::get('auth_id');
                foreach ($auth_ids as $v){
                    $data[] = ['role_id'=>$id,'auth_id'=>$v];
                }
                DB::table('role_auth')->insert($data);
                return redirect(url('Admin/Role/roleList'));
            }
        }
return redirect(url('Admin/Role/roleAdd'));
    }

    public function ajaxRoleDel(){

        $id = Input::get('id');
        $row = DB::table('role')->where('id',$id)->first();
        if ($row){
            DB::table('role')->where('id',$id)->delete();
            DB::table('role_auth')->where('role_id',$id)->delete();
            $data['status'] = 1;
        }else{
            $data['status'] = 2;
        }
        return response()->json($data);
    }

    public function ajaxRoleName(){
        $roleName = Input::get('roleName');

        $row = DB::table('role')->where('role_name',$roleName)->first();

        if ($row){
            $data['status'] = 1;
        }else{
            $data['status'] = 2;
        }
        return response()->json($data);
    }
}
