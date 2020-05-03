<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Session;

class InforController extends Controller
{
    public function information()
    {
        $uid = Session::get('uid');
        if ($uid == ''){
            return redirect('Home/login');
        }
        $info = Session::get('user');
        //手机隐藏
        $phone = strpos($info, '@');
        $id = Session::get('uid');
        $rows = DB::table('users')->where('uid',$id)->first();
//        dd($rows,$id,$phone,$info);
        if (!$phone) {
            $row = DB::table('users')->where(['phone' => Session::get('user')])->first();
            $status = 2;

            $data = compact('row', 'status','rows');
            return view('Person/information', $data);
        } else {
            $row = DB::table('users')->where(['email' => Session::get('user')])->first();
            $status = 1;
            $data = compact('row', 'status','rows');
            return view('Person/information', $data);
        }
    }

//个人信息修改
    public function saveEditAction()
    {
//        dd(Input::all());
        $username = Input::get('username');
        $name = Input::get('name');
        $birthday = Input::get('test1');
        $sex = Input::get('sex');

        if (!Input::get('phone')){
            $email = Input::get('email');
            $uid = Session::get('uid');
            // 更新信息
            $row = DB::table('users')->where('uid', $uid)->update(['sex'=>$sex,'email'=>$email,'username'=>$username,'name'=>$name,'birthday'=>$birthday]);

        }else{
            $phone = Input::get('phone');
            $uid = Session::get('uid');
            // 更新信息
            $row = DB::table('users')->where('uid', $uid)->update(['sex'=>$sex,'phone'=>$phone,'username'=>$username,'name'=>$name,'birthday'=>$birthday]);

        }

        if ($row) {
            $status = "1";
        }else{
            $status =0;
        }
        return redirect('Home/Infor/information');
    }
    public function safety(){
        $uid = Session::get('uid');
        $rew = DB::table('users')->where('uid',$uid)->value('user_pic');
//        dd($rew);
        $rew = compact('rew');
        return view('Home/Infor/safety',$rew);
    }
    //检查密码
    public function ajax_checkPassword(){
        $uid = Session::get('uid');
        $password = md5(md5(Input::get('password')));
        $data = compact('password');
        $row = DB::table('users')->where('uid',$uid)->where(['password'=>$password])->first();
        if(!$row){
            //密码不正确
            $data['status'] = 1;
        }else{
            $data['status'] = 2;
        }
        return response()->json($data);

    }

    //密码修改处理
    public function safetyAction(){
        $uid = Session::get('uid');
        $password1 = md5(md5(Input::get('password1')));
        $data = compact('password1');
        $row = DB::table('users')->where('uid',$uid)->update(['password'=>$password1]);
        if($row){

            //密码修改成功
            $data['status'] = 1;
        }else{
            $data['status'] = 2;
        }
        return response()->json($data);
    }
    //上传图片
    public function uploadPic()
    {
        $uid = Session::get('uid');
//
        $url = 'upload/header/' . $uid . '.jpg';
        $bool = move_uploaded_file($_FILES['pic']['tmp_name'], $url);
        if ($bool) {
            DB::table('users')->where('uid',$uid)->update(['user_pic'=>$url]);
        } else {
            return false;
        }

    }

}
