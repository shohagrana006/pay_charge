<?php
namespace App\Http\Repositories\Admin;

use App\Cp\ImageProcessor;
use App\Models\Package;
use App\Models\PackageService;

class PackageRepository
{
    public $package;
    public function __construct(Package $package){
        $this->package = $package;
    }


    /**
     * get all package
     *
     */
    public function index(){
        return $this->package->with(['createdBy','updatedBy','servicePackage'])->latest()->get();
    }

    /**
     * get specefic package
     *
     * @param $id
     */
    public function getSpecificedItem($id){
        return  $this->package->with(['createdBy','updatedBy', 'servicePackage'])->where('id',$id)->firstOrFail();
    }


    /**
     * store a specific package
     *
     * @param $request
     */
    public function store($request){

        $this->package->setTranslations('name', $request->name);
        $this->package->setTranslations('title', $request->title);
        $this->package->created_by = authUser()->id;
        if($request->hasFile('logo')){
            try{
                $this->package->logo = ImageProcessor::uploadFile($request->logo,'package');
            }catch (\Exception $exp){

            }
        }
        $this->package->save();
        $this->package->servicePackage()->attach($request->service_id);
    }



    /**
     * update package information
     */
    public function update($request){
        $package = $this->getSpecificedItem($request->id);
        $package->setTranslations('name', $request->name);
        $package->setTranslations('title', $request->title);
        $package->updated_by = authUser()->id;
        if($request->hasFile('logo')){
            if($package->logo){
                ImageProcessor::deleteFile($package->logo,'package');
            }
            try{
                $package->logo = ImageProcessor::uploadFile($request->logo,'package');
            }catch (\Exception $exp){

            }
        }
        $package->save();
        $package->servicePackage()->detach();
        $package->servicePackage()->attach($request->service_id);
    }

    /**
     * destroy category
     * @param $request
     */
    public function delete($request){
        
        $package =  $this->getSpecificedItem($request->id);
        $flag =1;
        foreach ($package->servicePackage as $value) {        
            $packageServiceId = PackageService::with('packageLists')->where('package_id', $value->pivot->package_id)->where('service_id', $value->pivot->service_id)->first();
            if(count($packageServiceId->packageLists) > 0)
            {
                $flag = 0;
            } 
         }

         if($flag == 1){
            if($package->logo){
                ImageProcessor::deleteFile($package->logo, 'package');
            }
            $package->delete();
            $package->servicePackage()->detach();
            $response['success'] = true;
            $response['message'] = 'User Delete Successfully';     
         } else {
            $response['success'] = false;
            $response['message'] = 'Please Delete all relational packages and try again';
         }
        return $response;

    }


}
