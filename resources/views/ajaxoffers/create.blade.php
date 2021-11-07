@extends('layouts.app')
@section('content')

<div class ="container">
        <div class="flex-center position-ref full-height">
           <div class="content">
                <div class="title m-b-md">
                {{__('messages.AddYourOffer')}}
                </div>
                @if (Session::has('success'))
                  <div class="alert alert-success" role="alert">
                      {{Session::get('success')}}  
                  </div>
                @endif
<form  method="POST" action="" enctype ="multipart/form-data">
    @csrf

<div class="col-auto">
    <label >{{__('messages.selectImage')}}</label>
    <input type="file" value = {{__('messages.selectImage')}} class="form-control" name="photo" id ="choose-file">
    @error('photo')
     <small class="form-text text-danger">{{$message }}</small>   
    @enderror
    
  </div>


  <div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">offer name</label>
    <input type="text"  class="form-control" name="name_ar" placeholder=
    "{{__('messages.offerName_ar')}}">
    @error('name_ar')
     <small class="form-text text-danger">{{$message }}</small>   
    @enderror
    
  </div>

<div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">offer name</label>
    <input type="text"  class="form-control" name="name_en" placeholder=
    "{{__('messages.offerName_en')}}">
    @error('name_en')
     <small class="form-text text-danger">{{$message }}</small>   
    @enderror
    
  </div>




  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">price</label>
    <input type="text" class="form-control" name = "price" placeholder =
    "{{__('messages.offerPrice')}}">
       @error('price')
     <small class="form-text text-danger">{{$message}}</small>   
    @enderror
  </div>
  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">details</label>
    <input type="text" class="form-control" name = "details_ar" placeholder = "{{__('messages.offerDetails_ar')}}">
      @error('details_ar')
     <small class="form-text text-danger">{{$message}}</small>   
    @enderror
  </div>

  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">details</label>
    <input type="text" class="form-control" name = "details_en" placeholder = "{{__('messages.offerDetails_en')}}">
      @error('details_en')
     <small class="form-text text-danger">{{$message}}</small>   
    @enderror
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
    $.ajax({
    type:'post',
    url: "{{route('ajax.offers.store')}}",
    data:{
      '_token': "{{csrf_token()}}" ,
      'name_ar' :$("input[name='name_ar']").val(),
      'name_en' :$("input[name='name_en']").val(),
      'price' :$("input[name='price']").val(),
      'details_ar' :$("input[name='details_ar']").val(),
      'details_en' :$("input[name='details_en']").val(),
    },
    success : function(data){

    },
    error:function(reject){

    }
  });
  });
  
  </script>
@stop