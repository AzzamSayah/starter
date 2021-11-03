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
       ['success' => 'تم إضافة البيانات بنجاح']);

     
 }

protected function getMessages(){
  return  [
        'name.required' => 'إسم العرض مطلوب',
        'name.unique' => 'إسم العرض موجود',
        'price.numeric' => 'سعر العرض يجب ان يكون أرقام',
        'price.required' => 'سعر العرض مطلوب',
        'details.required' => 'وصف العرض مطلوب'
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
