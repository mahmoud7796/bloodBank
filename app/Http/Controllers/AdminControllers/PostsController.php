<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();

        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>SaveImage($request->image,'dashboard_files/posts/'),
            'admin_id'=>auth()->id(),
        ]);

        alert()->success('Post Created Successfully' , 'Success');

        return redirect()->route('dashboard.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'admin_id'=>auth()->id(),
        ]);

        if ($request->has('image') && $request->image != null){
            deleteOldImage($post->image,'posts');
            $post->image=SaveImage($request->image,'dashboard_files/posts/');
            $post->save();
        }

        alert()->success('Post Updated Successfully' , 'Success');

        return redirect()->route('dashboard.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        deleteOldImage($post->image,'posts');
        alert()->success('Post Deleted Successfully' , 'Success');
        return redirect()->route('dashboard.posts.index');
    }
}
