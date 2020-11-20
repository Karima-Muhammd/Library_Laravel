
@extends('layouts.app')
@section('title')
    Search For Book
@endsection
@section('content')

<h1>Result Search</h1>
<div class="row">
@foreach($books as $book)
    <div class="col-md-5 mt-4">
    <h5>{{$book->name}}</h5>
    @if($book->img !=null)
        <img class="img-thumbnail  text-center" height="40rem" width="100rem" src="{{asset("images/books/$book->img")}}">
    @else
        <img class="img-thumbnail text-center " height="40rem" width="100rem" src="{{asset("images/books/no-image.jpg")}}">
    @endif
    <p class="badge badge-pill ">By : <a href="{{route('show_authors',$book->author->id )}}">{{$book->author->name}}</a></p>
    <p class="badge badge-pill ">Price : {{$book->price}}$</p>

        <p> <span class="badge badge-pill ">OverView :</span><br> {{$book->desc}}</p>

    <small class="d-block">{{$book->created_at}}</small>
    </div>
@endforeach
</div>
@endsection


