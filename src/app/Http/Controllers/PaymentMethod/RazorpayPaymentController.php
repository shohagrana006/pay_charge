<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Http\Repositories\User\PaymentRepository;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\PaymentMethod;
use App\Models\PaymentLog;
use App\Http\Utility\PaymentInsert;
class RazorpayPaymentController extends Controller
{
    public function store(Request $request)
    {
        $flag = 1;
        $paymentMethod = PaymentMethod::where('unique_code','Razorpay102')->first();
        if(!$paymentMethod){
            return redirect()->route('user.pages.dashboard')->with('error',decode('Invalid Payment gateway'));
        }
        $creds = json_decode($paymentMethod->payment_parameter, true);
        $api = new Api($creds['razorpay_key'], $creds['razorpay_secret']);
        try
        {
            $attributes = array(
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            );
            $api->utility->verifyPaymentSignature($attributes);
        }
        catch(SignatureVerificationError $e){
            $flag = 0;
            $ststus = 'error';
            $message = 'Razorpay Error : ' . $e->getMessage();
        }

        if ($flag == 1){
            $orderId =  PaymentRepository::createOrder();
            PaymentRepository::createUserPackage($orderId->order_id, $paymentMethod->id);
            $ststus = 'success';
            $message = decode('Payment successful');
        }
        else{
            $ststus = 'error';
            $message = decode('payment failed');
        }

        return redirect()->route('user.dashboard')->with($ststus,$message);

    }
}
