<?php

namespace App\Http\Controllers;

use App\models\Offer;
use Illuminate\Http\Request;
use App\Traits\OfferTrait;

class OfferController extends Controller
{
    use OfferTrait;
    public function  create(){
            //  view form to add this offer 
            return view('ajaxoffers.create');
    }
    public function store(Request $request){
        //  save  offer into databse  using ajax
       // $file_name = $this->saveImage($request->photo, 'images/offers');

        Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
            
        ]);

      }
}
