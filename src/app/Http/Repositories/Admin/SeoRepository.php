<?php
namespace App\Http\Repositories\Admin;

use App\Http\Repositories\Eternal\GeneralRepository;
use App\Models\SeoSetting;

class SeoRepository
{
    /**
     * constract a method
     */
    private $seoSetting;
    public function __construct(SeoSetting $seoSetting)
    {
        $this->seoSetting = $seoSetting;
    }

    /**
     * find a specific seoSetting
     *
     * @param $id
     */
    public function getSpecificSeoSetting($id)
    {
        return  GeneralRepository::findElement('SeoSetting', $id);
    }


    /**
     * get all seoSetting
     */
    public function index(){
        return  $this->seoSetting->with(['createdBy','updatedBy'])->latest()->get();
    }

    /**
     * store a specific seoSetting
     *
     * @param $request
     */
    public function store($request){
        $this->seoSetting->name  = $request->name;
        $this->seoSetting->created_by = authUser()->id;
        if( $request->meta_title){
            $this->seoSetting->setTranslations('meta_title', $request->meta_title);
        }
        if($request->meta_description){
            $this->seoSetting->setTranslations('meta_description', $request->meta_description);
        }
        $this->seoSetting->save();
    }


    /**
     * update seoSetting information
     */
    public function update($request){

        $seoSetting = $this->getSpecificSeoSetting($request->id);
        $seoSetting->updated_by = authUser()->id;
        if( $request->meta_title){
            $seoSetting->setTranslations('meta_title', $request->meta_title);
        }
        if($request->meta_description){
            $seoSetting->setTranslations('meta_description', $request->meta_description);
        }
        $seoSetting->save();        ;
    }

    /**
     * destroy seoSetting
     * @param $request
     */
    public function delete($request){
        $seoSetting =  $this->getSpecificSeoSetting($request->id);
        $seoSetting->delete();
    }



}
