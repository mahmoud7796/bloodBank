<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Traits\ApiTrait;
use App\Models\Post;
use App\Models\Request;


class PostController extends Controller
{
    use ApiTrait;

    public function index()
    {
        try {
            $posts = Post::get();
            return $this->returnData('posts', PostResource::collection($posts));
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


}
