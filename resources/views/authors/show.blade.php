@extends('layouts.app')
@section('title')
    Show Authors
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

        <div class="col-lg-9 mt-3">
            <h5>{{$author->name}}</h5>
            @if($author->img !=null)
                <img class="img-thumbnail d-block" height="40rem" width="200rem" src="{{asset("images/authors/$author->img")}}">
            @else
                <img class="img-thumbnail d-block" height="40rem" width="100rem" src="{{asset("images/authors/no-image.jpg")}}">
            @endif

            <p><span class="badge badge-pill">Bio:</span> <br>{{$author->bio}}</p>
            <hr>
            @if(!empty($author->book))
                <h6>His Works :</h6>
                <br>
                <div class="row m-0 p-0">
                    @foreach($author->book as $book)
                        <div  class=" mt-2  col-md-3 text-center p-0" style="max-width:25%">
                            @if($book->img !=null)
                                <a href="{{route('show_books',$book->id )}}"><img class="img-thumbnail d-block" style="object-fit:fill;width: 70%;height:10rem;"  src="{{asset("images/books/$book->img")}}"></a>
                            @else
                                <img class="img-thumbnail d-block" height="40rem" width="100rem" src="{{asset("images/books/no-image.jpg")}}">
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
            <br>
            <br>
            <small class="d-block">{{$author->created_at}}</small>
            <br>
            <a class="btn btn-primary" href="{{route('all_authors')}}">↩ GO Home</a>
        </div>
        <div class="col-lg-3  " style="margin-top: 10%">
          <div class="float-right">  @include('categories.categories')</div>
        </div>
    </div>
@endsection
