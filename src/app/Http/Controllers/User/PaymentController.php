<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\User\FrontendRepository;
use App\Http\Repositories\User\PaymentRepository;
use App\Models\ManualPayment;
use App\Models\PaymentMethod;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
class PaymentController extends Controller
{

    public function list()
    {
        $manualPayments = ManualPayment::where('status', 'Active')->select('id', 'gateway_name', 'logo')->get();
        $automaticPayments = PaymentMethod::where('status', 'Active')->select('id', 'name', 'image')->get();
        return view('user.pages.purchase.payment', compact('manualPayments', 'automaticPayments'));
    }

    public function automaticPreview($id){
        $automaticPayment = PaymentMethod::where('status', 'Active')->where('id', $id)->firstOrFail();
        $purchase = Purchase::where('id', session('purchase_id'))->firstOrFail();
        return view('user.pages.payment.automatic_preview', compact('automaticPayment', 'purchase'));
    }

    /**
     * payment confirm route
     *
     */
     public function paymentConfirm(Request $request){

    	$paymentMethod = PaymentMethod::where('status', 'Active')->where('id', $request->id)->firstOrFail();
    	if(!$paymentMethod){
            return redirect()->route('user.dashboard')->with('error',decode('Invalid Payment gateway'));
        }
        else{
            $amount =  $request->amount;
            session()->put(['payment_amount' =>  $amount]);
            $currencySetup = json_decode(generalSetting()->currency_setup,true);
            session()->put('payment_method',$paymentMethod->unique_code);
            if($paymentMethod->unique_code == "STRIPE101"){
                return view('user.pages.payment.stripe',[
                    'paymentMethod' => $paymentMethod
                ]);
            }else if($paymentMethod->unique_code == "PAYPAL102"){
                return view('user.pages.payment.paypal', [
                    'paymentMethod' => $paymentMethod
                ]);
            }
            else if($paymentMethod->unique_code == "PAYSTACK103"){
                return view('user.pages.payment.paystack', [
                    'paymentMethod' => $paymentMethod
                ]);
            }else if($paymentMethod->unique_code == "SSLCOMMERZ104"){
                return view('user.pages.payment.sslcommerz', [
                    'paymentMethod' => $paymentMethod
                ]);
            }
            else if($paymentMethod->unique_code == "FLUTTERWAVE105"){
                return view('user.pages.payment.flutterwave', [
                    'paymentMethod' => $paymentMethod
                ]);
            }
            else if($paymentMethod->unique_code == "PAYTM105"){
                return view('user.pages.payment.paytm', compact('paymentMethod',));
            }
            else if($paymentMethod->unique_code == "INSTA106"){
                return view('user.pages.payment.instamojo', [
                    'paymentMethod' => $paymentMethod
                ]);
            }
            else if($paymentMethod->unique_code == "Razorpay102"){
                $creds = json_decode($paymentMethod->payment_parameter,true);
                $api = new Api($creds['razorpay_key'], $creds['razorpay_secret']);
                $order = $api->order->create(
                    array(
                        'receipt' => rand(),
                        'amount' => round(($amount)*100),
                        'currency' => $currencySetup['currency'],
                        'payment_capture' => '1'
                    )
                );
                return view('user.pages.payment.razorpay', [
                    'paymentMethod' => $paymentMethod,
                    'order' => $order
                ]);
            }
            else{
                session()->forget('payment_amount');
                return redirect()->route('user.dashboard')->with('error',decode('Invalid Payment gateway'));
            }
        }

     }



    /**
     * manual preview blade
     */
     public function manualPreview($id)
     {
        $manualPayment = ManualPayment::where('status', 'Active')->where('id', $id)->firstOrFail();
        $purchase = Purchase::where('id', session('purchase_id'))->firstOrFail();
        return view('user.pages.payment.manual_preview', compact('manualPayment', 'purchase'));
     }

}
