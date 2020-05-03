<?php

namespace App\Http\Controllers\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Session;
class AddressController extends Controller
{
    //个人信息的主页路由
    public function address()
    {
        //三级联动
        $rows1 = DB::table('dt_area')->where('area_parent_id', 0)->get();
        //获取用户id
        $id = Session::get('uid');
//        $id = 1;
        $rews1 = DB::table('add_address')->where('uid', $id)->get();
        $statu = DB::table('add_address')->where('uid', $id)->where('status', 1)->get();
        if (isset($statu[0]->id)) {
            $statu = $statu[0]->id;
//         dd($statu);
        } else {
            $statu = 0;
//         dd($statu);
        }
//      $statu = $statu['id'];
//        dd($statu);
        $address1 = compact('rows1', 'rews1', 'statu');
        //默认地址的遍历显示

        return view('Person.address', $address1);
    }

    //ajax 地址三级联动的路由
    public function address1()
    {

        $id = Input::get('id');
        $rows = DB::table('dt_area')->where('area_parent_id', $id)->get()->toArray();


        return response()->json($rows);
    }

    //添加个人地址信息的路由
    public function addaddre()
    {
        $user = Input::get('user');            //收货人性姓名
        $phone = Input::get('phone');          //收货人手机号
        $pro = Input::get('pro');      //收货人地址三级联动
        $cit = Input::get('cit');      //收货人地址三级联动
        $are = Input::get('are');      //收货人地址三级联动
        $info = Input::get('info');            //收货人详细地址
        $aid = Input::get('aid');            //地址表主键id

     $uid = Session::get('uid');              //用户id
//        $uid = 1;
        if ($aid == 'a') {
            $row = DB::table('add_address')->insertGetId([
                'username' => $user,
                'address' => $info,
                'phone' => $phone,
                'uid' => $uid,
                'pro' => $pro,
                'cit' => $cit,
                'are' => $are
            ]);
            if ($row) {
                $data['mess'] = '新增地址成功';
            } else {
                $data['statu'] = '新增地址失败,请再试一遍';
            }
        } else {
            $row = DB::table('add_address')->where('id', $aid)->update([
                'username' => $user,
                'address' => $info,
                'phone' => $phone,
                'uid' => $uid,
                'pro' => $pro,
                'cit' => $cit,
                'are' => $are
            ]);
            if ($row) {
                $data['mess'] = '修改地址成功';
            } else {
                $data['mess'] = '修改地址失败,请再试一遍';
            }
        }

        return response()->json($data);
    }

    //删除地址的ajax控制器
    public function clearAddre()
    {
        $id = input::get('id');
        if (isset($id) && $id != 0) {
            $bool = DB::table('add_address')->where('id', $id)->delete();
            if ($bool) {
                $dat['mess'] = "删除成功";
            } else {
                $dat['mess'] = "删除失败";
            }
        }
        return response()->json($dat);
    }

    //ajax设置默认的控制器
    public function setdefa()
    {
        //获取地址表的id
        $id = Input::get('adid');
        $uid = Session::get('uid');   //获取用户id
        //先查该用户有没有设置默认地址
//        $statu = DB::table('add_address')->where('status', 1)->where('uid', $id)->get();
        $statu = DB::select('select * from add_address where uid = '.$uid.' and status = 1');

        if (isset($statu[0]->id)) {
//            $statu = $statu[0]->id;
            DB::table('add_address')->where('uid',$uid)->update(['status'=>0]);

        }
            $bool = DB::table('add_address')->where('id',$id)->update(['status'=>1]);
        if ($bool){
            $data['mess1'] = '更新默认地址成功';
        }else{
            $data['mess1'] = '更新默认地址失败';
        }
        return response()->json($data);
    }
}