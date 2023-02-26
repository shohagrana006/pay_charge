<?php
namespace App\Http\Repositories\Admin;

use App\Http\Repositories\Eternal\GeneralRepository;
use App\Cp\ImageProcessor;
use App\Http\Services\fileHandleService;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\PaymentMethod;
class PaymentMethodRepository
{
    /**
     * constract a method
     */
    private $paymentMethod;
    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * find a specific paymentMethod
     *
     * @param $id
     */
    public function specificPaymentMethod($id)
    {
        return  GeneralRepository::findElement('PaymentMethod', $id, 'id');
    }


    /**
     * get all PaymentMethod
     */
    public static function index(){
        return PaymentMethod::with(['createdBy','updatedBy'])->latest()->get();
    }

    /**
     * update page information
     */
    public function update($request){
        $paymentMethod = $this->specificPaymentMethod($request->id);
        $paymentMethod->payment_parameter = json_encode($request->paymentCreds);
        $paymentMethod->currency_id = $request->currency_id;
        $paymentMethod->charge = $request->charge;
        $paymentMethod->save();
    }


}
