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
      
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<h1>Services</h1>
@if (Session:: has('success'))
    <div class = "alert alert-success">
        {{Session::get('success')}}
    </div>
@endif

@if (Session:: has('error'))
    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>
@endif
<table class="table"> 
<thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        
    </tr>
</thead>
<tbody>
     @if (isset($docServices) && $docServices -> count() > 0)
    @foreach ($docServices as $docService)
        
 
    <tr>
        <th scope="row">{{$docService -> id}}</th>
        <td>{{$docService -> name}}</td>
        
    </tr>
     @endforeach
      @endif
</tbody>
</table>
<form  method = "POST" action="{{route('save.doctor.services')}}">
@csrf
    <div class="form-group">
    <label for="">select doctor</label>
    <select class = "form-control" name="doctor_id" >
        @foreach ($doctors as $doctor)
        <option value="{{$doctor -> id}}">{{$doctor -> name}}</option>    
        @endforeach
        
    </select>
</div>
    <div class="form-group">
    <label for="">select services</label>
    <select class = "form-control" name="service_ids[]" multiple >
        @foreach ($services as $service )
        <option value="{{$service -> id}}">{{$service -> name}}</option>    
        @endforeach
        
    </select>
</div>
<button type="submit" class="btn btn-success">save</button>
</form>

    </body>
</html>
