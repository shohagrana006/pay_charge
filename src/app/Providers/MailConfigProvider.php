<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
class MailConfigProvider extends ServiceProvider
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
            $mailCredential = json_decode(getActiveMailCredential()->driver_information,true);
            $config = array(
                'driver' => $mailCredential['driver'],
                'host' => $mailCredential['host'],
                'port' => $mailCredential['port'],
                'username' => $mailCredential['username'],
                'password' => $mailCredential['password'],
                'encryption' => $mailCredential['encryption'],
                'from' => array('address' => $mailCredential['from']['address'], 'name' => $mailCredential['from']['name']),
                'sendmail' => '/usr/sbin/sendmail -bs',
                'pretend' => false,
            );
            Config::set('mail', $config);
        } catch (\Exception $ex) {
        }
    }
}
