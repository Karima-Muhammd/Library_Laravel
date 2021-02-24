<h2 style="font-family: 'Agency FB' @if(app()->getLocale()=='ar') font-family: 'Rakkas', cursive; @endif">{{__('Book Sections')}}</h2>
<small style="color: #dbcbbd;float: left">
    <span class="number_cate">{{__(count($categories))}}</span> {{__('Section')}}
</small>
<br>
<hr class="section_hr" />
<ul class="mt-3 ">
    @foreach($categories as $category)
        <a style="color: black; text-decoration: none" href="{{route('show_category',$category->id)}}">
            <li class="row_category{{$category->id}}" style="list-style-type: none; font-size: 19px; font-family: 'Agency FB'">{{ $category->name}}</li>
        </a>
    @endforeach
</ul>
<br>
<br>
