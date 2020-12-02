<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $result=Category::orderBy('id','Desc')->get();
        return $this->returnData('success Request','Categories',$result);

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request->img img elesm bt3 el db
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:30|string',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'errors'=>$validator->errors()
            ]);
        }

        $categ=Category::create($request->all());
        return $this->returnData('Successfully Added','Category',$categ);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return $this->returnData('Successfully Return','Category',$category);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        return $this->returnSuccess('Successfully Deleted');

    }
}
