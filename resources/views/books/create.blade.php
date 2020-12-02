@extends('layouts.app')

@section('title')
    Create Book
@endsection
@section('content')

    <div class="col-md-8 offset-md-2 mt-5 pb-5">
        <h2 class="text-center" style="color:#002752; font-family: 'Tempus Sans ITC',fantasy">Add a Book </h2>

        <form class="mt-3" id="create_book">
            @csrf
    <div class="row">
        <div class="input-group col-md-6 mt-2">
            <input type="text" value="{{old('name')}}" name="name" placeholder="Book Name .." class="form-control">
        </div>
        <div class="input-group col-md-6">
            <input type="text" name="price" value="{{old('price')}}" placeholder="Book price .." class="form-control">
        </div>
        <div class="input-group col-md-6 mt-2">
            <div class="input-group-prepend">
                <label class="input-group-text"  for="inputGroupSelect01">Choose Author</label>
            </div>
            <select name="author_id" class="custom-select" id="inputGroupSelect01">
               @foreach($authors as $author)
                <option value="{{$author->id}}">{{$author->name}}</option>
                @endforeach
            </select>
        </div>
            <div class="input-group col-md-6 mt-2">
            <div class="input-group-prepend">
                <label class="input-group-text"  for="inputGroupSelect01">Choose Section</label>
            </div>
            <select name="category_id" class="custom-select" id="inputGroupSelect01">
               @foreach($Categories as $Category)
                <option value="{{$Category->id}}">{{$Category->name}}</option>
                @endforeach
            </select>
        </div>

            <div class="input-group col-md-12 mt-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Description</span>
            </div>
            <textarea name="desc"  class="form-control" placeholder="Write Book Description ..">{{old('desc')}}</textarea>
        </div>
            <div class="input-group col-md-6 mt-2">
                <span class="mt-2 mr-1">Image : </span>   <input type="file" value="{{old('img')}}" class="form-control" name="img">
            </div>
            <div class="input-group col-md-6 mt-2">
                   <span class="mt-2 mr-1"> Pdf : </span> <input type="file"  class="form-control" name="pdf">
            </div>

            <div class="mt-4 col-md-6 offset-4">
        <button type="submit" style="width: 15rem" class="btn btn-success">Save</button>
        </div>

      </div>
    </form>
        <div class="alert alert-success mt-3"  style="display: none" id="msg_success"></div>
        <div class="alert alert-danger mt-3"  style="display: none" id="msg_error"></div>
        @include('inc.errors')

    </div>
@endsection
@section('script')
    <script>
        $("#create_book").submit(function (e)
        {
            e.preventDefault()
            $("#msg_error").hide()
            $("#msg_error").empty()

            $("#msg_success").hide()
            $("#msg_success").empty()

            let book_date= new FormData($("#create_book")[0])
            //  console.log(cate_date.get('name'))
            $.ajax({
                type:"POST",
                url:"{{route('store_book')}}",
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
                    $("#msg_success").empty()
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
