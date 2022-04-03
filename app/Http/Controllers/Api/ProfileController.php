<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPassRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiTrait;
use App\Jobs\ResetPassJob;
use App\Models\PasswordReset;
use App\Models\Request;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
}
