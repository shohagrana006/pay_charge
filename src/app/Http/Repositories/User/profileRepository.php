<?php
namespace App\Http\Repositories\User;
use Illuminate\Support\Facades\Hash;
use App\Cp\ImageProcessor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class profileRepository
{

    /**
     * update profile inforamtion
     *
     * @param  $request ,$authUser
     */
    public function update($request,$authUser){
        $authUser->name =  $request->name;
        $authUser->phone =  $request->phone;
        $authUser->address =  json_encode($request->address);
        if($request->hasFile('profile_image')){
            if($authUser->profile_image){
                ImageProcessor::deleteFile($authUser->profile_image,'user_profile');
            }
            try{
                $authUser->profile_image = ImageProcessor::uploadFile($request->profile_image,'user_profile');
            }catch (\Exception $exp){

            }
        }
        $authUser->save();
    }

    /**
     * update password
     *
     * @param  $request ,$authUser
     */
    public function updatePassword($request,$authUser){
        if (Hash::check($request->current_password, $authUser->password)) {
            User::where('id',$authUser->id)->update([
                'password' => Hash::make($request->password)
            ]);
            Auth::guard('web')->loginUsingId($authUser->id);
            return 'success';
        }
        else{
            return 'failed';
        }

    }
}
