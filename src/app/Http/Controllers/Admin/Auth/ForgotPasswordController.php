<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Auth\UpdatePasswordRepository as AuthUpdatePasswordRepository;
use App\Http\Repositories\Eternal\GeneralRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use App\Http\Utility\SendMailUtility;
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
        return view('admin.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request){

        $request->validate([
            'email' => 'required|email|exists:admins,email'
        ],
        [
            'email.required' => 'The Email Field Is Required',
            'email.email' => 'Input Data Must Be An Email',
            'email.exists' => 'Email address Does Not Exists',
        ]);
        $token  = token(60);
        AuthUpdatePasswordRepository::tokenInsert($token,$request->email);

        $details = [
            'view' => 'mail.resetPassword',
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
