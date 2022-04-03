<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ResetPassRequest;
use App\Http\Traits\ApiTrait;
use App\Jobs\ResetPassJob;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ForgotPasswordController extends Controller
{
    use ApiTrait;

    public function postForgotPass(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
            if ($validator->fails()) {
                return $this->returnError('E001', $validator->messages());
            }
            $user = User::whereEmail($request->email)->first();
            if (!$user) {
                return $this->returnError('404', 'This E-mail is not in our record');
            }
            $resetPassToken = PasswordReset::whereEmail($request->email)->first();
            if ($resetPassToken) {
                $resetPassToken->delete();
            }
            $resetPassToken = PasswordReset::create([
                'email' => $request->email,
                'token' => rand(1231, 7879)
            ]);
            $on = Carbon::now()->addSeconds(2.5);
            dispatch(new ResetPassJob($user, $resetPassToken))->delay($on);
            return $this->returnSuccessMessage('code was sent successfully', 200);
        } catch (\Exception $ex) {
          //  return $ex;
            return $this->returnError('405', 'Something went wrong');
        }
    }

    public function resetPassword($code)
    {
        $token = PasswordReset::whereToken($code)->first();
        if ($token) {
            return $this->returnSuccessMessage('Valid code', 200);
        }
        return $this->returnError('501', 'Invalid code');
    }

    public function changePass(ResetPassRequest $request)
    {
        $code = $request->code;
        if(!$code){
            return $this->returnError('501', 'code is required');
        }
        $token = PasswordReset::whereToken($code)->first();
        if (!$token) {
            return $this->returnError('501', 'Invalid code');
        }
        $email = $token->email;
        $user = User::whereEmail($email)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        $token->delete();
        return $this->returnSuccessMessage('Password changed successfully', 200);
    }

}
