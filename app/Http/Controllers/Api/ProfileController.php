<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiTrait;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;


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


    public function update(Request $request,$userId)
    {
        try {
            $validator=\Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email'=>'required|email|string|max:255',
                'phone_number'=>'nullable|string|max:255',
                'profile_picture'=>'nullable|image',
                'password'=>'required|string|max:255|confirmed',
                'date_of_birth'=>'date',
                'last_donate_time'=>'nullable',
                'blood_type'=>'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
                'governorate_id'=>'required',
                'city_id'=>'required',
                'available_for_donate'=>'nullable',
            ]);

            if ($validator->fails()){
                return $this->returnError('E001',$validator->messages());
            }

            $user = User::find($userId);
            if(!$user){
                return $this->returnError('404', 'Not found');
            }
            $authUser = Auth::id();
            if($authUser!=$userId){
                return $this->returnError('502', 'Not authorized');
            }
            DB::beginTransaction();
            if($request->hasFile('profile_picture')){
                deleteOldImage($user->profile_picture,'users_pictures');
                $imgPath = SaveImage($request->file('profile_picture'),'/dashboard_files/users_pictures');
                $user->update([
                    'profile_picture' => $imgPath,
                ]);
            }
            $availableForDonate= checkIfDonorAvailableForDonateRequest($request->available_for_donate);
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone_number'=>$request->phone_number,
                'password'=>bcrypt($request->password),
                'date_of_birth'=>$request->date_of_birth,
                'blood_type'=>$request->blood_type,
                'governorate_id'=>$request->governorate_id,
                'city_id'=>$request->city_id,
                'last_donate_time'=>$request->last_donate_time,
                'available_for_donate'=>$availableForDonate,
            ]);
            DB::commit();
            return $this->returnSuccessMessage('Your info updated successfully');
        } catch (\Exception $ex) {
            DB::rollBack();
            // return $ex;
            return $this->returnError('408', 'Something went wrong');
        }
    }

    public function changePhoto(Request $request,$userId)
    {
        try {
            $validator=\Validator::make($request->all(),[
                'profile_picture'=>'nullable|image|mimes:jpg,jpeg,png',
            ]);

            if ($validator->fails()){
                return $this->returnError('E001',$validator->messages());
            }
            $user = User::find($userId);
            if(!$user){
                return $this->returnError('404', 'Not found');
            }
            $authUser = Auth::id();
            if($authUser!=$userId){
                return $this->returnError('502', 'Not authorized');
            }
            if($request->hasFile('profile_picture')){
                deleteOldImage($user->profile_picture,'users_pictures');
                $imgPath = SaveImage($request->file('profile_picture'),'/dashboard_files/users_pictures');
                $user->update([
                    'profile_picture' => $imgPath,
                ]);
            }
            return $this->returnSuccessMessage('Your photo updated successfully');
        } catch (\Exception $ex) {
            DB::rollBack();
            // return $ex;
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
                return $this->returnSuccessMessage('Your password changed successfully');
            }else{
                return $this->returnError('408', 'Old password is incorrect');
            }

        }catch (\Exception $ex){
           // return $ex;
            return $this->returnError('408', 'Something error please try again later');
        }
    }

    public function changeAvailableForDonate(Request $request)
    {
        try {
            $authId = Auth::id();
            $user = User::find($authId);
             $availableForDonate= checkIfDonorAvailableForDonateRequest($request->available_for_donate);
            $user->update([
               'available_for_donate' =>$availableForDonate
            ]);
            return $this->returnSuccessMessage('availability changed successfully');
        } catch (\Exception $ex) {
            return $this->returnError('408', 'Something went wrong');
        }
    }
}
