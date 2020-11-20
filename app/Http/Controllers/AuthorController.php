<?php

namespace App\Http\Controllers;

use App\Author;
use App\Category;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //validation
       $result=Author::orderBy('id','Desc')->get();
       $categories=Category::get();
       return view('authors.index',[
           'authors'=>$result,
           'categories'=>$categories,
       ]);

       return redirect(route('all_authors'));

    }
    public function latest()
    {
       $result=Author::orderBy('id','Desc')->take(3)->get();
       return view('authors.latest',[
           'authors'=>$result,
       ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('authors.create');
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
            'name'=>'required|max:30|string',
            'bio'=>'required|string',
            'img'=>'required|image|mimes:jpg,jpeg,png'
        ]);
        $img=$request->img;
        $ext=$img->getClientOriginalExtension();
        $name="Author-".uniqid().".$ext";
        $img->move(public_path('images/authors/'),$name);

        Author::create([
            'name'=>$request->name,
            'bio'=>$request->bio,
            'img'=>$name,
            ]);
        return response()->json([
            'success'=>"Added Author Successfully"
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $author=Author::find($id);
        $categories=Category::get();

        return view('authors.show',[
       'author'=>$author,
        'categories'=>$categories,
    ]);
    }
    public function search($word)
    {
        $authors=Author::where('name','like',"%$word%")->get();
        return view('authors.search',[
            'authors'=>$authors,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $author=Author::find($id);
        return view('authors.edit',[
            'author'=>$author,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
            $author=Author::find($id);
            $request->validate([
                'name'=>'required|max:30|string',
                'bio'=>'required|string',
                'img'=>'nullable|image|mimes:jpg,jpeg,png'
            ]);
            $img_name=$author->img;
            if($request->hasFile('img'))
            {
                //delete  the old
                if($author->img!=null)
                    unlink(public_path("images/authors/$img_name"));

                    //update the new
                    $img=$request->img;
                    $ext=$img->getClientOriginalExtension();
                    $img_name="Author-".uniqid().".$ext";
                    $img->move(public_path('images/authors/'),$img_name);

            }
            $author->update([
                'name'=>$request->name,
                'bio'=>$request->bio,
                'img'=>$img_name,
            ]);
            return response()->json([
                'success'=>"Updated Author Successfully"
            ]);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $author=Author::find($id);
        //delete old image_name from images folder
        if($author->img!=null)
            unlink(public_path("images/authors/$author->img"));
        $author->delete();
        return response()->json();
    }
}
