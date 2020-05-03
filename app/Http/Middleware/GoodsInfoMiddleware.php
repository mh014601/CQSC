<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use DB;
use Input;

class GoodsInfoMiddleware
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

        $uid = Session::get('uid');
        $time = time();
        if ($uid){
            $product_id = Input::get('id');
            $row = DB::table('history')->where('uid',$uid)->where('product_id',$product_id)->first();
            if ($row){
                DB::table('history')->where('uid',$uid)->where('product_id',$product_id)->update(['time'=>$time]);
            }else{
                DB::table('history')->insert(['uid'=>$uid,'product_id'=>$product_id,'time'=>$time]);
            }
        }









        return $next($request);
    }
}
