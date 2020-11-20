@extends('layouts.app')
@section('title')
    Categories
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
        <h1 class="d-inline ">Book Sections</h1>
        @auth
            @if(Auth::user()->role=='admin')
                <a  href="{{route('create_category')}}" class="badge badge-warning"> Create New Section ? </a>
            @endif
        @endauth

    </div>
    <small  style="color:#dbcbbd;float: left">
        <span id="number_cate">{{count($categories)}}</span> Section
    </small>
    <br>
    <hr class="section_hr" />


    <div class="row mt-5" >
        <div class="col-lg-4 mt-4 col-sm-3 ">
           @include('categories.categories')

        </div>
        <div class="col-lg-8 col-sm-9">
            <div class="row ">
                @foreach($categories as $category)
                    <div  class=" col-lg-3 col-sm-4 row_category{{$category->id}} ">
                        <div class="card mb-2" style="width:10rem;height: 7rem; text-align: center; ">
                            <a class="" href="{{route('show_authors',$category->id)}}">
                            </a>
                            <p class="">
                                <a style="color: black; text-decoration: none" href="{{route('show_category',$category->id)}}">{{$category->name}}</a>
                                <br >
                            </p>
                            <div class="col-lg-12 m-0 p-0">
                                <a  href="{{route('show_category',$category->id)}}" class="badge badge-warning"> Details</a>
                                @auth
                                    @if(Auth::user()->role=='admin')
                                        <a type="submit"  data-id="{{ $category->id }}" class="badge badge-success" onclick="deleteCategory(event.target)"  > Delete </a>
                                    @endif
                           @endauth


                            <div class="col-lg-12 pb-3">
                                <hr class="author_hr" />
                                <p style="color :#dbcbbd; font-family: 'Agency FB'">{{count($category->book)}} Book </p>
                            </div>
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
        function deleteCategory(event) {
            var id  = $(event).data("id");
            let _url = `/categories/delete/${id}`;
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(response) {
                    $(".row_category"+id).remove();

                }
            });
        }
    </script>
@endsection
