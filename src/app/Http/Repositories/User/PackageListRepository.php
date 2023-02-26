<?php
namespace App\Http\Repositories\User;

use App\Models\PackageList;

class PackageListRepository
{
    public $packageList;
    public function __construct(PackageList $packageList){
        $this->packageList = $packageList;
    }

    /**
     * show all category
     */
    public function index(){
        return  $this->packageList->with(['createdBy','updatedBy','packageService', 'packageService.package'])->active()->latest()->get();
    }

    /**
     * get specefic category
     *
     * @param $id
     */
    public function getSpecificedItem($id){
        return  $this->packageList->with(['createdBy','updatedBy','packageService'])->where('id',$id)->first();
    }


    /**
     * store a specific category
     *
     * @param $request
     */
    public function store($request){

        $this->packageList->package_service_id  = $request->package_service_id;
        $this->packageList->minute              = $request->minute;
        $this->packageList->mb                  = $request->mb;
        $this->packageList->sms                 = $request->sms;
        $this->packageList->duration            = $request->duration;
        $this->packageList->price               = $request->price;
        $this->packageList->discount_price      = $request->discount_price; 
        $this->packageList->details             = $request->details; 
        $this->packageList->created_by          = authUser()->id;      
        $this->packageList->save();
    }


    /**
     * update category information
     */
    public function update($request)
    {
        $packageList = $this->getSpecificedItem($request->id);

        $packageList->minute          = $request->minute;
        $packageList->mb              = $request->mb;
        $packageList->sms             = $request->sms;
        $packageList->duration        = $request->duration;
        $packageList->price           = $request->price;
        $packageList->discount_price  = $request->discount_price; 
        $packageList->details         = $request->details; 
        $packageList->updated_by      = authUser()->id;      
        $packageList->save();
    }


    /**
     * destroy category
     * @param $request
     */
    public function delete($request){
        $packageList =  $this->getSpecificedItem($request->id);
        $packageList->delete();
    }



}
