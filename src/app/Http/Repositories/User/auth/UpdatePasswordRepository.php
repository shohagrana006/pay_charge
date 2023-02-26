<?php
namespace App\Http\Repositories\User\Auth;

use App\Http\Repositories\Eternal\GeneralRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use function PHPUnit\Framework\isNull;

class UpdatePasswordRepository{

    /**
     * update Password
     *
     * @param $requestData
     */
    public static function update($requestData){

       $data =  DB::table('password_resets')->whereRaw('email = ?',$requestData->email)->whereRaw('token = ?',$requestData->token)->first();

        if(!$data){
            return redirect('/')->with('error', decode('Something wrong please try again!!'));
        }
        else{
            $admin = GeneralRepository::findElement('User',$data->email,'email');
            $admin->password = passwordEncrypt($requestData->password);
            $admin->save();
            return back();
        }
    }

    /**
     * insert reset pass word token
     *
     * @param  $token ,$email
     */
     public static function tokenInsert($token ,$email){
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
     }
}
