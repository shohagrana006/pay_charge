<?php
namespace App\Http\Repositories\Admin;

use App\Cp\ImageProcessor;
use App\Models\ServiceCategory;
class ServiceCategoryRepository
{
    public $serviceCategory;
    public function __construct(ServiceCategory $serviceCategory){
        $this->serviceCategory = $serviceCategory;
    }

    /**
     * show all category
     */
    public function index(){
        return  $this->serviceCategory->with(['createdBy','updatedBy'])->latest()->get();
    }

    /**
     * get specefic category
     *
     * @param $id
     */
    public function getSpecificedItem($id){
        return  $this->serviceCategory->with(['createdBy','updatedBy'])->where('id',$id)->first();
    }


    /**
     * store a specific category
     *
     * @param $request
     */
    public function store($request){
        $this->serviceCategory->setTranslations('name', $request->name);

        $data  =  $request->slug;
        foreach($data as $key=> $val){
            if(!$val){
                $data[$key] = makeSlug($request->name[$key]);
            }else{
                $data[$key] = makeSlug($val);
            }
        }
        $this->serviceCategory->setTranslations('slug', $data);
        $this->serviceCategory->created_by = authUser()->id;

        if($request->hasFile('logo')){
            try{
                $this->serviceCategory->logo = ImageProcessor::uploadFile($request->logo,'service_category');
            }catch (\Exception $exp){

            }
        }
        $this->serviceCategory->save();
    }


    /**
     * update category information
     */
    public function update($request)
    {
        $serviceCategory = $this->getSpecificedItem($request->id);
        $serviceCategory->setTranslations('name', $request->name);

        $data = $request->slug;
        foreach($data as $key => $val){
            if(!$val){
                $data[$key] = makeSlug($request->slug[$key]);
            } else{
                $data[$key] = makeSlug($val);
            }
        }
        $serviceCategory->setTranslations('slug', $data);

        $serviceCategory->updated_by = authUser()->id;
        if($request->hasFile('logo')){
            if($serviceCategory->logo){
                ImageProcessor::deleteFile($serviceCategory->logo,'service_category');
            }
            try{
                $serviceCategory->logo = ImageProcessor::uploadFile($request->logo,'service_category');
            }catch (\Exception $exp){

            }
        }
        $serviceCategory->save();
    }


    /**
     * destroy service category
     * @param $request
     */
    public function delete($request){
        $serviceCategory =  $this->getSpecificedItem($request->id);
        if(count($serviceCategory->service) > 0){
            $response['success'] = false;
            $response['message'] = 'Please Delete all relational Services and try again';       
        } else {
            if($serviceCategory->logo){
                ImageProcessor::deleteFile($serviceCategory->logo, 'service_category');
            }
            $serviceCategory->delete();
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
