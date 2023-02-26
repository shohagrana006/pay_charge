<?php
namespace App\Http\Repositories\Admin;

use App\Cp\ImageProcessor;
use App\Models\MailTemplate;
use App\Models\PackageService;

class MailTemplateRepository
{
    public $mailTemplate;
    public function __construct(MailTemplate $mailTemplate){
        $this->mailTemplate = $mailTemplate;
    }


    /**
     * get all package
     *
     */
    public function index(){
        return $this->mailTemplate->latest()->get();
    }

    /**
     * get specefic package
     *
     * @param $id
     */
    public function getSpecificedItem($id){
        return  $this->mailTemplate->where('id',$id)->first();
    }


    /**
     * update package information
     */
    public function update($request){
        $mailTemplate = $this->getSpecificedItem($request->id);

        $mailTemplate->subject = $request->subject;
        $mailTemplate->body = $request->body;      
        $mailTemplate->save();
    }


}
