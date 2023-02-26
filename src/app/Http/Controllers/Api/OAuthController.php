<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Utility\SendNotificationUtility;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{

    public function googleReditect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(Request $request)
    {      
        try{
            $user = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $user->getId())->first();
            if($findUser){
                $data['user'] = $findUser;
                $data['access_token'] = $findUser->createToken($findUser->name)->accessToken;
                return $this->ResponseWithSuccess('Login successfully', 201, $data);

                } else{

                    $newUser = User::create([
                        'name' => $user->getName(),
                        'email' => $user->getEmail(),
                        'password' => Hash::make('12345678'),
                        'google_id' => $user->getId()
                    ]);

                    $details['message'] = decode('Just Registered');
                    $details['route'] =  route('admin.user.show', $newUser->id);
                    $details['user'] = $newUser->name;
                    SendNotificationUtility::sendNotification($details);

                    $data['user'] = $newUser;
                    $data['access_token'] = $newUser->createToken($newUser->name)->accessToken;
                    return $this->ResponseWithSuccess('User registration successfully', 201, $data);               
            }
        } catch(Exception $e)
        {
           
        }
    }


}
