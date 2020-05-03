<?php

namespace App\Http\Controllers\Goods;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Input;
use Session;

class GoodsController extends Controller
{
    //判断用户是否存在
    public function isLogin()
    {
        //判断登录信息是否存在
        if (Session::get('uid'))
        {
            return $id = Session::get('uid');
        }else{
            return redirect(url('Home/login'));
        }
    }
    //主页下商品搜索和商品无限分类的跳转
    public function seach(){
    //获取商品的分类id
        $pid = Input::get('id');
        //如果能获取商品的id  说明是从首页的分类下点击进来的
        if ($pid) {
            //根据商品的分类id获取改分类下所有的商品
//            $rows = DB::table('goods')->where('cate_id', $pid)->orderBy('id','desc')->paginate(12);
            $rows = DB::table('goods')->where('cate_id', $pid)->get()->toArray();
            $num = count($rows);
            //如果不是  说明是从头部的搜索框进来的
        }else{
            $keywords = Input::get('keywords');
            //从头部输入的关键字查询数据库
//            $rows = DB::table('goods')->where('good_name','like','%'.$keywords.'%')->orderBy('add_time','desc')->paginate(12);
            $rows = DB::table('goods')->where('good_name','like','%'.$keywords.'%')->get()->toArray();
            $num = count($rows);
        }
        $data = compact('rows','num');
//        dd($num);
        return view('Goods.seach', $data);
    }
    //商品详情页的跳转路由
    public function info(){
        //商品详情

            //[1=>'手袋单人份',2=>'礼盒双人份',3=>'全家福礼包']  手袋单人份;礼盒双人份;全家福礼包
            //[1=>'原味',2=>'奶油',3=>'炭烧',4=>'咸香']        原味;奶油;炭烧;咸香
            //接口
        $product_id = Input::get('id');


            $rows = DB::table('goods')->where('id',$product_id)->first();
            //获取分类id
            $cate_id = DB::table('goods')->where('id',$product_id)->value('cate_id');
            //获取分类的名字
            $cate_name= DB::table('cate')->where('id',$cate_id)->value('cate_name');

            $taste = explode(';',$rows->taste);
            $taste_length = count($taste);
            $message = explode(';',$rows->info);
            $message_length = count($message);
//dd($cate_id);
            $date = compact('rows','taste','message','taste_length','message_length','cate_id','cate_name');

        return view('Goods.info',$date);
    }
    //购物车跳转
    public function shopcart(){
        $uid =Session::get('uid');
//        dd($uid);
        if($uid == ''){
            return redirect('Home/login');
        }
        $results = DB::select("select * from cart,goods where cart.product_id = goods.id and cart.uid = '{$uid}'");
//        $results =DB::table('cart')->leftJoin('goods')->where(cart.);
//        dd($results);
        return view('Goods.shopcart',['title'=>'购物车页面','rows'=>$results]);
    }
    // 商品详情页 加入购物车处理  ajax
    public function infoAction(){
        $uid =Session::get('uid');
//        dd($uid);
        if($uid == ''){
//            return redirect('/');
            $data['status'] = 2;
            return response()->json($data);
        }
//        dd($uid);
        $product_id = Input::get('product_id');
        $product_num = Input::get('num');
        $taste = Input::get('taste');
        $array = explode(';',$taste);
        //查询当前用户是否存在该商品
        $row = DB::select("select id,product_num from cart where uid='{$uid}' and product_id = '{$product_id}'");
//        dd($array);
        if ($row){
            //用户购物车商品更新
            $id = $row[0]->id;
            $num = $product_num+$row[0]->product_num;
            $b = DB::table('cart')->where('id',$id)->update(['product_num'=>$num,]);
        }else{
            //新用户或用户添加新商品
            $b=DB::table('cart')->insertGetId(['uid'=>$uid,'product_id'=>$product_id,'product_num'=>$product_num,'product_taste'=>$array[1],'product_pack'=>$array[2]]);
        }
        if ($b){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
        return response()->json($data);
    }
    //购物车页面更新数据库处理
    public function cartAction()
    {
//        dd(1111);
        if ( Input::get('product_num') && Input::get('product_id')) {
            //更新
            $prodcut_id = Input::get('product_id');
            $product_num = Input::get('product_num');
            DB::table('cart')->where('product_id', $prodcut_id)->update(['product_num' => $product_num]);
        }else {
            //删除
//            dd(1111);
            $prod_id = Input::get('product_id');
            $bool = is_array($prod_id);
//            dd($bool);
            if ($bool){
                foreach ($prod_id as $v){
                    $id = $v;
                    if (isset($id) && ($id > 0)) {
                        DB::table('cart')->where('product_id', $id)->delete();
                    }
                }
            }else{

                if (isset($prod_id) && ($prod_id > 0)) {
                    DB::table('cart')->where('product_id', $prod_id)->delete();
                }
            }
        }
    }
    //结算时 跳转登结算页面  并且生成临时 订单
    public function creatOrder(){
        date_default_timezone_set("Asia/Shanghai");
        $pid = Input::get('pid');
        $uid =Session::get('uid');

        //如果用户没有登录  让用户跳转登录页面
        if($uid == ''){
            $data['status'] = 0;
            $data['order_id'] = "";
        }
        $date2 = date("Y年m月d日 H时i分s秒");
        $date1 = time();
        $date1 = $date1.$uid;
        foreach ($pid as $v) {
           $pname =  DB::table('goods')->where('id',$v)->value('good_name');
           $price =  DB::table('goods')->where('id',$v)->value('new_price');
           $pic =  DB::table('goods')->where('id',$v)->value('pic');
            $cid = DB::table('cart')->where('uid', $uid)->where('product_id', $v)->get();
            $bool =  DB::table('order')->insertGetId([
                'uid'=>$uid,
                'pid'=>$v,
                'taste'=>$cid[0]->product_taste,
                'pack'=>$cid[0]->product_pack,
                'pnum'=>$cid[0]->product_num,
                'status'=>'0',
                'order_id'=>$date1,
                'time'=>$date2,
                'pname'=>$pname,
                'price'=>$price,
                'pic'=>$pic
            ]);
           if ($bool && $cid[0]->id){
               DB::table('cart')->where('id',$cid[0]->id)->delete();
               $data['status'] = 1;
               $data['order_id'] = $date1;
            }
        }
        return response()->json($data);
    }
    //跳转订单的路由
    public function pay(){

        $order_id =Input::get('order');
        $uid =Session::get('uid');
        //如果用户没有登录  让用户跳转登录页面
        if($uid == ''){
            $data['status'] = 0;
//            return redirect('/');
        }
        //获取订单中的详情
        $rows = DB::table('order')->where('order_id',$order_id)->get();
        $add = DB::table('add_address')->where('uid',$uid)->get();
        $add1 = DB::table('add_address')->where('uid',$uid)->where('status',1)->get();

        $result = compact('rows','add','add1');
       return view('Goods.pay',$result);
    }
    //更改收货地址的路由
    public function shipAddress(){
    $id = Input::get('id');
    $rows = DB::table('add_address')->where('id',$id)->first();
    return response()->json($rows);
    }
    //支付时更新订单信息
    public function updateOrder(){
      $pay_type =  Input::get('pay_type');
//      dd($pay_type);
      $order_id =  Input::get('order_id');
      $express_type =  Input::get('express_type');
      $addid =  Input::get('addid');
        $info = Input::get('info');
        $uid =Session::get('uid');
        $row = DB::table('order')->where('order_id',$order_id)->update(
            ['add_id'=>$addid,'status'=>1,'pay_type'=>$pay_type,'express_type'=>$express_type,'info'=>$info]
        );

        if ($row){
            $data['mess'] = 1;
        }else{
            $data['mess'] = 0;
        }
        return response()->json($data);
    }
    //跳转付款成功页面
    public function sucess(){
        $oid = Input::get('order');
        $rows = DB::table('order')->where('order_id',$oid)->get();
        $aid = $rows[0]->add_id;
        $sum = 0;
        foreach($rows as $v){
            $sum = $sum + $v->pnum*$v->price;
        }
     $add = DB::table('add_address')->where('id',$aid)->get();

         $sum = sprintf("%.2f",$sum);
         $result = compact('sum','add');
        return view('Goods.sucess',$result);
    }

    //商品详情页加入收藏
    public function addCollection(){
        $uid = Session::get('uid');
        $product_id = Input::get('product_id');
        if ($uid){

            $tim = time();
            $row = DB::table('collection')->where('uid',$uid)->where('product_id',$product_id)->update(['time'=>$tim]);
            if($row){
                $data['status'] = 0;
            }else{
                DB::table('collection')->insert(['product_id'=>$product_id,'uid'=>$uid,'time'=>$tim]);
                $data['status'] = 1;
            }
        }else{
            $data['status'] = 2;
        }
        return Response()->json($data);
    }

    //收藏
    public function collection(){
        $uid = $this->isLogin();
        if (isset($uid)){
            $rows = DB::table('collection as c')->join('goods as g','g.id','=','c.product_id')->where('uid',$uid)->get();
        }
//        dd($rows);
        $data = compact('rows');
        return view('Person/collection',$data);
    }

    //收藏处理
    public function collectionAction(){
        $uid = $this->isLogin();
        $row = DB::table('collection')->where('uid',$uid)->delete();
        if ($row){
            $status = 1;
        }else{
            $status = 0;
        }
//       $status = 1;
        return Response()->json($status);
    }

    //足迹
    public function goodsfoot(){
        $uid = $this->isLogin();
        if (isset($uid)){
            $ar=strtotime("today");
            $todayRows = DB::table('history as h')->join('goods as g','g.id','=','h.product_id')->where('uid',$uid)->where('time','>',$ar)->orderBy('time','desc')->get();
            $week = $ar - 7*86400;
//
            $weekRows = DB::table('history as h')->join('goods as g','g.id','=','h.product_id')->where('uid',$uid)->where('time','<',$ar)->where('time','>',$week)->orderBy('time','desc')->get();
        }
        if($todayRows->isEmpty()){
            $todayR = 0;
        }else{
            $todayR = 1;
        }
        if($weekRows->isEmpty()){
            $weekR = 0;
        }else{
            $weekR = 1;
        }
        $today = date("m-d",$ar);
        $data = compact('todayRows','today','weekRows','todayR','weekR');
        return view('Person/goodsfoot' ,$data);
    }

    //足迹处理
    public function footAction(){
        $uid = $this->isLogin();
        $product_id = Input::get('product_id');
        $ad = Input::get('ad');
//       dd(Input::get('ad'));
        $today = "today";
        if ($product_id){
            $row = DB::table('history')->where('uid',$uid)->where('product_id',$product_id)->delete();
        }else {
            $ar = strtotime("today");
            $week = $ar - 7 * 86400;
            if ($ad == $today) {
                $todayRows = DB::table('history as h')->join('goods as g', 'g.id', '=', 'h.product_id')->where('uid', $uid)->where('time', '>', $ar)->orderBy('time', 'desc')->get();
                //删除当天的记录
                if ($todayRows->first()) {
                    $row = DB::table('history')->where('uid', $uid)->where('time', '>', $ar)->delete();
                }
            } else {
                $weekRows = DB::table('history as h')->join('goods as g', 'g.id', '=', 'h.product_id')->where('uid', $uid)->where('time', '<', $ar)->where('time', '>', $week)->orderBy('time', 'desc')->get();
                if ($weekRows->first()) {
                    $row = DB::table('history')->where('uid', $uid)->where('time', '<', $ar)->where('time', '>', $week)->delete();
                }

            }
        }
        if ($row){
            $status = 1;
        }  else{
            $status = 0;
        }
        return Response()->json($status);
    }



}
