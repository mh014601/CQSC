<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use Session;
use Gregwar\Captcha\CaptchaBuilder;


class IndexController extends Controller
{
    //主页面
    public function index(){
        return view('Admin.Index.index');
    }
    public function top(){
        $flag = Session::get('flag');
        $row = DB::table('admin')->where('flag',$flag)->first();
        return view('Admin.Index.top',['row'=>$row]);
    }
    public function left(){
        $flag = Session::get('flag');
        $id = DB::table('admin')->where('flag',$flag)->first()->id;
        $rows = DB::table('admin as ad')
            ->join('admin_role as ar','ad.id','=','ar.admin_id')
            ->join('role as r','ar.role_id','=','r.id')
            ->join('role_auth as ra','r.id','=','ra.role_id')
            ->join('auth as a','ra.auth_id','=','a.id')
            ->select('ad.id','ad_name','r.role_name','a.auth_name','a.route','a.level','a.id as aid','a.pid')
            ->where('ad.id',$id)
            ->get()->toArray();
        $rows = getTree(idChangeKey($rows,'aid'),'aid');

        $data = compact('rows');
        return view('Admin.Index.left',$data);
    }
    public function main(){
        $flag = Session::get('flag');
        $row = DB::table('admin')->where('flag',$flag)->first();
        $ad_name = $row->ad_name;
        $last_time = DB::table('admin')->where('ad_name',$ad_name)->value('last_time');
        return view('Admin.Index.main',['row'=>$row,'last_time'=>$last_time]);
    }
    public function footer(){
        return view('Admin.Index.footer');
    }
//登录验证码
    public function verify(){
        $builder = new CaptchaBuilder;
        $builder->build(114,46);

        header('Content-type: image/jpeg');
        $builder->output();
        Session::put('phrase',$builder->getPhrase());
    }
    public function login(){
        return view('Admin.Index.login');
    }
    //登录处理程序(查数据库,存session)
    public function loginAction(){
        $ad_name = Input::get('ad_name');
        $ad_pass = md5(Input::get('ad_pass'));
        $status = '1';
        $where = compact('ad_name','ad_pass','status');
//        DB::connection()->enableQueryLog();#开启执行日志
        $row = DB::table('admin')->where($where)->first();
//        print_r(DB::getQueryLog());   //获取查询语句、参数和执行时间

        if ($row){
            $flag = $row->flag;
            Session::put('flag',$flag);
            $login_time = time();

            $last_time = DB::table('admin')->where('ad_name',$ad_name)->value('login_time');
            DB::table('admin')->where('ad_name',$ad_name)->update(['last_time'=>$last_time]);
            DB::table('admin')->where('ad_name',$ad_name)->update(['login_time'=>$login_time]);
            return redirect(url('Admin/Index/index'));
        }else{
            return redirect(url('Admin/Index/login'));
        }
    }
    //登出
    public function loginOut(){
        Session::forget('flag');
        return redirect(url('Admin/Index/login'));
    }
//ajax处理验证码
    public function ajaxCaptcha(){
        $phrase = Session::get('phrase');
        $captcha = Input::get('captcha');
        if ($phrase == $captcha){
            $data['status'] = 1;
        }else{
            $data['status'] = 2;
        }
        return response()->json($data);
    }

    public function findWord(){
        return view('Admin.Index.findWord');
    }
}
