<?php
namespace App\Http\Repositories\Admin;

use App\Models\Choose;

class ChooseRepository
{
    public $choose;
    public function __construct(Choose $choose){
        $this->choose = $choose;
    }


    /**
     * get all package
     *
     */
    public function index(){
        return $this->choose->with(['createdBy','updatedBy'])->latest()->get();
    }

    /**
     * get specefic package
     *
     * @param $id
     */
    public function getSpecificedItem($id){
        return  $this->choose->with(['createdBy','updatedBy'])->where('id',$id)->first();
    }


    /**
     * store a specific package
     *
     * @param $request
     */
    public function store($request){
        $this->choose->setTranslations('qsn', $request->qsn);
        $this->choose->setTranslations('ans', $request->ans);
        $this->choose->icon = $request->icon;
        $this->choose->created_by = authUser()->id;
        $this->choose->save();
    }



    /**
     * update package information
     */
    public function update($request){
        $choose = $this->getSpecificedItem($request->id);
        $choose->setTranslations('qsn', $request->qsn);
        $choose->setTranslations('ans', $request->ans);
        $choose->icon = $request->icon;
        $choose->updated_by = authUser()->id;
        $choose->save();
    }

    /**
     * destroy category
     * @param $request
     */
    public function delete($request){    
        $choose =  $this->getSpecificedItem($request->id);      
        $choose->delete();
        $response['success'] = true;
        $response['message'] = 'Message Delete Successfully';         
        return $response;
    }


}
