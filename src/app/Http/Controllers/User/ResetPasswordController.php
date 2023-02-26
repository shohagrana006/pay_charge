<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Auth\UpdatePasswordRepository;
use App\Http\Repositories\User\Auth\UpdatePasswordRepository as AuthUpdatePasswordRepository;
use App\Http\Requests\User\AuthUpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ResetPasswordController extends Controller
{

    /**
     * Show the form of updating password
     */
    public function index($token){

        $data['reset_data'] = DB::table('password_resets')->whereRaw('token = ?',$token)->first();
        if(!$data['reset_data']){
            return redirect('/')->with('error', decode('Your Password Reset link Expired'));
        }
        return view('user.auth.password.reset',[
            'data' => $data
        ]);
    }

    /**
     * Update requested user password if token match
     */
    public function update(AuthUpdatePasswordRequest $request,AuthUpdatePasswordRepository $updatePasswordRepository){
        $updatePasswordRepository->update($request);
        DB::table('password_resets')->whereRaw('email = ?',$request->email)->delete();
        return redirect('/')->with('success',decode('Password Update Successfully'));
    }


}
