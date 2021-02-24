@extends('layouts.app')
@section('background')
<img style="width: 84.3rem" src="{{asset('images/3023.jpg')}}">
@endsection
@section('title')
     Books
@endsection
@section('content')
    <h1 style="font-family: 'Agency FB';@if(app()->getLocale()=='ar') font-family: 'Rakkas', cursive; @endif  " class="d-inline ">{{__('Most Popular')}}</h1>
    @auth
        @if(Auth::user()->role=='admin')
        <a  href="{{route('create_book')}}" class="badge badge-warning">{{__('Create New book ?')}}  </a>
        @endif
   @endauth
    <hr>
    <div class="row book_container ">
       @foreach($books as $book)
        <div   class=" col-lg-3 mb-1 row_book{{$book->id}}">
            <div class="card" >

                @if($book->img !=null)
                    <img style="width: 100%;height:25vw;object-fit:fill;" class="img-thumbnail d-block" src="{{asset("images/books/$book->img")}}">
                @else
                    <img class="img-thumbnail d-block" height="100px"  src="{{asset("images/books/no-image.jpg")}}">
                @endif
                <div class="card-body">
                    <div class="col-lg-12 p-0">
                    <p class="badge badge-pill">{{__('By')}}: <a href="{{route('show_authors',$book->author_id)}}">{{$book->author->name}}</a></p>
                    </div>
                    <div class="col-lg-12 p-0">
                        <a  href="{{route('show_books',$book->id)}}" class="badge badge-warning ml-1"> {{__('Details')}}</a>
                        <a  href="{{route('viewPDF',$book->id)}}" class="badge badge-primary ml-1">{{__('Read')}}  </a>
                        <a  href="{{route('Download',$book->id)}}" class="badge badge-success ml-1"> {{__('Download')}} </a>
                        @auth
                            @if(Auth::user()->role=='admin')
                                <a  href="{{route('edit_book',$book->id)}}" class="badge badge-success  "> {{__('Update')}} </a>
                                <a style="padding: 7px" type="submit"  data-id="{{ $book->id }}" class="badge badge-danger" onclick="deleteBook(event.target)"  >{{__('Delete')}}  </a>
                            @endif
                        @endauth
                    </div>
                </div>
          </div>
        </div>
     @endforeach

        <hr>


        <div class="col-lg-12 mt-5 " >
            <div style="margin-left: 40%" >
            {{ $books->render() }}
            </div>
        </div>
    </div>
    <br>
    <h1 style="font-family: 'Agency FB';@if(app()->getLocale()=='ar') font-family: 'Rakkas', cursive; @endif  " class="d-inline ">{{__('Recent books')}}</h1>
    <hr>
    <div class="row">
        @foreach($recent as $book)
            <div  class="row_book{{$book->id}} col-lg-3">
                <div class="card" >

                    @if($book->img !=null)
                        <img style="width: 100%;height:25vw;object-fit:fill;" class="img-thumbnail d-block" src="{{asset("images/books/$book->img")}}">
                    @else
                        <img class="img-thumbnail d-block" height="100px"  src="{{asset("images/books/no-image.jpg")}}">
                    @endif
                    <div class="card-body">
                        <div class="col-lg-12 p-0">
                            <p class="badge badge-pill text-center">{{__('By')}} : <a href="{{route('show_authors',$book->author_id)}}">{{$book->author->name}}</a></p>
                        </div>
                        <div class="col-lg-12 p-0">
                            <a  href="{{route('show_books',$book->id)}}" class="badge badge-warning"> {{__('Details')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



@endsection
@section('script')
    <script>
        function deleteBook(event) {
            var id  = $(event).data("id");
            let _url = `/books/delete/${id}`;
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(response) {
                    $(".row_book"+id).remove();
                }
            });
        }

    </script>
@endsection

@section('scripts')

@endsection








