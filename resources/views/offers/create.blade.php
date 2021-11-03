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
 
        <div class="flex-center position-ref full-height">
           <div class="content">
                <div class="title m-b-md">
                Add your offer
                </div>
                @if (Session::has('success'))
                  <div class="alert alert-success" role="alert">
                      {{Session::get('success')}}  
                  </div>
                @endif
<form  method="POST" action="{{route('offers-store')}}">
    @csrf
  <div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">offer name</label>
    <input type="text"  class="form-control" name="name" placeholder="name">
    @error('name')
     <small class="form-text text-danger">{{$message }}</small>   
    @enderror
    
  </div>
  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">price</label>
    <input type="text" class="form-control" name = "price" placeholder="price">
       @error('price')
     <small class="form-text text-danger">{{$message}}</small>   
    @enderror
  </div>
  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">details</label>
    <input type="text" class="form-control" name = "details" placeholder="details">
      @error('details')
     <small class="form-text text-danger">{{$message}}</small>   
    @enderror
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Save Offer</button>
  </div>
</form>
               
            </div>
        </div>

                    


    </body>
</html>
