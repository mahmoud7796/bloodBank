<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequset;
use App\Http\Requests\User\UpdateUserRequset;
use App\Models\City;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::with(['governorate'=> function($query){
            $query->select('id','governorate_name_'.\LaravelLocalization::getCurrentLocale(). ' as governorate_name');
        }])->get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates=Governorate::select('id','governorate_name_'.\LaravelLocalization::getCurrentLocale(). ' as governorate_name')->get();
        return view('users.create',compact('governorates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequset $request)
    {
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
            'available_for_donate'=> 0,
        ]);

        if ($request->has('available_for_donate') && $request->available_for_donate != null){
            $user->available_for_donate=1;
            $user->save();
        }
        if ($request->has('profile_picture') && $request->profile_picture != null){
            $user->profile_picture=SaveImage($request->profile_picture,'dashboard_files/users_pictures/');
            $user->save();
        }

        alert()->success('User Created Successfully' , 'Success');

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $governorates=Governorate::select('id','governorate_name_'.\LaravelLocalization::getCurrentLocale(). ' as governorate_name')->get();
        //dd($user);
        return view('users.edit',compact('user','governorates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequset $request, User $user)
    {
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'date_of_birth'=>$request->date_of_birth,
            'blood_type'=>$request->blood_type,
            'governorate_id'=>$request->governorate_id,
            'city_id'=>$request->city_id,
            'last_donate_time'=>$request->last_donate_time,
        ]);

        if ($request->has('available_for_donate') && $request->available_for_donate != null){
            $user->available_for_donate=1;
            $user->save();
        }

        if ($request->has('password') && $request->password != null){
            $user->password=bcrypt($request->password);
            $user->save();
        }

        if ($request->has('profile_picture') && $request->profile_picture != null){
            deleteOldImage($user->profile_picture,'users_pictures');
            $user->profile_picture=SaveImage($request->profile_picture,'dashboard_files/users_pictures/');
            $user->save();
        }

        alert()->success('Users Updated Successfully' , 'Success');

        return redirect()->route('dashboard.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        deleteOldImage($user->profile_picture,'users_pictures');
        alert()->success('User Deleted Successfully' , 'Success');
        return redirect()->route('dashboard.users.index');
    }


    public function get_cities(Request $request){
        $cities =City::whereGovernorateId($request->governorate_id)->select('id','city_name_'.\LaravelLocalization::getCurrentLocale(). ' as city_name')->get();
       //$cities = City::all();
        return response()->json($cities);
    }
}
