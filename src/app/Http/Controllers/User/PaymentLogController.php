<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PaymentLog;
use Illuminate\Http\Request;

class PaymentLogController extends Controller
{
    public function post(Request $request)
    {
        $request->validate([
            'purchase_id' => 'required|exists:purchases,id',
            'method_id' => 'required|exists:manual_payments,id'
        ]);

        $paymentLog = new PaymentLog();
        $paymentLog->purchase_id = $request->purchase_id;
        $paymentLog->user_id = authUser('web')->id;
        $paymentLog->manual_method_id = $request->method_id;
        $paymentLog->amount = $request->ammount;
        $paymentLog->info = json_encode($request->info);
        $paymentLog->save();
        return redirect()->route('user.package.index')->with('success', 'Your request sucessfully confirm. plese wait for admin confirm your package active');
    }
}
