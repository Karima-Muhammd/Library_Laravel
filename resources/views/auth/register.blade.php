<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Piedra&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>{{__('Sign Up')}} </title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rakkas&display=swap" rel="stylesheet">
</head>
<body style="background-image:url({{asset('images/auth/bk-login.jpg')}});
    height: 100%;
  background-repeat: no-repeat;
  background-size: cover;font-family: 'Piedra', cursive;
@if(app()->getLocale()=='ar') font-family: 'Rakkas', cursive; @endif
    ">
<div class="container">
<div class="row">
    <div  style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 10px" class="col-md-6 p-5 offset-md-3 mt-5 ">
        <h2 style=" text-align: center; " class="text-center mb-4">{{__('Register Now')}}</h2>
        <p class="text-center">{{__('To Enjoy Reading or Downloading more Books')}} </p>

        <form action="{{route('doRegister_auth')}}" METHOD="post">
            @csrf
            <div class="form-group " style="background-color: transparent">
                <input  value="{{old('name')}}" type="text" placeholder="{{__('Enter Name')}} .." class="form-control" name="name">
            </div>
            <div class="form-group">
                <input type="text" value="{{old('email')}}" placeholder="{{__('Enter Email')}} .."  class="form-control" name="email">
            </div>

            <div class="input-group mb-3">
                <input value="{{old('password')}}" type="password" id="myInput" placeholder="{{__('Enter Password')}} .."  class="form-control" name="password" >
            </div>
            <div style="text-align: center " class="mt-3">
                <button STYLE="width: 60%; "  type="submit" name="" class="btn btn-primary ">{{__('Register')}}</button>
                <span style=" margin-top:3rem; display: block;">{{__('Have Already An Account?')}}<a style="text-decoration: none" href="{{route('Login_auth')}}"> {{__('Login Here')}}</a></span>
                <span style="display: block; margin-top: 10px"><a style="font-size: 30px; color: black; text-decoration: none" href="{{route('all_books')}}">  ↩ {{__('GO Home')}} </a> </span>
            </div>
        </form>
    </div>
    <div class="col-md-6 offset-md-3">
        @include('inc.errors')
    </div>
</div>
</div>
</body>
</html>

