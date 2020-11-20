@extends('layouts.app')
@section('title')
    Latest Authors
@endsection
   @section('content')
          <h1>Latest books</h1>

        @foreach($books as $book)
            <p>{{$book->name}}</p>
            @if($book->img !=null)
                <img class="img-thumbnail d-block" height="40rem" width="100rem" src="{{asset("images/books/$book->img")}}">
            @else
                <img class="img-thumbnail d-block" height="40rem" width="100rem" src="{{asset("images/books/no-image.jpg")}}">
            @endif
            <p>By :<a href="{{route('show_authors',$book->author->id)}}"> {{$book->author->name}}</a></p>
            <p>Price : ${{$book->price}}</p>
            <p>{{$book->desc}}</p>
            <small>Create At : {{$book->created_at}}</small>
            <hr>
       @endforeach
@endsection
