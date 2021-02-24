<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //validation
        $result=Book::orderBy('id','desc')->paginate(8);
        $recent=Book::orderBy('id')->take(4)->get();

        return view('books.index',[
            'books'=>$result,
            'recent'=>$recent,
        ]);

    }
    public function latest()
    {
        $result=Book::orderBy('id','Desc')->take(3)->get();
        return view('books.index',[
            'books_resent'=>$result,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $authers=Author::select('name','id')->get();
        $Categories=Category::get();
        return view('books.create',[
            'authors'=>$authers,
            'Categories'=>$Categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //request->img img elesm bt3 el db
        $request->validate([
            'name'=>'required|max:40|string',
            'price'=>'required|numeric',
            'author_id'=>'required',
            'category_id'=>'required',
            'desc'=>'required|string',
            'img'=>'required|image|mimes:jpg,jpeg,png',
            'pdf'=>'required|file|mimes:pdf|max:50000',
        ]);

        $pdf=$request->file('pdf');
        $ext=$pdf->getClientOriginalExtension();
        $file_name="Book".uniqid().".$ext";
        $pdf->move(public_path('pdf/'),$file_name);


        $img=$request->img;
        $ext=$img->getClientOriginalExtension();
        $img_name="Book-".uniqid().".$ext";
        $img->move(public_path('images/books/'),$img_name);

        Book::create([
            'name'=>$request->name,
            'desc'=>$request->desc,
            'price'=>$request->price,
            'author_id'=>$request->author_id,
            'category_id'=>$request->category_id,
            'img'=>$img_name,
            'pdf'=>$file_name,
        ]);
        return response()->json([
            'success'=>"Added Book Successfully",
        ]);
    }
    public function viewPDF($id)
    {

        $book=Book::find($id);
        return response()->file(public_path("pdf/".$book->pdf));

    }
    public function Download($id)
    {
        $book_info=Book::find($id);
        $file= public_path(). "/pdf/$book_info->pdf";

        $headers = array(
            'Content-Type: application/pdf',
        );
        //update number of_download
//        $number_of_downloads=$book_info->number_download;
//        if($number_of_downloads!=null)
//            $number_of_downloads+=1;
//        else
//            $number_of_downloads=1;

        $book_info->number_download -=1;
        $book_info->save();


        return \Response::download($file, $book_info->pdf, $headers);

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $book=Book::find($id);
        $categories=Category::get();

        return view('books.show',[
            'book'=>$book,
            'categories'=>$categories,
        ]);
    }
    public function read($id)
    {
        $book=Book::find($id);
        return view('books.read',[
            'book'=>$book,
        ]);
    }
    public function search(Request $request)
    {
        $word=$request->get('search');
        $books=Book::where('name','like',"%$word%")->get();
        return view('books.search',[
            'books'=>$books,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $book=Book::find($id);
        $authers=Author::select('name','id')->get();
        $categories=Category::get();
        return view('books.edit',[
            'book'=>$book,
            'authors'=>$authers,
            'categories'=>$categories,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
        $book=Book::find($id);
        $request->validate([
            'name'=>'required|max:100|string',
            'desc'=>'required|string',
            'price'=>'required|numeric',
            'author_id'=>'required',
            'category_id'=>'required',
            'img'=>'image|mimes:jpg,jpeg,png',
            'pdf'=>'file|mimes:pdf|max:50000',
        ]);
//        for pdf
        $file_name=$book->pdf;
        if($request->hasFile('pdf'))
        {

            //delete  the old
            if($book->pdf!=null)
                unlink(public_path("pdf/$file_name"));

            //update the new
            $pdf=$request->file('pdf');
            $ext=$pdf->getClientOriginalExtension();
            $file_name="Book-".uniqid().".$ext";
            $pdf->move(public_path('pdf/'),$file_name);


        }

        //for img
        $img_name=$book->img;
        if($request->hasFile('img'))
        {
            //delete  the old
            if($book->img!=null)
                unlink(public_path("images/books/$img_name"));

                //update the new
            $img=$request->img;
            $ext=$img->getClientOriginalExtension();
            $img_name="Book-".uniqid().".$ext";
            $img->move(public_path('images/books/'),$img_name);

        }
        $book->update([
            'name'=>$request->name,
            'desc'=>$request->desc,
            'price'=>$request->price,
            'author_id'=>$request->author_id,
            'category_id'=>$request->category_id,
            'img'=>$img_name,
            'pdf'=>$file_name,
        ]);
        return response()->json([
            'success'=>"update book successfully",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $book=Book::find($id);
        $name=$book->img;
        //delete old image_name from images folder
        if($name!=null)
            unlink(public_path("images/books/$book->img"));
        else if($book->pdf!=null)
            unlink(public_path("pdf/$book->pdf"));

        $book->delete();
        return response()->json([
            'success'=>"Deleted"
        ]);
    }
}
