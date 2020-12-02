
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

    <title>Sign in </title>
</head>
<body style=" background-image:url({{asset('images/auth/login_bk.jpg')}});
    height: 100%;
    background-repeat: no-repeat;
    background-size: cover;">
<div  style="  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 10px; margin-top:5%" class="col-md-6 p-5 offset-md-3 ">
    <h1 class="text-center" style="font-family: 'Piedra', cursive;  ">{{__('Login')}} <br></h1>
    <p class="text-center" style="font-family: 'Piedra', cursive;  ">{{__('To Enjoy Reading or Downloading more Books')}} </p>

    <form style="margin-top:8% ; "  action="{{route('doLogin_auth')}}" method="post" autocomplete="off" >
        @csrf
        <div class="form-group">
            <input  type="text" value="{{old('email')}}"  placeholder="{{__('Email')}}" class="form-control" name="email">
        </div>
        <div class="input-group mb-3">
            <input  type="password" id="myInput" name="password" class="form-control" placeholder="{{__('Password')}}">

        </div>
        <div style="text-align: center ; margin-top: 30px " >
            <button type="submit" style="width: 60%; text-decoration: none" name="login_btn" class="btn btn-primary">{{__('Login')}} </button>
            <span style="display: block; margin-top: 30px">{{__('Not a Member ?')}} <a style="font-family: 'Piedra', cursive;" href="{{route('Register_auth')}}">{{__('SignUp Now')}} </a> </span>
            <span style="display: block; margin-top: 10px"><a style="font-family: 'Piedra', cursive;font-size: 30px;text-decoration: none; color: black" href="{{route('all_books')}}">  ↩ {{__('GO Home')}} </a> </span>

        </div>


    </form>
    @include('inc.errors')

</div>

</body>
</html>

