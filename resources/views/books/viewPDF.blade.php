@auth
@if(Auth::user()->role=='user')

@extends('layouts.app')
@section('content')
    <h3 style="font-family: 'Piedra', cursive" class="text-center mt-5">Enjoy with Reading</h3>
    <div id="pdf-viewer"></div>

    @csrf
@endsection

@section('script')
    PDFObject.embed("{{ route('viewPDF', ['id' => $book->id]) }}", "#pdf-viewer");
@endsection

@endif
@endauth
