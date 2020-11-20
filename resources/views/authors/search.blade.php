
@extends('layouts.app')
@section('title')
    Search Authors
@endsection
@section('content')

<h1>Result Search</h1>

@foreach($authors as $author)
    <li>ID : {{$author->id}}</li>
    <li>Name :{{$author->name}}</li>
    <li>Description :{{$author->bio}}</li>
    <hr>
@endforeach

@endsection


