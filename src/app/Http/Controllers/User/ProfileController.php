<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\User\profileRepository;
use App\Http\Requests\User\ProfileUpdateRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * constract a method
     */
  
    public $profileRepository, $user;
    public function __construct(profileRepository $profileRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->user = authUser('web');
            return $next($request);
        });
        $this->profileRepository = $profileRepository;
    }

    /**
     * profile page
     */
    public function index()
    {
        return view('user.pages.profile.index', [
            'user' => $this->user
        ]);
    }

    /**
     * update profile info
     */
    public function update(ProfileUpdateRequest $request)
    {
        $this->profileRepository->update($request, $this->user);
        return back()->with('success', decode('Profile Updated Successfully'));
    }

    /**
     * update password
     */
    public function updatePassword(Request $request)
    {
        $request->validate(
            [
                'current_password' => 'required',
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'current_password.required' => decode('Enter Your Current PassWord'),
                'password.required' => decode('Enter A PassWord'),
                'password.min' => decode('min 8 character required'),
                'password_confirmation.required' => decode('Confiram Password Feild Is Required'),
                'password_confirmation.same' => decode('Confiram Password Does Not Match With Password'),
            ]
        );
        $response  = $this->profileRepository->updatePassword($request, $this->user);
        if ($response == 'failed') {
            return back()->with('error', decode('Pasword Does Not Match'));
        }
        return back()->with('success', decode('Pasword Updated Successfully'));
    }
}
