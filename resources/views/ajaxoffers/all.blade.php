
@extends('layouts.app')
@section('content')

<table class="table"> 
<thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('messages.offerName_' .
        LaravelLocalization::getCurrentLocale())}}</th>
        <th scope="col">{{__('messages.offerPrice')}}</th>
        <th scope="col">{{__('messages.offerDetails_'. 
        LaravelLocalization::getCurrentLocale())}}</th>
       
        <th scope ="col">{{__('messages.image')}}</th>
        <th scope="col">{{__('messages.operation')}} </th>
        
      
    </tr>
</thead>
<tbody>
    @foreach ($offers as $offer )
   
    <tr class = "offerRow{{$offer -> id}}">
        <th scope="row">{{$offer -> id}}</th>
        <td>{{$offer -> name}}</td>
        <td>{{$offer -> price}}</td>
        <td>{{$offer -> details}}</td>
        <td><img width ="100" height = "100" src="{{asset('images/offers/'.$offer -> photo)}}" alt=""></td>   
        <td><a  href={{url('offers/edit/'.$offer -> id)}} class="btn btn-success">{{__('messages.update')}} </a></td>

        <td><a  href={{url('offers/delete/'.$offer -> id)}} class="btn btn-danger">{{__('messages.delete')}}</a></td>
       
        <td><a  offer_id ="{{$offer -> id}}" href="" class="btnAjaxDelete btn btn-danger">{{__('messages.deleteAjax')}}</a></td>

          <td><a  href={{route('ajax.offers.edit',$offer -> id)}} class="btn btn-success">{{__('messages.updateAjax')}} </a></td>
    </tr>
     @endforeach
</tbody>
</table>
@stop


@section('scripts')
<script>
  $('.btnAjaxDelete').click(function(e){
    e.preventDefault();
    console.log('clicked');

    var offer_id = $(this).attr('offer_id');

    $.ajax({
    type:'post',
    url: "{{route('ajax.offers.delete')}}",
    data:{
        '_token':"{{csrf_token()}}",
        'id' : offer_id,

    },
    success : function(data){
        alert(data.msg);  
       $('.offerRow'+data.id).remove();
      

    },
    error:function(reject){

    }
  });
  });
  
  </script>
@stop
