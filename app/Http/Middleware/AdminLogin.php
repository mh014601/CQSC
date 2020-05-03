<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use DB;
use Input;


class adminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allow_list = ['Admin/Index/login','Admin/Index/loginAction','Admin/Index/ajaxCaptcha','Admin/Index/verify','Admin/Index/findWord'];
        if (!in_array($request->route()->uri(),$allow_list)){
            if (!Session::get('flag')){
                return redirect('Admin/Index/login');
            }else{
                $flag = Session::get('flag');
                $id = DB::table('admin')->where('flag',$flag)->first()->id;
                if($id>1){
                    $rows = DB::table('admin as ad')
                        ->join('admin_role as ar','ad.id','=','ar.admin_id')
                        ->join('role as r','ar.role_id','=','r.id')
                        ->join('role_auth as ra','r.id','=','ra.role_id')
                        ->join('auth as a','ra.auth_id','=','a.id')
                        ->select('a.route')
                        ->where('ad.id',$id)
                        ->get();
                    $list_route = ['Admin/Index/left','Admin/Index/loginOut',
                        'Admin/Index/top','Admin/Index/footer','Admin/Index/main','Admin/Index/index'];
                    foreach ($rows as $v){
                        $list_route[] = $v->route;
                    }
                    if (!in_array($request->route()->uri(),$list_route)){
                        return abort(404);
                    }
                }

            }
        };
        return $next($request);
    }
}
