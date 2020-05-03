<?php

namespace App\Http\Controllers\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class orderController extends Controller
{
    //订单信息
    public function order(){
        return view('Person.order');
    }
    //订单详细信息
    public function orderinfo(){
        return view('Person.orderinfo');
    }
}
