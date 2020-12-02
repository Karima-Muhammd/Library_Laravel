<?php

namespace App\Http\Controllers\Api;
use App\Category;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $books=Book::get();
       return $this->returnData('Success Request','Books',$books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:40|string',
            'price'=>'required|numeric',
            'author_id'=>'required',
            'category_id'=>'required',
            'desc'=>'required|string',
            'img'=>'required|image|mimes:jpg,jpeg,png',
            'pdf'=>'required|file|mimes:pdf|max:50000',

        ]);
        if($validator->fails())
        {
            return response()->json([
                'errors'=>$validator->errors()
            ]);
        }


        $pdf=$request->file('pdf');
        $ext=$pdf->getClientOriginalExtension();
        $file_name="Book".uniqid().".$ext";
        $pdf->move(public_path('pdf/'),$file_name);


        $img=$request->img;
        $ext=$img->getClientOriginalExtension();
        $img_name="Book-".uniqid().".$ext";
        $img->move(public_path('images/books/'),$img_name);

        $book= Book::create([
            'name'=>$request->name,
            'desc'=>$request->desc,
            'price'=>$request->price,
            'author_id'=>$request->author_id,
            'category_id'=>$request->category_id,
            'img'=>$img_name,
            'pdf'=>$file_name,
        ]);

        return $this->returnData('Added Book Successfully','Book',$book);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $book=Book::find($id);
        return  $this->returnData('Success Return','Book',$book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book=Book::find($id);
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:100|string',
            'desc'=>'required|string',
            'price'=>'required|numeric',
            'author_id'=>'required',
            'category_id'=>'required',
            'img'=>'image|mimes:jpg,jpeg,png',
            'pdf'=>'file|mimes:pdf|max:50000',

        ]);
        if($validator->fails())
        {
            return response()->json([
                'errors'=>$validator->errors()
            ]);
        }


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
        return $this->returnData('Successfully Updated','Book',$book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book=Book::find($id);
        //delete old image_name from images folder
        if($book->img!=null)
            unlink(public_path("images/books/$book->img"));
        else if($book->pdf!=null)
            unlink(public_path("pdf/$book->pdf"));

        $book->delete();
        return $this->returnSuccess('Successfully Deleted');
    }
}
