<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use stdClass;

class UserController extends Controller
{
    
    
    public function showUserName()
    {
        return "Azzam Ali Sayah";
    }

    public function getIndex(){

        $obj = new stdClass();
        $obj -> name = "azzam";
        $obj -> age = 35;
        $obj-> id = 1;
        

       $data =['azzam','bassam','sara','hilal'];

        //$data2 = [];
        
        return view('welcome', compact('obj'),
         compact('data'));


    }
}
