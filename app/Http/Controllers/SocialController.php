<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service)
    {
        
        
        if (!request()->has('code') || request()->has('denied')) {
            return redirect('/');
            
        }


         $user = Socialite::with($service);
         return response() -> json($user);
    }
}
