<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    use ApiTrait;

    public function authenticate(Request $request){
        $rules=[
            "email" => "required|exists:users,email",
            "password"=>"required"
        ];
        $validator = \Validator::make($request->all(),$rules);

        if ($validator->fails()){
            return $this->returnError('E001',$validator->messages());
        }

        $credentials = $request->only(['email', 'password']);

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->returnError('400',__('invalid_credentials'));
            }
        } catch (JWTException $e) {
            return $this->returnError('500',__('could_not_create_token'));
        }

        $user= auth()->user();
        $user->token=$token;

        //return response()->json(compact('token'));
        return $this->returnData('user',$user);

    }


    public function register(Request $request){
        try{
            $rules=[
                'name' => 'required|string|max:255',
                'email'=>'required|email|string|max:255|unique:users',
                'phone_number'=>'required|string|max:255|unique:users',
                'profile_picture'=>'nullable|image',
                'password'=>'required|string|max:255|confirmed',
                'date_of_birth'=>'date',
                'last_donate_time'=>'nullable',
                'blood_type'=>'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
                'governorate_id'=>'required',
                'city_id'=>'required',
                'available_for_donate'=>'nullable',
            ];

            $validator=\Validator::make($request->all(),$rules);

            if ($validator->fails()){
                return $this->returnError('E001',$validator->messages());
            }

            $user= User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone_number'=>$request->phone_number,
                'password'=>bcrypt($request->password),
                'date_of_birth'=>$request->date_of_birth,
                'blood_type'=>$request->blood_type,
                'governorate_id'=>$request->governorate_id,
                'city_id'=>$request->city_id,
                'last_donate_time'=>$request->last_donate_time,
                'available_for_donate'=> 1,
            ]);

            $user->token=JWTAuth::fromUser($user);
            return $this->returnData('user',$user);

        }catch (\Exception $ex){
            return $ex;
        }
    }


    public function logout(Request $request){
        $token = $request->bearerToken();
        if ($token){
            try {
                JWTAuth::setToken($token)->invalidate(); //logout
                return $this->returnSuccessMessage('Logged out successfully');
            }catch (TokenInvalidException $e){
                    return $this->returnError('','Something Went Wrong');
            }

        }else{
            $this -> returnError('','Token invalid');
        }
    }
}
