<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Http\Repositories\User\PaymentRepository;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\PaymentMethod;
use App\Models\PaymentLog;
use App\Http\Utility\PaymentInsert;
use Session;

class StripePaymentController extends Controller
{
    public function stripePost(Request $request)
    {
   
    	$paymentMethod = PaymentMethod::where('unique_code','STRIPE101')->first();
        if(!$paymentMethod){
            return redirect()->route('user.dashboard')->with('error',decode('Invalid Payment gateway'));
        }
        $creds = json_decode($paymentMethod->payment_parameter, true);
        $currencySetup = json_decode(generalSetting()->currency_setup,true);

        $amount = session()->get('payment_amount');
        Stripe::setApiKey(@$creds['secret_key']);
     dd($request->all( ));
        $charge = Charge::create ([
            "amount" => $amount,
            "currency" =>  $currencySetup['currency'],
            "source" => $request->stripeToken,
            "description" => "Payment success"
        ]);

        dd($charge);
        if($charge['status'] == 'succeeded') {
            $orderId =  PaymentRepository::createOrder();
            PaymentRepository::createUserPackage($orderId->order_id,$paymentMethod->id);
            return redirect()->route('user.dashboard')->with('success',decode('Payment successful!'));
        }
    }
}
