@extends('layouts.app')
@section('content')

<div class ="container">
        <div class="flex-center position-ref full-height">
           <div class="content">
                <div class="title m-b-md">
                {{__('messages.updateYourOffer')}}
                </div>
              
<form  method="POST" id = "offerForm" action="" enctype ="multipart/form-data">
    @csrf

<div class="col-auto">
    <label >{{__('messages.selectImage')}}</label>
    <input type="file" value = {{__('messages.selectImage')}} class="form-control" name="photo" id ="choose-file">
    @error('photo')
     <small class="form-text text-danger">{{$message }}</small>   
    @enderror
    
  </div>

 <input type="hidden"  class="form-control" name="offer_id"  value = "{{$offer -> id}}">


  <div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">offer name</label>
    <input type="text"  class="form-control" name="name_ar" placeholder=
    "{{__('messages.offerName_ar')}}" value = "{{$offer -> name_ar}}">
    @error('name_ar')
     <small class="form-text text-danger">{{$message }}</small>   
    @enderror
    
  </div>

<div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">offer name</label>
    <input type="text"  class="form-control" name="name_en" placeholder=
    "{{__('messages.offerName_en')}}" value = "{{$offer -> name_en}}">
    @error('name_en')
     <small class="form-text text-danger">{{$message }}</small>   
    @enderror
    
  </div>

  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">price</label>
    <input type="text" class="form-control" name = "price" placeholder =
    "{{__('messages.offerPrice')}}" value = "{{$offer -> price}}">
       @error('price')
     <small class="form-text text-danger">{{$message}}</small>   
    @enderror
  </div>
  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">details</label>
    <input type="text" class="form-control" name = "details_ar" placeholder = "{{__('messages.offerDetails_ar')}}" value = "{{$offer -> details_ar}}">
      @error('details_ar')
     <small class="form-text text-danger">{{$message}}</small>   
    @enderror
  </div>

  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">details</label>
    <input type="text" class="form-control" name = "details_en" placeholder = "{{__('messages.offerDetails_en')}}" value = "{{$offer -> details_en}}">
      @error('details_en')
     <small class="form-text text-danger">{{$message}}</small>   
    @enderror
  </div>

<br>

  <div class="col-auto">
    <button id = "save_offer" class="btn btn-primary mb-3">{{__('messages.update')}}</button>
  </div>
  
</form>
           </div>
@stop

@section('scripts')
<script>
  $('#save_offer').click(function(e){
    e.preventDefault();
    console.log('clicked');

var formData = new FormData($('#offerForm')[0]);


    $.ajax({
    type:'post',
    enctype:'multipart/form-data',
    url: "{{route('ajax.offers.update')}}",
    data:formData,
    processData : false,
    contentType:false,
    cache:false,
    success : function(data){
       alert(data.msg);

    },
    error:function(reject){

    }
  });
  });
  
  </script>
@stop