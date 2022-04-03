<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ResetPassRequest;
use App\Http\Traits\ApiTrait;
use App\Jobs\ResetPassJob;
use App\Models\PasswordReset;
use App\Models\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class ForgotPasswordController extends Controller
{
    use ApiTrait;

    public function postForgotPass(Request $request){
        try {
/*            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return "mada";
            //    return $this->jsonResponseWithoutMessage($validator->errors(), 'data', 500);
               // return $this->returnError('E001',$validator->errors());
            }*/
            return $request->email;
           return  $user = User::whereEmail($request->email)->first();
            if(!$user){
                return $this->returnError('404','This E-mail is not in our record');
            }
            $resetPassToken = PasswordReset::whereEmail($request->email)->first();
            if($resetPassToken){
                $resetPassToken->delete();
            }
            $resetPassToken = PasswordReset::create([
                'email' => $request->email,
                'token' => rand(1231,7879)
            ]);
            $on = Carbon::now()->addSeconds(2.5);
            dispatch(new ResetPassJob($user,$resetPassToken))->delay($on);
            return $this->returnError('200','code was sent successfully');
        }catch (\Exception $ex){
            return $ex;
            return $this->returnError('405','Something went wrong');
        }
    }

    public function resetPassword($code){
        $token = PasswordReset::whereToken($code)->first();
        if($token){
            return $this->returnError('200','Valid code');
        }
        return redirect()->route('site.forgetPass')->with('error', 'Invalid code');
    }

    public function changePass(ResetPassRequest $request){
        $token = PasswordReset::whereToken($request->token)->first();
        if(!$token){
            return redirect()->back()->with(['error'=>'Invalid Token']);
        }
        $email = $token->email;
        $user = User::whereEmail($email)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        $token->delete();
        $userAuth= Auth::login($user);
        return redirect()->route('home');
    }

}
