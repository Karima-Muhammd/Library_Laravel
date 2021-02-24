@extends('layouts.app')
@section('title')
    {{__('Show Books')}}
@endsection
@section('style')
    <style>
        .section_hr
        {
            width: 15%;
            border-color:#dbcbbd;
            float: left;
            display: block;
            margin-top:0;

        }
    </style>
@endsection
@section('content')
    <div class="row">


        <div class="col-lg-9 mt-2">
            <div class="text-left">
                <br>
                <h4 style="font-family: 'Agency FB'">{{$book->name}}</h4>
                <div class="row">
                <div class="col-md-12">
                @if($book->img !=null)
                    <img class="img-thumbnail float-left d-block text-left" height="40rem" width="200rem" src="{{asset("images/books/$book->img")}}">
                @else
                    <img class="img-thumbnail text-left" height="40rem" width="100rem" src="{{asset("images/books/no-image.jpg")}}">
                @endif
                    <p class="badge badge-pill ">{{__('By')}} : <a href="{{route('show_authors',$book->author->id )}}">{{$book->author->name}}</a></p>

                </div>
                <div class="col-md-6">
                <div class="float-left">
                    <p><span class="badge badge-pill">{{__('Overview')}} : </span> {{ $book->desc}}</p>
                    <p ><span class="badge badge-pill">{{__('Price in Market')}} :</span> {{$book->price}}$</p>
                    <small class="d-block"><span class="badge badge-pill">{{__('Create at')}} :</span> {{$book->created_at}}</small>
                <br>
                </div>
                    <div class="float-left col-md-12">
                <a class="btn btn-primary" href="{{route('all_books')}}"> ↩ {{__('GO Home')}} </a>
                <a  href="{{route('viewPDF',$book->id)}}" class="btn btn-warning"> {{__('Read')}} </a>
                <a  href="{{route('Download',$book->id)}}" class="btn btn-success"> {{__('Download')}} </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-lg-3" style="margin-top: 10% ;">
            <div class="float-right"> @include('categories.categories')</div>
        </div>
    </div>
@endsection
