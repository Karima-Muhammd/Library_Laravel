
<!doctype html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Piedra&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>@yield('title')</title>
</head>
@yield('style')

<body style="
@yield('body_style')">
<div  class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="col-lg-3">
        <a class="navbar-brand " style="font-family: 'Piedra', cursive;" >{{__('Library |')}}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="col-lg-4">
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('all_authors')}}">{{__('Authors')}} <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('all_books')}}">{{__('Books')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('all_categories')}}">{{__('Book Sections')}}</a>
                </li>

            </ul>
          </div>
        </div>

        <div class="col-lg-5  ">
            <ul class="navbar-nav float-right ">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" style="font-family: 'Piedra', cursive;" href="{{route('Register_auth')}}">{{__('Register Now') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="font-family: 'Piedra', cursive;" href="{{route('Login_auth')}}">{{__('Login')}}</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item dropdown mr-5" >
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu  " style="margin-left:-3rem" aria-labelledby="navbarDropdown">
                            <a class="nav-link" href="{{route('Logout_auth')}}">{{__("Logout")}} </a>
                        </div>

                    </li>
                @endauth

                    @if(count(config('app.languages')) > 1)
                        <li class="nav-item dropdown d-md-down-none">
                            <a class="nav-link" style="font-size: 12px" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                {{ strtoupper(app()->getLocale()) }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                @foreach(config('app.languages') as $langLocale => $langName)
                                    <a  style="color: white" class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                                @endforeach
                            </div>
                        </li>
                    @endif

            </ul>
        </div>
    </nav>
</div>
<div class="col-md-12 p-0">
    @yield('background')
</div>
<div class="container my-3">


    @yield('content')
</div>
<<<<<<< HEAD

=======
>>>>>>> 11f4187... upload files
<script rel="script" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
<script rel="script" src="{{asset('js/popper.min.js')}}"></script>
<script rel="script" src="{{asset('js/bootstrap.min.js')}}"></script>
<script rel="script" src="{{asset('js/script.js')}}"></script>
 @yield('script')

</body>
</html>
