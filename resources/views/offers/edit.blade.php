<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       
        <li class="nav-item">
          <a class="nav-link">{{__('messages.selectLanguage')}} -></a>
        </li>
        <div class="collapse navbar-collapse" >
        <ul  class="navbar-nav me-auto mb-2 mb-lg-0>
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <li class="nav-item" >
            <a class="nav-link active" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
            </a>
        </li>
    @endforeach
</ul>
        </div>
       
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>


        <div class="flex-center position-ref full-height">
           <div class="content">
                <div class="title m-b-md">
                {{__('messages.updateYourOffer')}}
                </div>
                @if (Session::has('success'))
                  <div class="alert alert-success" role="alert">
                      {{Session::get('success')}}  
                  </div>
                @endif
<form  method="POST" action="{{route('offers.update',$offer -> id)}}">
    @csrf
  <div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">offer name</label>
    <input type="text"  class="form-control" name="name_ar" placeholder=
    "{{__('messages.offerName_ar')}}" value ="{{$offer -> name_ar}}">
    @error('name_ar')
     <small class="form-text text-danger">{{$message }}</small>   
    @enderror
    
  </div>

<div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">offer name</label>
    <input type="text"  class="form-control" name="name_en" placeholder=
    "{{__('messages.offerName_en')}}" value ="{{$offer -> name_en}}">
    @error('name_en')
     <small class="form-text text-danger">{{$message }}</small>   
    @enderror
    
  </div>




  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">price</label>
    <input type="text" class="form-control" name = "price" placeholder =
    "{{__('messages.offerPrice')}}" value ="{{$offer -> price}}">
       @error('price')
     <small class="form-text text-danger">{{$message}}</small>   
    @enderror
  </div>
  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">details</label>
    <input type="text" class="form-control" name = "details_ar" placeholder = "{{__('messages.offerDetails_ar')}}" value ="{{$offer -> details_ar}}">
      @error('details_ar')
     <small class="form-text text-danger">{{$message}}</small>   
    @enderror
  </div>

  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">details</label>
    <input type="text" class="form-control" name = "details_en" placeholder = "{{__('messages.offerDetails_en')}}" value ="{{$offer -> name_en}}">
      @error('details_en')
     <small class="form-text text-danger">{{$message}}</small>   
    @enderror
  </div>

<br>

  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">{{__('messages.update')}}</button>
  </div>
</form>
               
            </div>
        </div>

                    


    </body>
</html>
