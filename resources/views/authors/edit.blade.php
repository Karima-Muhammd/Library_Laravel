@extends('layouts.app')

@section('title')
    Update Author {{$author->name}}
@endsection
@section('content')

    <div class="col-md-7 offset-md-3 mt-5">
        <h2 class="text-center" style="color:#002752; font-family: 'Tempus Sans ITC',fantasy">Update Author </h2>
        <form class="mt-5" id="editAuthor" data-id="{{ $author->id }}"  enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="name" value="{{old('name',$author->name)}}" placeholder="Author Name .." class="form-control">
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Bio </span>
                </div>
                <textarea name="bio" class="form-control" placeholder="Write Author Bio ..">{{old('bio',$author->bio)}}"</textarea>
            </div>
            @if($author->img !=null)
                <img class="img-thumbnail d-inline " height="40rem" width="200rem" src="{{asset("images/authors/$author->img")}}">
            @else
                <img class="img-thumbnail d-inline " height="40rem" width="100rem" src="{{asset("images/authors/no-image.jpg")}}">
            @endif
            <div class="input-group d-inline">
                <input type="file"  name="img">
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <div class="alert alert-success mt-3"  style="display: none" id="msg_success"></div>
        <div class="alert alert-danger mt-3"  style="display: none" id="msg_error"></div>

    </div>

@endsection
@section('script')
    <script>
        $("#editAuthor").submit(function (e)
        {
            e.preventDefault()
            $("#msg_error").hide()
            $("#msg_error").empty()

            $("#msg_success").hide()
            $("#msg_success").empty()

            let author_date= new FormData($("#editAuthor")[0])
            var id  = $("#editAuthor").data("id");
            let _url = `/authors/update/${id}`;

            $.ajax({
                type:"POST",
                url:_url,
                data:author_date,
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

