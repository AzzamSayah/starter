<?php

namespace App\Http\Controllers\relations;

use App\Http\Controllers\Controller;
use App\models\Phone;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation(){

        // $phones = $user -> phone; //get phone relationships
        // $user = User:: with('phone') -> find(4);// get user with all data pf phone reltionship
        // get some data from reletionship
        $user = User::with(['phone' => function($q){
            $q -> select('code','phone','user_id');
        }])->find(4);

        // return one filed from object
       //return $code = $user -> phone -> code;
       //or
       //return $user -> name;

     
        return response()->json($user);
    }

    public function hasOneRelationReverse(){
        //$phone = Phone::find(1);// return only phone data
        $phone = Phone::with('user')->find(1); // return phone data +  all user data

        $phone = Phone::with(['user' => function($q){
            $q -> select('id','name');
        }])->find(1); // // return phone data +  some user data

        // make some attribute visible
        //$phone -> makeVisible(['user_id']);
        // make some attribute hidden
        //$phone -> makeHidden(['code']);
       // return $phone -> user; // return user of this phone number
        return $phone;
    }

    public function getUsersHasPhones(){
       
        return User:: whereHas('phone') -> get();
   }

    public function getUsersHasPhonesWithCondition(){
        return
            User::whereHas('phone', function ($q) {
                $q->where('code', '961');
            })->get();

    }

    public function getUsersNotHasPhones()
    {
        return User::whereDoesntHave('phone')->get();
    }
}
