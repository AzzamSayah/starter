@extends('layouts.app')
@section('content')

<div class ="container">
        <div class="flex-center position-ref full-height">
           <div class="content">
                <div class="title m-b-md">
                {{__('messages.AddYourOffer')}}
                </div>
              
<form  method="POST" id = "offerForm" action="" enctype ="multipart/form-data">
    @csrf

<div class="col-auto">
    <label >{{__('messages.selectImage')}}</label>
    <input type="file" value = {{__('messages.selectImage')}} class="form-control" name="photo" id ="choose-file">
    
     <small id="photo_error" class="form-text text-danger"></small>   
    
    
  </div>


  <div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">offer name</label>
    <input type="text"  class="form-control" name="name_ar" placeholder=
    "{{__('messages.offerName_ar')}}">
    
     <small id="name_ar_error" class="form-text text-danger"></small>   
    
    
  </div>

<div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">offer name</label>
    <input type="text"  class="form-control" name="name_en" placeholder=
    "{{__('messages.offerName_en')}}">
    
     <small id="name_en_error" class="form-text text-danger"></small>   
    
    
  </div>




  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">price</label>
    <input type="text" class="form-control" name = "price" placeholder =
    "{{__('messages.offerPrice')}}">
       
     <small id="price_error" class="form-text text-danger"></small>   
    
  </div>
  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">details</label>
    <input type="text" class="form-control" name = "details_ar" placeholder = "{{__('messages.offerDetails_ar')}}">
      
     <small id="details_ar_error" class="form-text text-danger"></small>   
    
  </div>

  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">details</label>
    <input type="text" class="form-control" name = "details_en" placeholder = "{{__('messages.offerDetails_en')}}">
      
     <small id="details_en_error" class="form-text text-danger"></small>   
    
  </div>

<br>

  <div class="col-auto">
    <button id = "save_offer" class="btn btn-primary mb-3">{{__('messages.SaveOffer')}}</button>
  </div>
  
</form>
           </div>
@stop

@section('scripts')
<script>
  $('#save_offer').click(function(e){
    e.preventDefault();
    console.log('clicked');
    $('#photo_error').text('');
    $('#name_ar_error').text('');
    $('#name_en_error').text('');
    $('#details_ar_error').text('');
    $('#details_en_error').text('');
    $('#price_error').text('');

var formData = new FormData($('#offerForm')[0]);


    $.ajax({
    type:'post',
    enctype:'multipart/form-data',
    url: "{{route('ajax.offers.store')}}",
    data:formData,
    processData : false,
    contentType:false,
    cache:false,
    success : function(data){
       alert(data.msg);

    },
    error:function(reject){
var response = $.parseJSON(reject.responseText);
      $.each(response.errors,function(key,val){
        $("#" + key + "_error").text(val[0]);
      });
       
    }
  });
  });
  
  </script>
@stop