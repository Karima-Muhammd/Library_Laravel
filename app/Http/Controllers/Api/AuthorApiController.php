<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Author;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AuthorApiController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $authors=Author::get();
        if($authors)
            return $this->returnData('Successfully Return','Authors',$authors);
        else
            return  $this->returnError('Faild to get Authors');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                //validation_rules
                'name'=>'required|max:30|string',
                'bio'=>'required|string',
                'img'=>'required|image|mimes:jpg,jpeg,png'
            ]);
        if($validator->fails())
        {
            return response()->json([
                'errors'=>$validator->errors()
            ]);
        }
        $img=$request->img;
        $ext=$img->getClientOriginalExtension();
        $name="Author-".uniqid().".$ext";
        $img->move(public_path('images/authors/'),$name);

        $author=Author::create([
            'name'=>$request->name,
            'bio'=>$request->bio,
            'img'=>$name,
        ]);
        return $this->returnData('Successfully created Author','The New Author',$author);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $author=Author::with('book')->find($id);
        if($author)
            return $this->returnData('Successfully Return','Author',$author);
        else
            return  $this->returnError('Faild to get Author');

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

        $author=Author::find($id);
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:30|string',
            'bio'=>'required|string',
            'img'=>'nullable|image|mimes:jpg,jpeg,png'
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()
            ]);
        }
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

        return $this->returnData('Successfully updated Author','Author',$author);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $author=Author::find($id);
        //delete old image_name from images folder
        if($author->img!=null)
            unlink(public_path("images/authors/$author->img"));
        $author->delete();
        return $this->returnSuccess('Successfully deleted author');
    }
}
