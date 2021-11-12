<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\models\Offer;
use Illuminate\Http\Request;
use App\Traits\OfferTrait;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class OfferController extends Controller
{
    use OfferTrait;
    public function  create()
    {
        //  view form to add this offer 
        return view('ajaxoffers.create');
    }
    public function store(OfferRequest $request)
    {
       
        //  save  offer into databse  using ajax
        $file_name = $this->saveImage($request->photo, 'images/offers');

        $offer = Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
            'photo' => $file_name

        ]);
        if ($offer) {
            
            return response()->json([
                
                'status' => true,
                'msg' => __('messages.dataSavedSuccess'),
            ]);
        } else {
          
            return response()->json([
                
                'status' => false,
                'msg' => __('messages.errorSavedData'),
            ]);
        }
    }


    public function all()
    {
        $offers = Offer::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name', 'price','photo', 'details_' . LaravelLocalization::getCurrentLocale() . ' as details')->limit(10)->get();
        return view('ajaxoffers.all', compact('offers'));
    }
    public function delete(Request $request)
    {
     

        $offer = Offer :: find($request -> id);
        $imgPath = public_path('images/offers/'.$offer -> photo);
        unlink($imgPath);
        $offer -> delete();
        return response() -> json([
            'status' => true,
            'msg' => __('messages.offerDeletedSuccessfully'),
            'id' =>  $request -> id,
        ]);
    }

    
public function edit(Request $request){
//Offer:: findOrFail($offer_id);
//$offer = Offer::find($offer_id);//search in given table id primary key only

$offer = Offer:: find($request -> offer_id);

    if (!$offer) {
         return response() -> json([
            'status' => false,
            'msg' => __('messages.offerNotFound'),
            
        ]);
    }
    return view('ajaxoffers.edit',compact('offer'));

}

public function update(Request $request){

    $offer = Offer::find($request -> offer_id);
    if (!$offer) {
      return response() -> json([
            'status' => false,
            'msg' => __('messages.offerNotFound'),
            
        ]);
    }



$offer -> update($request -> all());

 return response() -> json([
            'status' => true,
            'msg' => __('messages.updateSuccessfully'),
            
        ]);


}

}
