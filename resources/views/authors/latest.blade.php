@extends('layouts.app')
@section('title')
    {{__('Latest Authors')}}
@endsection
   @section('content')

          <h1>{{__('Latest Authors')}}</h1>

        @foreach($authors as $author)
            <p>{{$author->id}} - {{$author->name}}</p>
            <p>{{$author->bio}}</p>
            <small>{{$author->created_at}}</small>
            <hr>
       @endforeach
@endsection
