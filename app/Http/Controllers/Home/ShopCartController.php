<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCartController extends Controller
{
    //控制器   商品详情遍历
    public function introduction(){
        return view('Home.shopcart');
    }

}
