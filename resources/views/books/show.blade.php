@extends('layouts.app')
@section('title')
    Show Books
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
                @if($book->img !=null)
                    <img class="img-thumbnail  text-left" height="40rem" width="200rem" src="{{asset("images/books/$book->img")}}">
                @else
                    <img class="img-thumbnail text-left" height="40rem" width="100rem" src="{{asset("images/books/no-image.jpg")}}">
                @endif
                <p class="badge badge-pill ">By : <a href="{{route('show_authors',$book->author->id )}}">{{$book->author->name}}</a></p>
                <div class="float-left">
                    <p><span class="badge badge-pill">Overview: </span> <br> {{ $book->desc}}</p>
                    <p ><span class="badge badge-pill">Price in Market :</span> {{$book->price}}$</p>
                    <p ><span class="badge badge-pill">Number of Downloads :</span> {{$book->number_download}}</p>
                    <p ><span class="badge badge-pill">File Type :</span> PDF</p>

                    <small class="d-block"><span class="badge badge-pill">Create at :</span> {{$book->created_at}}</small>
                <br>
                <a class="btn btn-primary" href="{{route('all_books')}}"> ↩ GO Home </a>
                <a  href="{{route('viewPDF',$book->id)}}" class="btn btn-warning"> Read </a>
                <a  href="{{route('Download',$book->id)}}" class="btn btn-success"> Download </a>

                </div>
            </div>
        </div>
        <div class="col-lg-3" style="margin-top: 10% ;">
            <div class="float-right"> @include('categories.categories')</div>
        </div>
    </div>
@endsection
