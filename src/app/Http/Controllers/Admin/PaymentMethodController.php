<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\PaymentMethodRepository;
use Illuminate\Http\Request;
class PaymentMethodController extends Controller
{

    /**
     * constract a method
     */
    public $paymentMethodRepository ,$user;
    public function __construct(PaymentMethodRepository $paymentMethodRepository)
    {
       $this->middleware(function($request,$next){
           $this->user = authUser();
           return $next($request);
       });
       $this->paymentMethodRepository = $paymentMethodRepository;
    }

    /**
     * Update a specefic paymentMethod information
     *
     */
    public function update(Request $request){
        if(is_null($this->user) || !$this->user->can('paymentMethod.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }
        $this->paymentMethodRepository->update($request);
        return back()->with('success',decode('PaymentMethod Update Successfully'));
    }

    /**
     * Update a status of a specific pages
     *
     */
    public function statusUpdate(Request $request){
        if(is_null($this->user) || !$this->user->can('paymentMethod.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }

        $request->validate([
            'id'=>'required|exists:payment_methods,id'
        ],[
            'id.required'=>decode('The Id Field Is Required'),
            'id.exists'=>decode('Enter A Valid Id')
        ]);
        updateStatus($request->id,'PaymentMethod');
        return back()->with('success', decode('status updated Succesfully'));
    }
}
