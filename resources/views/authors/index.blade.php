@extends('layouts.app')
@section('title')
   Authors
@endsection
@section('style')
    <style>
        .section_hr
        {
            width: 5%;
            border-color:#dbcbbd;
            float: left;
            display: block;
            margin-top:0;

        }
        .author_hr
        {
            width: 40%;
            text-align: center;
            border-color:#dbcbbd;
            display: block;
            margin-bottom: 0;
            margin-top: 2px;
        }
    </style>
@endsection
@section('content')

    <div class="d-block">
    <h1 class="d-inline ">Book authors</h1>
    @auth
        @if(Auth::user()->role=='admin')
        <a  href="{{route('create_author')}}" class="badge badge-warning"> Create New Author ? </a>
        @endif
    @endauth

    </div>
    <small style="color:#dbcbbd;float: left">
        {{count($authors)}} Author
    </small>
    <br>
    <hr class="section_hr" />


    <div class="row mt-5" >
    <div class="col-lg-4 mt-5 col-sm-3 p-0 m-0 ">
        @include('categories.categories')
    </div>
    <div class="col-lg-8 col-sm-9  p-0 m-0 ">
        <div class="row ">
    @foreach($authors as $author)
        <div  id="row_auth{{$author->id}}" class=" col-lg-3 col-sm-4 p-0 m-0 ">
            <div class="card mb-2" style="width:12rem;height: 14rem; text-align: center; " >
                <a class="" href="{{route('show_authors',$author->id)}}">
                </a>
                 @if($author->img !=null)
                        <img class="img-thumbnail" style="border-radius: 50%;object-fit:fill;width: 60%;height:7rem;margin: auto; margin-top: 5px" src="{{asset("images/authors/$author->img")}}">
                    @else
                        <img class="img-thumbnail " style="border-radius: 50%;margin: auto;margin-top: 5px" height="40rem" width="100rem" src="{{asset("images/authors/no-image.jpg")}}">
                    @endif
                <p class=""><a style="color: black; text-decoration: none" href="{{route('show_authors',$author->id)}}">{{$author->name}}</a> </p>

                <div class="col-lg-12 pb-3">
                    <a  href="{{route('show_authors',$author->id)}}" class="badge badge-warning"> Details</a>
                    @auth
                        @if(Auth::user()->role=='admin')
                            <a  href="{{route('edit_author',$author->id)}}" class="badge badge-success  "> Update </a>
                            <a type="submit"  data-id="{{ $author->id }}" class="badge badge-success" onclick="deleteAuthor(event.target)"  > Delete </a>
                        @endif
                    @endauth
                        <hr class="author_hr" />
                        <p style="color :#dbcbbd; font-family: 'Agency FB'">{{count($author->book)}} Book </p>
                </div>
            </div>
        </div>
    @endforeach
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        function deleteAuthor(event) {
            var id  = $(event).data("id");
            let _url = `/authors/delete/${id}`;
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(response) {
                    $("#row_auth"+id).remove();
                }
            });
        }

    </script>
@endsection











