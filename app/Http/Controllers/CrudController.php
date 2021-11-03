<?php

namespace App\Http\Controllers;

use App\models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

 public function store(Request $request){
  

$rules = $this-> getRules();
$messages = $this-> getMessages();

  // validate data before insert to database
  $validator = Validator($request->all(),$rules,$messages);
  if($validator -> fails()){
    return redirect()->back()->withErrors($validator)->withInput($request->all());
  }

    Offer:: create([
         'name' => $request['name'],
         'price' => $request['price'],
         'details' => $request['details']
     ]);

     return redirect() -> back() -> with(
       ['success' => __('messages.dataSavedSuccess')]);

     
 }

protected function getMessages(){
  return  [
        'name.required' => __('messages.offerNameRequired'),
        'name.unique' => __('messages.offerNameUnique'),
        'price.numeric' => __('messages.priceNumeric'),
        'price.required' =>__('messages.priceRequired'),
        'details.required' =>__('messages.offerDetailsRequired')
        
      ];
}

protected function getRules(){
  return  [
      'name' => 'required|max:100|unique:offers,name',
      'price' => 'required|numeric',
      'details' => 'required'
  ];
}



}
