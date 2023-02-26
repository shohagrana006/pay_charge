<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class SocialLoginController extends Controller
{
    /**
     * socail auth redirect function
     *
     * @param Request $request
     * @param $service
     * @return void
     */
    public function redirectToOauth(Request $request, $service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * handle o auth call back
     *
     * @param $service
     * @return void
     */
    public function handleOauthCallback($service)
    {
        try {
            $userOauth = Socialite::driver($service)->stateless()->user();
        } catch (\Exception $e) {
            return back()->with('error',decode('Setup Your Social Credentail!! Then Try Agian'));
        }
        $user = User::where('email',$userOauth->email)->first();
        if(!$user){
            $newUser = new User();
            $newUser->name = $userOauth->name;
            $newUser->email = $userOauth->email;
            $newUser->oauth_id = $userOauth->id;
            $newUser->password =  passwordEncrypt($userOauth->id);
            $newUser->login_method =  $service;
            $newUser->email_verified_at = Carbon::now();
            $newUser->address = json_encode([
                "city"        => "",
                "zip_code"    => "",
                "postal_code" => "",
                "state"       => "",
                "address"     => ""
            ]);
            $newUser->save();
            Auth::guard('web')->login($newUser);
            return redirect('/user/dashboard')->with('success',decode('Login Success'));
        }
        else{
            Auth::guard('web')->login($user);
            return redirect('/user/dashboard')->with('success',decode('Login Success'));
        }
    }
}
