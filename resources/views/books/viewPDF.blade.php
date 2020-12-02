@auth
@if(Auth::user()->role=='user')

@extends('layouts.app')
@section('content')
    <div id="pdf-viewer"></div>
    @csrf
@endsection

@section('script')
    PDFObject.embed("{{ route('viewPDF', ['id' => $book->id]) }}", "#pdf-viewer");
@endsection

@endif
@endauth
