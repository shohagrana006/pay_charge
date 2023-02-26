<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\profileRepository;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * constract a method
     */
    public $profileRepository ,$user;
    public function __construct(profileRepository $profileRepository)
    {
       $this->middleware(function($request,$next){
           $this->user = authUser();
           return $next($request);
       });
       $this->profileRepository = $profileRepository;
    }

   /**
    * profile page
    */
   public function index(){

       if(is_null($this->user) || !$this->user->can('profile.index')){
           abort(403,UnauthorizedMessage());
       }
       return view('admin.pages.profile.index',[
           'user' => $this->user
       ]);
   }

   /**
    * update profile info
    */
   public function update(ProfileUpdateRequest $request){
       if(is_null($this->user) || !$this->user->can('profile.edit')){
           abort(403,UnauthorizedMessage());
       }
       $this->profileRepository->update($request,authUser());
       return back()->with('success',decode('Profile Updated Successfully'));
   }

   /**
    * update password
    */
   public function updatePassword(Request $request){
       if(is_null($this->user) || !$this->user->can('profile.edit')){
           abort(403,UnauthorizedMessage());
       }
       $request->validate([
        'current_password'=>'required',
        'password' => 'required|min:8',
        'password_confirmation' => 'required|same:password',
       ],
       [
        'current_password.required' => decode('Enter Your Current PassWord'),
        'password.required' => decode('Enter A PassWord'),
        'password.min' => decode('min 8 character required'),
        'password_confirmation.required' => decode('Confiram Password Feild Is Required'),
        'password_confirmation.same' => decode('Confiram Password Does Not Match With Password'),
       ]);
       $response  = $this->profileRepository->updatePassword($request,authUser());
       if($response == 'failed'){
         return back()->with('error',decode('Pasword DoesNot Mass'));
       }
       return back()->with('success',decode('Pasword Updated Successfully'));
   }

}
