<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{



    public function __construct()
    {
        $this->middleware('guest');
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            ],
            [
                'email.required' => decode('Email is Required'),
                'email.unique' => decode('This Email is Taken!! Try Another'),
                'password.required' => decode('Password Feild is Required'),
                'password.min' => decode('Minimun 8 Char is Required  For Password'),
                'password_confirmation.required' => decode('Confiram Password Feild Is Required'),
                'password_confirmation.same' => decode('Confiram Password Does Not Match With Password'),
            ]
        );
        $user = new User();
        $user->email = $request->email;
        $user->password = passwordEncrypt($request->password);
        $user->address = json_encode(getEmptyAddress());
        $user->save();
        Auth::guard('web')->login($user);
        return redirect('/')->with('success',decode('Login Success'));
    }
}
