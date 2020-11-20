@extends('layouts.app')

@section('title')
    Update Book {{$book->name}}
@endsection
@section('content')
    <div class="col-md-8 offset-md-2 mt-3 pb-5">
        <h2 class="text-center" style="color:#002752; font-family: 'Tempus Sans ITC',fantasy">Update Book </h2>

           <form class="mt-3" id="editBook" data-id="{{ $book->id }}"  enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <input type="text" name="name" value="{{old('name',$book->name)}}" placeholder="Book Name .." class="form-control">
            </div>

            <div class="form-group col-md-6">
                <input type="text" name="price" value="{{old('price',$book->price)}}"  placeholder="Book Price .." class="form-control">
            </div>
            <div class="form-group col-md-6">
                <select name="author_id" class="custom-select" id="inputGroupSelect01">
                    @foreach($authors as $author)
                        <option value="{{$author->id}}" @if($author->id==$book->author_id) selected @endif() >{{$author->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <select name="category_id" class="custom-select" id="inputGroupSelect01">
                    @foreach($categories as $cate)
                        <option value="{{$cate->id}}" @if($cate->id==$book->category_id) selected @endif() >{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group col-md-12">
                <div class="input-group-prepend">
                    <span class="input-group-text">Description</span>
                </div>
                <textarea name="desc" class="form-control" placeholder="Write Book Description  ..">{{old('desc',$book->desc)}}</textarea>
            </div>
            <div class="col-md-12 mt-2">
                <div class="row">
                    <div class="col-md-3">
                            @if($book->img !=null)
                                <img class="img-thumbnail d-inline " height="40rem" width="200rem" src="{{asset("images/books/$book->img")}}">
                            @else
                                <img class="img-thumbnail d-inline " height="40rem" width="100rem" src="{{asset("images/books/no-image.jpg")}}">
                            @endif
                    </div>
                    <div class="col-md-9 mt-3">
                        <label class=" mr-1 d-block ">Image : </label>   <input type="file"  class="form-control " name="img">
                        <span class="mt-5 mr-1"> Pdf : </span> <input type="file"   class="form-control" name="pdf">
                        <button type="submit" style="width: 15rem; margin-left: 18rem" class="btn btn-success mt-5 " >Update</button>

                    </div>

            </div>

      </div>
        </div>
            <div class="input-group col-md-6 offset-3 mt-3 text-center">

            </div>
        </form>

        <div class="alert alert-success mt-3"  style="display: none" id="msg_success"></div>
        <div class="alert alert-danger mt-3"  style="display: none" id="msg_error"></div>

    </div>

@endsection
@section('script')
    <script>
        $("#editBook").submit(function (e)
        {

            e.preventDefault()
            $("#msg_error").hide()
            $("#msg_error").empty()

            $("#msg_success").hide()
            $("#msg_success").empty()

            let book_date= new FormData($("#editBook")[0])
            var id  = $("#editBook").data("id");
            let _url = `/books/update/${id}`;
            //  console.log(cate_date.get('name'))
            $.ajax({
                type:"POST",
                url:_url,
                data:book_date,
                contentType:false,
                processData:false,
                success : function (data)
                {
                    $("#msg_success").show()
                    $("#msg_success").text(data.success)

                },
                error : function (xhr,status,error)
                {
                    $("#msg_error").empty()
                    $("#msg_error").show()
                    $.each(xhr.responseJSON.errors,function (key,item)
                    {
                        $("#msg_error").append("<p>"+ item +"</p>")

                    });
                }
            });
        });

    </script>
@endsection
