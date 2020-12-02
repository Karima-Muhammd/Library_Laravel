<?php
namespace App\Traits;
trait GeneralTrait
{
    public function returnError($msg)
    {
        return response()->json([
           'status'=>false,
            'msg'=> $msg,

        ]);
    }
    public function returnSuccess($msg)
    {
        return response()->json([
           'status'=>true,
            'msg'=> $msg,
        ]);
    }
    public function returnData($msg,$key,$value)
    {
        return response()->json([
            'status'=>true,
            'msg'=> $msg,
             $key=>$value
        ]);
    }

}
