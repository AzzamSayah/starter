<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;




class FirstController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['showString1', 'showString2']);
    }

    public function showString1()
    {
        return 'hello 1';
    }
    public function showString2()
    {
        return 'hello 2';
    }
    public function showString3()
    {
        return 'hello 3';
    }
    public function showString4()
    {
        return 'hello 4';
    }
}
