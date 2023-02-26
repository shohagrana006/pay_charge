<?php
namespace App\Http\Repositories\User;

use App\Http\Utility\SendNotificationUtility;
use App\Models\Order;
use App\Models\PaymentLog;
use App\Models\PaymentMethod;
use App\Models\UserPackage;
use Carbon\Carbon;
class PaymentRepository
{
    /**
     * get all active blog
     */
    public static function PaymentMethod($request)
    {
        return PaymentMethod::where('unique_code',$request->unique_code)->first();
    }

    /**
     * create order
     */
     public static function createOrder(){
        $order = new Order();
        $order->order_id =  rand();
        $order->user_id =  authUser('web')->id;
        $order->package_id = session()->get('package_id');
        $order->amount = session()->get('payment_amount');
        $order->status = 'success';
        $details['route'] = '';
        $order->save();
        $details['user'] = authUser('web')->name ? authUser('web')->name: authUser('web')->email;
        $details['message'] = decode('Just Purchase A New Package');
        SendNotificationUtility::sendNotification($details);
        return  $order;
     }

     /**
      * create user package
      */
      public static function createUserPackage($orderId,$paymentId){
        $package = FrontendRepository::getPackage(session()->get('package_id'));
        UserPackage::where('user_id',authUser('web')->id)->update([
            'status' => 'DeActive'
        ]);
        $userPackage =  new UserPackage();
        $userPackage->user_id =  authUser('web')->id;
        $userPackage->order_id =  $orderId;
        $userPackage->package_id =  session()->get('package_id');
        if($package->duration != 'Unlimited'){
            $userPackage->expired_date =  Carbon::now()->addDays($package->duration);
        }else{
            $userPackage->expired_date = $package->duration;
        }
        $userPackage->status =  'Running';
        $userPackage->save();
        self::createPaymentlog($orderId,session()->get('payment_amount'),$paymentId);
        session()->forget('package_id');
        session()->forget('payment_amount');
      }

      /**
       *  create payment log
       */
      public static function  createPaymentlog($orderId,$amount,$paymentId){
        $paymentLog = new PaymentLog();
        $paymentLog->order_id = $orderId;
        $paymentLog->method_id = $paymentId;
        $paymentLog->user_id = authUser('web')->id;
        $paymentLog->amount = $amount;
        $paymentLog->payment_status = 'Success';
        $paymentLog->save();
      }

}
