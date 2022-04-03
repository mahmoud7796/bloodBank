<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiTrait;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    use ApiTrait;

    public function index()
    {
        try {
            $user = User::with('governorate', 'city')->get();
            if (!$user) {
                return $this->returnError('404', 'Request not found');
            }
            return $this->returnData('user', UserResource::collection($user));

        } catch (\Exception $ex) {
            return $this->returnError('408', 'Something went wrong');
        }
    }

    public function show($userId)
    {
        try {
             $authUser = Auth::id();
            if($authUser!=$userId){
                return $this->returnError('502', 'Not authorized');
            }
            $user = User::whereId($authUser)->get();
            return $this->returnData('user', UserResource::collection($user));
        } catch (\Exception $ex) {
            return $this->returnError('408', 'Something went wrong');
        }
    }

    public function changePassword(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(),[
                "password"=>"required|confirmed|string",
                "oldPassword"=>"required|string"
            ]);
            if ($validator->fails()){
                return $this->returnError('E001',$validator->messages());
            }
            $currentPass = Auth::user()->password;
            if (Hash::check($request->oldPassword, $currentPass)) {
                $user = User::find(Auth::id());
                $user -> password = Hash::make($request->password);
                $user -> save();

                return response()->json([
                    'status' => true,
                    'msg' => 'Your password changed successfully',
                ]);
            }else{
                return $this->returnError('408', 'Old password is incorrect');
            }

        }catch (\Exception $ex){
            return $ex;
            return $this->returnError('408', 'Something error please try again later');
        }
    }
}
