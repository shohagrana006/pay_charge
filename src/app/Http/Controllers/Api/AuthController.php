<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserStoreRequest;
use App\Http\Utility\SendNotificationUtility;
use App\Mail\User\UserVerificationMail;
use App\Models\MailTemplate;
use App\Models\User;
use App\Models\UserVerifyEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(UserStoreRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = passwordEncrypt($request->password);
        $user->save();

        $userVerifyEmail = new UserVerifyEmail();
        $userVerifyEmail->email = $user->email;
        $userVerifyEmail->token = Str::random(64);
        $userVerifyEmail->save();
        $mailTemplate = MailTemplate::where('slug', 'registration-verify')->first();

        $details['message'] = decode('Just Registered');
        $details['route'] =  route('admin.user.show', $user->id);
        $details['user'] = $user->name;
        SendNotificationUtility::sendNotification($details);

        $data = [
            'user' => $user,
            'userVerifyEmail' =>$userVerifyEmail,
            'mailTemplate' => $mailTemplate,
        ];
        Mail::to($user->email)->send(new UserVerificationMail($data));
        // $user->notify(new UserVerifyRegistrationNotification($data));

        if($user->save())
        {
            return $this->ResponseWithSuccess('User registration successfully, Please verify for actived your account', 201);
        } else{
            return $this->ResponseWithError('Registration not successfully', 400);
        }
    }

    // login method
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'password' => 'required',
            'email' => 'required'
        ],[
            "password.required" => 'Password field must be required',
            "email.required" => 'Email field must be required',
        ]);

        if($validation->fails()){
            return $this->ResponseWithError($validation->errors(),422);
        }


        if(Auth::attempt(['password'=>$request->password, 'email' => $request->email])){
            $user = Auth::user();
            if($user->email_verified_at != null){
                $data['user'] = $user;
                $data['access_token'] = $user->createToken($user->name)->accessToken;
                if($user){
                    return $this->ResponseWithSuccess('User Login successfully', 200, $data);
                } else{
                    return $this->ResponseWithError('User not found',404);
                }  
            } else{
                return $this->ResponseWithError('User not activated yet',400);
            }        
        } else{
            return $this->ResponseWithError('Invalid credential', 403);
        }
        
    }


    // logout method
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->ResponseWithSuccess('Successfully Logged out', 205);
    }

    public function userAccountVerify($token)
    {
        $userVerifyEmail = UserVerifyEmail::where('token', $token)->first();
        if($userVerifyEmail){
            $user = User::where('email', $userVerifyEmail->email)->first();
            $user->email_verified_at = Carbon::now();
            $user->update();
            $data['user'] = $user;
            $data['access_token'] = $user->createToken($user->email)->accessToken;
            $userVerifyEmail->delete();

            return $this->ResponseWithSuccess('Account verified successfully', 201, $data);           
        } else {
            return $this->ResponseWithError('Your Token is Expired', 400);
        }
    }





}