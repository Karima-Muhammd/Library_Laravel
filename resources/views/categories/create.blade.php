@extends('layouts.app')

@section('title')
    Create Category
@endsection
@section('content')

    <div class="col-md-7 offset-md-3 mt-5">
        <h2 class="text-center" style="color:#002752; font-family: 'Tempus Sans ITC',fantasy">Create Category </h2>

        <form class="mt-5" id="create_cate">
            @csrf
        <div class="input-group">
            <input type="text" name="name" value="{{old('name')}}"  placeholder="Category Name .." class="form-control">
        </div>

        <div class="mt-2">
        <button type="submit" class="btn btn-primary ">Submit</button>
        </div>

    </form>
         @include('inc.errors')
        <div class="alert alert-success mt-3"  style="display: none" id="msg_success"></div>
        <div class="alert alert-danger mt-3"  style="display: none" id="msg_error"></div>

    </div>
    <div style="margin-bottom: 8.5rem"></div>
@endsection
@section('script')
    <script>
        $("#create_cate").submit(function (e)
        {
            e.preventDefault()
            $("#msg_error").hide()
            $("#msg_error").empty()

            $("#msg_success").hide()
            $("#msg_success").empty()

            let cate_date= new FormData($("#create_cate")[0])
          //  console.log(cate_date.get('name'))
            $.ajax({
                type:"POST",
                url:"{{route('store_category')}}",
                data:cate_date,
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
                         $("#msg_error").append("<p>"+ item +"</br>")

                     });
                }
            });
        });
    </script>
@endsection
