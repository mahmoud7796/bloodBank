<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins=Admin::all();
        return view('admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdminRequest $request)
    {
       $admin= Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'password'=>bcrypt($request->password),
        ]);

        if ($request->has('profile_picture') && $request->profile_picture != null){
            $admin->profile_picture=SaveImage($request->profile_picture,'dashboard_files/admins_pictures/');
            $admin->save();
        }

        alert()->success('Admin Created Successfully' , 'Success');

        return redirect()->route('dashboard.admins.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admins.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
        ]);


        if ($request->has('password') && $request->password != null){
            $admin->password=bcrypt($request->password);
            $admin->save();
        }

        if ($request->has('profile_picture') && $request->profile_picture != null){
           deleteOldImage($admin->profile_picture,'admins_pictures');
            $admin->profile_picture=SaveImage($request->profile_picture,'dashboard_files/admins_pictures/');
            $admin->save();
        }

        alert()->success('Admin Updated Successfully' , 'Success');

        return redirect()->route('dashboard.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        deleteOldImage($admin->profile_picture,'admins_pictures');
        alert()->success('Admin Deleted Successfully' , 'Success');
        return redirect()->route('dashboard.admins.index');
    }
}
