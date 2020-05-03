<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
use Session;

class LoginController extends Controller

{
    //登录  跳转登录页面
    public function login()
    {
        Session::forget('uid');
        Session::forget('user');
        return view('Home.login');
    }

    //跳转注册页面
    public function register()
    {
        return view('Home.register');
    }

    //登陆处理页面
    public function procLogin(Request $request)
    {
        $user = $request->get('user');
        $upass = md5($request->get('upass'));
        $sss = $request->get('hidd');
        $rows = DB::table('users')->where($sss, $user)->where('password', $upass)->first();
//      dd($rows);
        if (!empty($rows)) {
            //登陆成功  跳转到首页
            Session::put('uid',$rows->uid);
            Session::put('user',$user);
//            dd(session()->get('uid'));
            return redirect('/');
        } else {
            //登录失败  跳转到登录页面
            return redirect('Home/login');

        }
    }

    //注册手机发验证码处理页面

    public function reg(Request $request)
    {
        //获取前台的手机号
        $phone1  = $request->get('phone');


        header('content-type:text/html;charset=utf-8');

        $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
        //需要发送的验证码
        $math = mt_rand(100000, 999999);

        $smsConf = array(
            'key' => '45a1cab7d9b965d81a9fd2a675002b95', //您申请的APPKEY
            'mobile' => $phone1, //接受短信的用户手机号码
            'tpl_id' => '192601', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' => "#code#=" . $math . "&#company#=聚合数据" //您设置的模板变量，根据实际情况修改
        );

        $content =  self::juhecurl($sendUrl,$smsConf,1); //请求发送短信

        if ($content) {
            $result = json_decode($content, true);
            $error_code = $result['error_code'];
            if ($error_code == 0) {

                //短信发送成功的时候将验证码存入session
                session()->put($phone1,$math);
                $data['statu'] = "0";
                $data['mess'] = "短信发送成功";


            } else {
                $data['mess'] = "短信发送失败";
                $data['statu'] = "1";
            }
        } else {

            $data['mess'] = "短信发送失败";
        }
        return response()->json($data);
    }

    //手机号发短信接口
    public static function juhecurl($url,$params=false,$ispost=0)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }


    //验证验证码的正确性
    public function checkVerify(Request $request){
        //获取前台传过来的值
        $verify = $request->get('verify');
        $phone2 = $request->get('phone2');
        $verify1 = Session::get($phone2);
        if ($verify == $verify1) {
            $data1['mess1'] = "验证码正确";
        }else{
            $data1['mess1'] = "验证码不正确";
        }
        return response()->json($data1);
    }

    //验证手机号是否已存在
    public function checkphone(Request $request){
        $phone = $request->get('phone');
//        $phone = 17803909058;
       $mable =  DB::table('users')->where('phone',$phone)->first();
        if($mable){
            $data['messphone'] = "该手机号已存在";
        }else{
            $data['messphone'] = "该手机号可用";

        }
        return response()->json($data);

    }

    //ajax处理注册到数据库中
    public function regphone(Request $request){
        $ph = $request->get('phone3');
        $pass3 = $request->get('pass3');
        $pass4 = md5(md5($pass3));
        $row = DB::table('users')->insert(['phone'=>$ph,'password'=>$pass4]);
        if ($row){
            $data['mess'] = '用户注册成功';
        }else{
            $data['mess'] = '用户注册失败';
        }
        return response()->json($data);

    }







}


