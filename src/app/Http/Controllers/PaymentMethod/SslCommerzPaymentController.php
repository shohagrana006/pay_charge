<?php
namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Http\Repositories\User\PaymentRepository;
use Illuminate\Http\Request;

use App\Models\PaymentMethod;
use App\Models\PaymentLog;
use App\Http\Utility\PaymentInsert;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{

    public function index(Request $request)
    {
        $user = authUser('web');

        $paymentMethod = PaymentMethod::where('unique_code','SSLCOMMERZ104')->first();
        if(!$paymentMethod){
            return redirect()->route('user.pages.dashboard')->with('error',decode('Invalid Payment gateway'));
        }
        $currencySetup = json_decode(generalSetting()->currency_setup,true);
        $post_data = array();
        $post_data['total_amount'] = session()->get('payment_amount');
        $post_data['currency'] = $currencySetup['currency'];
        $post_data['tran_id'] = rand(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $user->name ?? "demo user";
        $post_data['cus_email'] = $user->email;
        $post_data['cus_add1'] = $user->address ?? "Address";
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = @$user->phone ?? "01625509628";
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";
        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'hosted');
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        $paymentMethod = PaymentMethod::where('unique_code','SSLCOMMERZ104')->first();
        $orderId =  PaymentRepository::createOrder();
        PaymentRepository::createUserPackage($orderId->order_id,$paymentMethod->id);
        return redirect()->route('user.dashboard')->with('success',decode('Payment successful!'));
    }



    public function fail(Request $request){
        return redirect()->route('user.dashboard')->with('error',decode('Payment Failed!'));
    }

    public function cancel(Request $request)
    {
        return redirect()->route('user.dashboard')->with('error',decode('Payment Cancel!'));
    }



    public function ipn(Request $request)
    {

    }


}

