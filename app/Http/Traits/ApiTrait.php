<?php

namespace App\Http\Traits;

trait ApiTrait
{
    public function returnError($errorNum,$message)
    {
        return response()->json([
            'status' =>false,
            'errorNum' => $errorNum,
            'message'=>$message
        ]);
    }

    public function returnSuccessMessage($message="", $errorNum ="S000")
    {
        return response()->json([
            'status' =>true,
            'errorNum' => $errorNum,
            'message'=>$message
        ]);
    }

    public function returnData($key, $value,$message="")
    {
        return response()->json([
            'status' =>true,
            'errorNum' => "S000",
            'message'=>$message,
            $key=>$value
        ]);
    }

    public function returnCodeAccordingToInput($validator){
        $inputs= arrar_keys($validator->errors()->toArray());
        $code= $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function returnValidationError($code="E001",$validator){
        return $this->returnError($code,$validator->errors()->first());
    }
}


