@extends('layouts.app')
@section('title')
    {{$category->name}}
@endsection
@section('content')

<h4 style="font-family: 'Piedra', cursive;margin-top: 3rem">{{$category->name}}</h4>
<hr>
<br>
@if(!empty($category->book))
    <div class="row">
@foreach($category->book as $book)
    <div  class=" mt-2 col-md-3  text-center" style="">
        @if($book->img !=null)
            <a href="{{route('show_books',$book->id )}}"><img class="img-thumbnail d-block" style="width: 100%;height:25vw;object-fit:fill;" src="{{asset("images/books/$book->img")}}"></a>
        @else
            <img class="img-thumbnail d-block" height="40rem" width="100rem" src="{{asset("images/books/no-image.jpg")}}">
        @endif
    </div>
@endforeach
    </div>
@endif
<br>
<br>
<small class="d-block">{{$category->created_at}}</small>
<br>
<a class="btn btn-success" href="{{route('all_authors')}}">{{__('Go Home')}}</a>
<a class="btn btn-success" href="{{route('latest_authors')}}">{{__('Show Recent Authors')}}</a>
@endsection
