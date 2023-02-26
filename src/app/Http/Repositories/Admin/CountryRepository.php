<?php
namespace App\Http\Repositories\Admin;

use App\Cp\ImageProcessor;
use App\Models\Country;
class CountryRepository
{
    public $country;
    public function __construct(Country $country){
        $this->country = $country;
    }

    /**
     * show all category
     */
    public function index(){
        return  $this->country->with(['createdBy','updatedBy'])->latest()->get();
    }

    /**
     * get specefic category
     *
     * @param $id
     */
    public function getSpecificedItem($id){
        return  $this->country->with(['createdBy','updatedBy'])->where('id',$id)->first();
    }


    /**
     * store a specific category
     *
     * @param $request
     */
    public function store($request){
        $this->country->name = $request->name;
        $this->country->created_by = authUser()->id;

        if($request->hasFile('logo')){
            try{
                $this->country->logo = ImageProcessor::uploadFile($request->logo,'country');
            }catch (\Exception $exp){

            }
        }
        $this->country->save();
    }


    /**
     * update category information
     */
    public function update($request){

        $country = $this->getSpecificedItem($request->id);
        $country->name = $request->name;
        $country->updated_by = authUser()->id;
        if($request->hasFile('logo')){
            if($country->logo){
                ImageProcessor::deleteFile($country->logo,'country');
            }
            try{
                $country->logo = ImageProcessor::uploadFile($request->logo,'country');
            }catch (\Exception $exp){

            }
        }
        $country->save();
    }


    /**
     * destroy country
     * @param $request
     */
    public function delete($request){
        $country =  $this->getSpecificedItem($request->id);
        if(count($country->service) > 0){
            $response['success'] = false;
            $response['message'] = 'Please Delete all relational Services and try again';       
        } else {
            if($country->logo){
                ImageProcessor::deleteFile($country->logo, 'country');
            }
            $country->delete();
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
