<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Traits\OfferTrait;

class CrudController extends Controller
{
    use OfferTrait;
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

//save photo in folder

$file_name = $this-> saveImage($request -> photo,'images/offers');



   Offer:: create([
         'name_ar' => $request -> name_ar,
         'name_en' => $request -> name_en,
         'price' => $request -> price,
         'details_ar' => $request -> details_ar,
         'details_en' => $request -> details_en,
         'photo' => $file_name,
     ]);

     return redirect() -> back() -> with(
       ['success' => __('messages.dataSavedSuccess')]);

     
 }

 public function getAllOffers(){
  $offers = Offer::select('id','name_' . LaravelLocalization::getCurrentLocale() . ' as name','price','details_' . LaravelLocalization::getCurrentLocale() . ' as details') -> get();
return view('offers.all',compact('offers')) ;

}

public function editOffer($offer_id){
//Offer:: findOrFail($offer_id);
//$offer = Offer::find($offer_id);//search in given table id primary key only

$offer = Offer::select('id','name_ar','name_en','details_ar','details_en','price') -> find($offer_id);

    if (!$offer) {
      return redirect()->back();
    }
    return view('offers.edit',compact('offer'));

}

public function updateOffer(OfferRequest $request,$offer_id){
    // vaidation in external file
    // check if exist
    $offer = Offer::find($offer_id);
    if (!$offer) {
      return redirect()->back();
    }

//update data

// first method

/*$offer -> update([
  'name_ar' =>$request -> name_ar,
  
]);
*/

//second method
$offer -> update($request -> all());
return redirect() -> back() -> with(['success' => __('messages.updateSuccessfully')]);
}



}
