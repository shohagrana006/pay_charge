<?php
namespace App\Http\Repositories\Admin;

use App\Models\Faq;

class FaqRepository
{
    public $faq;
    public function __construct(Faq $faq){
        $this->faq = $faq;
    }


    /**
     * get all package
     *
     */
    public function index(){
        return $this->faq->with(['createdBy','updatedBy'])->latest()->get();
    }

    /**
     * get specefic package
     *
     * @param $id
     */
    public function getSpecificedItem($id){
        return  $this->faq->with(['createdBy','updatedBy'])->where('id',$id)->first();
    }


    /**
     * store a specific package
     *
     * @param $request
     */
    public function store($request){
        $this->faq->setTranslations('qsn', $request->qsn);
        $this->faq->setTranslations('ans', $request->ans);
        $this->faq->created_by = authUser()->id;
        $this->faq->save();
    }



    /**
     * update package information
     */
    public function update($request){
        $faq = $this->getSpecificedItem($request->id);
        $faq->setTranslations('qsn', $request->qsn);
        $faq->setTranslations('ans', $request->ans);
        $faq->updated_by = authUser()->id;
        $faq->save();
    }

    /**
     * destroy category
     * @param $request
     */
    public function delete($request){    
        $faq =  $this->getSpecificedItem($request->id);      
        $faq->delete();
        $response['success'] = true;
        $response['message'] = 'FAQ Delete Successfully';         
        return $response;
    }


}
