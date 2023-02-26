<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ManualPayment;
use App\Models\PackageList;
use App\Models\PaymentMethod;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = authUser('web');
            return $next($request);
        });
    }

    public function index()
    {
        $purchases = Purchase::where('user_id', $this->user->id)->latest()->get();
        return view('user.pages.purchase_log.index', compact('purchases'));
    }

    public function show($id)
    {
        return view('user.pages.purchase_log.show', [
            'purchase'  => Purchase::where('id', $id)->firstOrFail(),
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:purchases,id',
        ]);
        $purchase = Purchase::where('id', $request->id)->where('user_id', $this->user->id)->where('status', '!=', 2)->first();
        if(!$purchase)
        {
            return back()->with('error', decode('Please insert valid id'));
        }
        $purchase->delete();
        return back()->with('success', decode('Purchase log delete successfully'));
    }





    public function detail($id)
    {
        $packageList = PackageList::with(['packageService.package'])->where('id', $id)->firstOrFail();
        $user = authUser('web');
        return view('user.pages.purchase.detail', compact('packageList', 'user'));
    }

    public function buy(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric',
            'package_list_id' => 'required|exists:package_lists,id'
        ],[
            'phone.required' => decode('Phone number must be required'),
            'phone.numeric' => decode('Phone number must be Number'),
            'package_list_id.numeric' => decode('Please valid id'),
            'package_list_id.exists' => decode('Please valid id'),
        ]);

        $packageList = PackageList::where('id',$request->package_list_id)->first();
        $package_info = [
            'minute' => $packageList->minute ?? ' ',
            'mb' => $packageList->mb ?? ' ',
            'sms' => $packageList->sms ?? ' ',
            'price' => $packageList->price - $packageList->discount_price,
            'duration' => $packageList->duration ?? ' ',
        ];

        $purchase = new Purchase();
        $purchase->user_id = $request->user_id;
        $purchase->name = $request->name;
        $purchase->email = $request->email;
        $purchase->phone = $request->phone;
        $purchase->package_info = json_encode($package_info);
        $purchase->trx_number = mt_rand(10000, 999999);
        $purchase->save();

        session()->forget('purchase_id');
        session()->put(['purchase_id' => $purchase->id]);

        return redirect()->route('user.payment.list');
    }




}
