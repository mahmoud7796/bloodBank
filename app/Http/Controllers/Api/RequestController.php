<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RequestResource;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiTrait;
use App\Models\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Carbon;


class RequestController extends Controller
{
    use ApiTrait;

    public function index()
    {
        try {
            $date = new Carbon;
            $request = Request::where('request_expiredDate', '>', $date )->with('city','governorate','user')->get();
            if (!$request){
                return $this->returnError('404', 'Not Found');
            }
            return $this->returnData('request', RequestResource::collection($request));
        } catch (\Exception $ex) {
            return $this->returnError('408', 'Something went wrong');
        }
    }

    public function store(\Illuminate\Http\Request $request)
    {
        try {
            $validator = \Validator::make($request->all(),[
                'title' => 'required|string|max:255',
                'description'=>'required|string',
                'phone_number'=>'required|string|max:255',
                'no_of_bags'=>'required|integer',
                'request_expiredDate'=>'date',
                'blood_type'=>'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
                'governorate_id'=>'required',
                'city_id'=>'required',
                'user_id'=>'required',
            ]);
            if ($validator->fails()){
                return $this->returnError('E001',$validator->messages());
            }
            Request::create([
                'title' => $request->title,
                'description'=>$request->description,
                'phone_number'=>$request->phone_number,
                'no_of_bags'=>$request->no_of_bags,
                'request_expiredDate'=>$request->request_expiredDate,
                'blood_type'=>$request->blood_type,
                'governorate_id'=>$request->governorate_id,
                'city_id'=>$request->city_id,
                'user_id'=>$request->user_id,
            ]);
            return $this->returnSuccessMessage('Your request created successfully');
        } catch (\Exception $ex) {
            return $this->returnError('408', 'Something went wrong');
        }
    }

    public function show($requestId)
    {
        try {
             $request = Request::find($requestId);
            if(!$request){
                return $this->returnError('404', 'Not found');
            }
            if (Auth::id() !== $request->user_id) {
                return $this->returnError('501', 'Not Authorized');
            }
            return $this->returnData('request', new RequestResource($request));
        } catch (\Exception $ex) {
            //return $ex;
            return $this->returnError('408', 'Something went wrong');
        }
    }

    public function destroy($requestId)
    {
        try {
            $request = Request::find($requestId);
            if(!$request){
                return $this->returnError('404', 'Not found');
            }
            if (Auth::id() !== $request->user_id) {
                return $this->returnError('501', 'Not Authorized');
            }
            $request->delete();
            return $this->returnSuccessMessage('Your request deleted successfully');
        } catch (\Exception $ex) {
            //return $ex;
            return $this->returnError('408', 'Something went wrong');
        }
    }

    public function userRequest($userid)
    {
        try {
            $request = Request::whereUserId($userid)->with('city','governorate')->get();
            if (!$request){
                return $this->returnError('404', 'Not Found');
            }
            $user = User::whereId($userid)->first();
            if (!$user){
                return $this->returnError('404', 'Not Found');
            }
            $requestUserId = Request::whereUserId($userid)->first();
            if (Auth::id() !== $requestUserId->user_id) {
                return $this->returnError('501', 'Not Authorized');
            }
            $success['requests'] = RequestResource::collection($request);
            $success['user'] = new UserResource($user);
            return $this->returnData('request', $success);
        } catch (\Exception $ex) {
            // return $ex;
            return $this->returnError('408', 'Something went wrong');
        }
    }



}
