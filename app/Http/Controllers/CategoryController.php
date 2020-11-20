<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //validation
        $result=Category::orderBy('id','Desc')->get();
        return view('categories.index',[
            'categories'=>$result,
        ]);

        return redirect(route('all_categories'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
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
        ]);
        Category::create($request->all());
        return response()->json([
            'success'=>"Added Section Successfully"
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $category=Category::find($id);
        return view('categories.show',[
            'category'=>$category,
        ]);
    }
//    public function search($word)
//    {
//        $categorys=Category::where('name','like',"%$word%")->get();
//        return view('categorys.search',[
//            'categorys'=>$categorys,
//        ]);
//    }
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Category  $category
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
//     */
//    public function edit($id)
//    {
//        $category=Category::find($id);
//        return view('categorys.edit',[
//            'category'=>$category,
//        ]);
//
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Category  $category
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
//     */
//    public function update(Request $request,$id)
//    {
//        $category=Category::find($id);
//        $request->validate([
//            'name'=>'required|max:30|string',
//            'bio'=>'required|string',
//            'img'=>'nullable|image|mimes:jpg,jpeg,png'
//        ]);
//        $img_name=$category->img;
//        if($request->hasFile('img'))
//        {
//            //delete  the old
//            if($category->img!=null)
//                unlink(public_path("images/categorys/$img_name"));
//
//            //update the new
//            $img=$request->img;
//            $ext=$img->getClientOriginalExtension();
//            $img_name="Category-".uniqid().".$ext";
//            $img->move(public_path('images/categorys/'),$img_name);
//
//        }
//        $category->update([
//            'name'=>$request->name,
//            'bio'=>$request->bio,
//            'img'=>$img_name,
//        ]);       return redirect(route('all_categorys'));
//
//
//
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Category  $category
//     * @return \Illuminate\Http\RedirectResponse
//     */
    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        return response()->json([
            'success'=>"Deleted"
        ]);
    }
}
