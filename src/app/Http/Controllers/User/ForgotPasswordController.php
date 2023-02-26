<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\User\Auth\UpdatePasswordRepository;
use App\Http\Utility\SendMailUtility;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    public function showLinkRequestForm()
    {
        return view('user.auth.password.email');
    }

    public function sendResetLinkEmail(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ],
        [
            'email.required' => 'The Email Field Is Required',
            'email.email' => 'Input Data Must Be An Email',
            'email.exists' => 'Email address Does Not Exists',
        ]);
        $token  = token(60);
        UpdatePasswordRepository::tokenInsert($token,$request->email);

        $details = [
            'view' => 'mail.user.resetPassword',
            'from' => getMailFromAddress(),
            'subject'=> decode('Reset Password'),
            'title' => decode('Reset Password'),
            'message'=>decode('We received a passord request mail thats why we send you a password request link'),
            'body' => decode('test body for reset password'),
            'token'=> $token,
            'buttonText'=> decode('Reset Password button'),
        ];
        $response  =  SendMailUtility::sendMail($details,$request->email);
        if($response == "failed"){
            $success = 'error';
            $message = 'Mail Config Failed';
        }
        else{
            $success ='success';
            $message = 'Reset link Successfully send';
        }
        return back()->with($success, decode($message));
    }
}
