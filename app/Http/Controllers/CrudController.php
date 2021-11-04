<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudController extends Controller
{
    public function  getOffers()
{
  return Offer::select('id','name') -> get();
}
//  public function store(){
//      Offer:: create([
//          'name' => 'offer 3',
//          'price' => '500',
//          'details' => 'offer 3 details'
//      ]);
//  }

 public function create(){
return view('offers.create');

 }

 public function store(OfferRequest $request){
   Offer:: create([
         'name_ar' => $request -> name_ar,
         'name_en' => $request -> name_en,
         'price' => $request -> price,
         'details_ar' => $request -> details_ar,
         'details_en' => $request -> details_en
     ]);

     return redirect() -> back() -> with(
       ['success' => __('messages.dataSavedSuccess')]);

     
 }

 public function getAllOffers(){
  $offers = Offer::select('id','name_' . LaravelLocalization::getCurrentLocale() . ' as name','price','details_' . LaravelLocalization::getCurrentLocale() . ' as details') -> get();
return view('offers.all',compact('offers')) ;

}

}
