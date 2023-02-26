<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\PaymentLog;
use App\Models\GeneralSetting;
use App\Http\Controllers\PaymentMethod\PaymentController;
use App\Http\Utility\PaymentInsert;
use BeyondCode\QueryDetector\Outputs\Json;
use Illuminate\Support\Facades\Redirect;
class PaymentWithInstamojo extends Controller
{
    public static function process()
    {

        $basic = GeneralSetting::first();
        $paymentMethod = PaymentMethod::where('unique_code','INSTA106')->first();
        $apiKey = $paymentMethod->payment_parameter->api_key;
        $token = $paymentMethod->payment_parameter->auth_token;
        if(!$paymentMethod){
            $notify[] = ['error', 'Invalid Payment gateway'];
            return back()->withNotify($notify);
        }
        $paymentTrackNumber = session()->get('payment_track');
        $paymentLog = PaymentLog::where('trx_number', $paymentTrackNumber)->first();





        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
                    array("X-Api-Key:test_dbb4c21caa2e8d4a263431aecb4",
                          "X-Auth-Token:test_24a7be63b2e8c6adea8bdf3b9c0"));

        $payload = array(
            'purpose' => 'Payment to ' . $basic->site_name,
            'amount' => round($paymentLog->final_amount,2),
            'buyer_name' => $paymentLog->user->name,
            'redirect_url' => route('user.ipn.instamojo'),
            // 'webhook' => 'http://www.example.com/webhook/',
            // 'webhook' => route('user.ipn.instamojo'),
            'email' => $paymentLog->user->email,
            'send_email' => true,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        if ($response->success) {
           return json_encode([
               "response"=>$response->payment_request->longurl
           ]);
        } else {
            $notify[] = ['error', 'Payment failed!'];
            return redirect()->route('user.dashboard')->withNotify($notify);
        }

    }

    public function ipn()
    {
    	$paymentTrackNumber = session()->get('payment_track');
        $data = PaymentLog::where('trx_number', $paymentTrackNumber)->orderBy('id', 'DESC')->first();
        $paymentMethod = PaymentMethod::where('unique_code','INSTA106')->first();
        PaymentInsert::paymentUpdate($data->trx_number);
        $notify[] = ['success', 'Payment successful!'];
        return redirect()->route('user.dashboard')->withNotify($notify);

    }
}
