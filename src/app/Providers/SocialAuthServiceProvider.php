<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
class SocialAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            $oauthCreds = generalSetting()->social_login;
            if ($oauthCreds) {
                foreach(json_decode($oauthCreds,true) as $key => $cred){
                    $oauthCred =  json_decode($cred,true);
                    if( $oauthCred ['status'] == 'Active' && $key == 'facebook_oauth'){
                        $facebookCredsConfig = array(
                            'client_id' => $oauthCred['client_id'],
                            'client_secret' => $oauthCred['client_secret'],
                            'redirect' => url('user/login/facebook/callback'),
                        );
                        Config::set('services.facebook', $facebookCredsConfig);
                    }
                    if( $oauthCred ['status'] == 'Active' && $key == 'google_oauth'){
                        $googleCredsConfig = array(
                            'client_id' => $oauthCred['client_id'],
                            'client_secret' => $oauthCred['client_secret'],
                            'redirect' => url('user/login/google/callback'),
                        );
                        Config::set('services.google', $googleCredsConfig);

                    }
                }
            }
        }catch(\Exception $exception){}
    }
}
