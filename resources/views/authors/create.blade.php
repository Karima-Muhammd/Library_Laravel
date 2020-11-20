@extends('layouts.app')

@section('title')
    Create Author
@endsection
@section('style')
<style>
    .progress { position:relative; width:100%; }
    .bar { background-color: #00ff00; width:0%; height:20px; }
    .percent { position:absolute; display:inline-block; left:50%; color: #040608;}

</style>
@endsection
@section('content')

    <div class="col-md-7 offset-md-3 mt-5">
        <h2 class="text-center" style="color:#002752; font-family: 'Tempus Sans ITC',fantasy">Create Author </h2>

        <form class="mt-5" id="create_author" enctype="multipart/form-data">
            @csrf
        <div class="input-group">
            <input type="text" name="name" value="{{old('name')}}"  placeholder="Author Name .." class="form-control">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Bio </span>
            </div>
            <textarea name="bio" class="form-control" placeholder="Write Author Bio ..">{{old('bio')}} </textarea>
        </div>
            <div class="input-group">
                    <input type="file" class="form-control" name="img">
            </div>

            <div class="progress">
                <div class="bar"></div >
                <div class="percent">0%</div >
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
        $("#create_author").submit(function (e)
        {
            e.preventDefault()
            $("#msg_error").hide()
            $("#msg_error").empty()

            $("#msg_success").hide()
            $("#msg_success").empty()
            var bar = $('.bar');
            var percent = $('.percent');
            let author_date= new FormData($("#create_author")[0])
            //  console.log(cate_date.get('name'))
            $.ajax({
                type:"POST",
                url:"{{route('store_author')}}",
                data:author_date,
                contentType:false,
                processData:false,
                beforeSend: function() {
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },

                success : function (data)
                {
                    $("#msg_success").show()
                    $("#msg_success").text(data.success)
                    window.location.href = SITEURL +"/"+"ajax-file-upload-progress-bar";

                },
                error : function (xhr,status,error)
                {
                    $("#msg_error").empty()
                    $("#msg_error").show()
                    $.each(xhr.responseJSON.errors,function (key,item)
                    {
                        $("#msg_error").append("<p>"+ item +"</br>")

                    });
                }
            });
        });

    </script>
@endsection
