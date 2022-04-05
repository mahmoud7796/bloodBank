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
            if (!$posts){
                return $this->returnError('404', 'Not Found');
            }
            return $this->returnData('posts', PostResource::collection($posts));
        } catch (\Exception $ex) {
            return $this->returnError('408', 'Something went wrong');
        }
    }

    public function show($postId)
    {
        try {
            $posts = Post::find($postId);
            if (!$posts){
                return $this->returnError('404', 'Not Found');
            }
            return $this->returnData('posts', new PostResource($posts));
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
                'image'=>'nullable|image',
                'admin_id'=>'required|integer',
            ]);
            if ($validator->fails()){
                return $this->returnError('E001',$validator->messages());
            }
            if($request->hasFile('image')){
                $imgPath = SaveImage($request->file('image'),'/dashboard_files/posts_pictures');
                Post::create([
                    'image' => $imgPath,
                ]);
            }
            Post::create([
                'title' => $request->title,
                'description'=>$request->description,
                'image'=>$request->image,
                'admin_id'=>$request->admin_id,
            ]);
            return $this->returnSuccessMessage('Post created successfully');
        } catch (\Exception $ex) {
           // return $ex;
            return $this->returnError('408', 'Something went wrong');
        }
    }


}
