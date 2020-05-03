<?php

namespace App\Http\Controllers\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class InformationController extends Controller
{
    //
    public function information(){

        return view('Person.information');
    }
}
