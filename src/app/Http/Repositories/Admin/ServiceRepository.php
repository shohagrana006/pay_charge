<?php
namespace App\Http\Repositories\Admin;

use App\Cp\ImageProcessor;
use App\Models\Service;
class ServiceRepository
{
    public $service;
    public function __construct(Service $service){
        $this->service = $service;
    }

    /**
     * show all category
     */
    public function index(){
        return  $this->service->with(['createdBy','updatedBy','country','serviceCategory'])->latest()->get();
    }

    /**
     * get specefic category
     *
     * @param $id
     */
    public function getSpecificedItem($id){
        return  $this->service->with(['createdBy','updatedBy','country','serviceCategory'])->where('id',$id)->first();
    }


    /**
     * store a specific category
     *
     * @param $request
     */
    public function store($request){
        $this->service->setTranslations('name', $request->name);
        $this->service->country_id          = $request->country_id;
        $this->service->service_category_id = $request->service_category_id;
        $this->service->processing_time     = $request->processing_time ?? null;
        $this->service->fixed_charge        = $request->fixed_charge ?? null;
        $this->service->percent_charge      = $request->percent_charge ?? null;
        $this->service->info                = json_encode($request->input) ?? null;
        $this->service->created_by          = authUser()->id;
        if($request->hasFile('logo')){
            try{
                $this->service->logo = ImageProcessor::uploadFile($request->logo,'service');
            }catch (\Exception $exp){

            }
        }
        $this->service->save();
    }


    /**
     * update category information
     */
    public function update($request)
    {
        $service = $this->getSpecificedItem($request->id);

        $service->setTranslations('name', $request->name);
        $service->country_id          = $request->country_id;
        $service->service_category_id = $request->service_category_id;
        $service->processing_time     = $request->processing_time ?? null;
        $service->fixed_charge        = $request->fixed_charge ?? null;
        $service->percent_charge      = $request->percent_charge ?? null;
        $service->info                = json_encode($request->input) ?? null;
        $service->updated_by          = authUser()->id;
        if($request->hasFile('logo')){
            if($service->logo){
                ImageProcessor::deleteFile($service->logo,'service');
            }
            try{
                $service->logo = ImageProcessor::uploadFile($request->logo,'service');
            }catch (\Exception $exp){

            }
        }
        $service->save();
    }


    /**
     * destroy category
     * @param $request
     */
    public function delete($request){
        $service =  $this->getSpecificedItem($request->id);
        if(count($service->servicePackage) > 0){
            $response['success'] = false;
            $response['message'] = 'Please Delete all relational packages and try again';       
        } else {
            if($service->logo){
                ImageProcessor::deleteFile($service->logo, 'service');
            }
            $service->delete();
            $response['success'] = true;
            $response['message'] = 'User Delete Successfully';       
        }
        return $response;
    }

    

    /**
     * status Update
     *
     * @param $request
     */
    public function status($request)
    {
        updateStatus($request->id, "Category");
    }



}
