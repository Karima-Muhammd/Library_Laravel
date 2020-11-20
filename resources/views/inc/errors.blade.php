@if($errors->any)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger my-1 pb-1 pt-1">
            <li style="list-style-type: none" class="p-0">{{$error}}</li>
        </div>
    @endforeach
@endif
