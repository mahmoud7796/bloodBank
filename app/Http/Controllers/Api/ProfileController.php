<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiTrait;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    use ApiTrait;

    public function index()
    {
        $authUser = Auth::id();
        $user = User::with('governorate', 'city')->get();
        return $this->returnData('user', UserResource::collection($user));
    }

    public function citiesByGovernorateId($id)
    {

    }
}
