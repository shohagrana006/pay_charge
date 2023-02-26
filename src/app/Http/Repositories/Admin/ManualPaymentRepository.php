<?php
namespace App\Http\Repositories\Admin;

use App\Cp\ImageProcessor;
use App\Models\ManualPayment;
class ManualPaymentRepository
{
    public $manualPayment;
    public function __construct(ManualPayment $manualPayment){
        $this->manualPayment = $manualPayment;
    }

    /**
     * show all category
     */
    public function index(){
        return  $this->manualPayment->with(['createdBy','updatedBy'])->latest()->get();
    }

    /**
     * get specefic category
     *
     * @param $id
     */
    public function getSpecificedItem($id){
        return  $this->manualPayment->with(['createdBy','updatedBy'])->where('id',$id)->first();
    }


    /**
     * store a specific category
     *
     * @param $request
     */
    public function store($request){

        $this->manualPayment->gateway_name   = $request->gateway_name;
        $this->manualPayment->minimum_amount = $request->minimum_amount;
        $this->manualPayment->maximum_amount = $request->maximum_amount ?? null;
        $this->manualPayment->fixed_charge   = $request->fixed_charge ?? null;
        $this->manualPayment->percent_charge = $request->percent_charge ?? null;
        $this->manualPayment->instruction    = $request->instruction ?? null;
        $this->manualPayment->info           = json_encode($request->input) ?? null;
        $this->manualPayment->created_by     = authUser()->id;
        if($request->hasFile('logo')){
            try{
                $this->manualPayment->logo = ImageProcessor::uploadFile($request->logo,'manual_payment');
            }catch (\Exception $exp){

            }
        }
        $this->manualPayment->save();
    }


    /**
     * update category information
     */
    public function update($request)
    {
        $manualPayment = $this->getSpecificedItem($request->id);

        $manualPayment->gateway_name   = $request->gateway_name;
        $manualPayment->minimum_amount = $request->minimum_amount ?? null;
        $manualPayment->maximum_amount = $request->maximum_amount ?? null;
        $manualPayment->fixed_charge   = $request->fixed_charge ?? null;
        $manualPayment->percent_charge = $request->percent_charge ?? null;
        $manualPayment->instruction    = $request->instruction ?? null;
        $manualPayment->info           = json_encode($request->input) ?? null;
        $manualPayment->updated_by     = authUser()->id;
        if($request->hasFile('logo')){
            if($manualPayment->logo){
                ImageProcessor::deleteFile($manualPayment->logo,'manual_payment');
            }
            try{
                $manualPayment->logo = ImageProcessor::uploadFile($request->logo,'manual_payment');
            }catch (\Exception $exp){

            }
        }
        $manualPayment->save();
    }


    /**
     * destroy category
     * @param $request
     */
    public function delete($request){
        $manualPayment =  $this->getSpecificedItem($request->id);
        if($manualPayment->logo){
            ImageProcessor::deleteFile($manualPayment->logo, 'manual_payment');
        }
        $manualPayment->delete(); 
    }


}
