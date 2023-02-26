<?php

namespace App\Providers;

use App\Models\PaymentMethod;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
class PaymentServiceProvider extends ServiceProvider
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
            $paypal = PaymentMethod::where('unique_code', 'PAYPAL102')->first();
            if($paypal){
                $paypaLCreds = json_decode($paypal->payment_parameter,true);
                $config = array(
                    'client_id' =>$paypaLCreds['client_id'],
                    'secret' => $paypaLCreds['secret'],
                    'settings' => array(
                        'mode' => @$paypaLCreds['environment'] ?? 'sandbox',
                        'http.ConnectionTimeOut' => 1000,
                        'log.LogEnabled' => true,
                        'log.FileName' => storage_path() . '/logs/paypal.log',
                        'log.LogLevel' => 'FINE'
                    ),
                );
                Config::set('paypal', $config);
            }
            $sslcommerz = PaymentMethod::where('unique_code', 'SSLCOMMERZ104')->first();
            // dd($sslcommerz);
            if($sslcommerz){
     
                $sslCreds = json_decode($sslcommerz->payment_parameter,true);
                if($sslCreds['environment'] == 'live') {
                    $url = "https://securepay.sslcommerz.com";
                    $host = false;
                }else {
                    $url = "https://sandbox.sslcommerz.com";
                    $host = true;
                }
                $sslconfig = array(
                    'projectPath' => env('PROJECT_PATH'),
                    'apiDomain' => env("API_DOMAIN_URL", $url),
                    'apiCredentials' => [
                        'store_id' => $sslCreds['store_id'],
                        'store_password' =>$sslCreds['store_password']
                    ],
                    'apiUrl' => [
                        'make_payment' => "/gwprocess/v4/api.php",
                        'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
                        'order_validate' => "/validator/api/validationserverAPI.php",
                        'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
                        'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
                    ],
                    'connect_from_localhost' => env("IS_LOCALHOST", $host),
                    'success_url' => '/user/ipn/success/',
                    'failed_url' => '/user/ipn/fail/',
                    'cancel_url' => '/user/ipn/cancel/',
                    'ipn_url' => '/user/ipn',
                );

                Config::set('sslcommerz', $sslconfig);
            }


        } catch (\Exception $ex) {
        }
    }
}
