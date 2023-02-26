<?php
namespace App\Http\Repositories\Admin;

use App\Cp\ImageProcessor;
use App\Models\GeneralSettings;
use App\Http\Repositories\Eternal\GeneralRepository;
use Illuminate\Support\Facades\Artisan;
use App\Models\Mail;
use Illuminate\Http\Request;

class GeneralSettingsRepository {
    private $generalSettings;

    public function __construct(GeneralSettings $generalSettings){
        $this->generalSettings = $generalSettings;
    }
    /**
     * get all gen settings data
     */
    public function index(){
        return $this->generalSettings->first();
    }
    /**
     * update social media
     *
     * @param  $request
     */
    public function updateSocialMedia($request){
        $generalSettings = $this->index();
        $keyValue = (json_decode($generalSettings->social_media, true));
        $socialMedia = json_decode($keyValue[$request->name], true) ;
        $socialMedia['name'] = $request->name;
        $socialMedia['link'] = $request->link;
        $socialMedia['icon'] = $request->icon;
        $keyValue[$request->name] = json_encode($socialMedia);
        $generalSettings->social_media = json_encode($keyValue);
        $generalSettings->save();
    }

    /**
     * update function
     *
     * @param $request, $id
     */
    public function update($request)
    {

        $generalSettings = $this->index();
        $generalSettings->name = $request->name;
        $generalSettings->currency_setup = json_encode($request->currency);
        $generalSettings->phone = $request->phone;
        $generalSettings->email = $request->email;
        $generalSettings->copy_right_text = $request->copy_right_text;
        $generalSettings->pagination_number = $request->pagination_number;
        $generalSettings->address = $request->address;
        $mailFooter = json_decode($generalSettings->mail_footer,true);
        $mailFooter['link'] = $request->mail_footer['link'];
        if(array_key_exists('logo', $request->mail_footer)){
            if($mailFooter['logo']){
                ImageProcessor::deleteFile($mailFooter['logo'],'mail_footer');
            }
            try{
                $mailFooter['logo'] = ImageProcessor::uploadFile($request->mail_footer['logo'],'mail_footer');
            }catch (\Exception $exp){

            }
        }
        $generalSettings->mail_footer = json_encode($mailFooter);
        if($request->hasFile('favicon')){
            if($generalSettings->favicon){
                ImageProcessor::deleteFile($generalSettings->favicon,'favicon');
            }
            try{
                $generalSettings->favicon = ImageProcessor::uploadFile($request->favicon,'favicon');
            }catch (\Exception $exp){

            }
        }
        if($request->hasFile('logo')){
            if($generalSettings->logo){
                ImageProcessor::deleteFile($generalSettings->logo,'logo');
            }
            try{
                $generalSettings->logo = ImageProcessor::uploadFile($request->logo,'logo');
            }catch (\Exception $exp){

            }
        }

         $generalSettings->save();
    }

    public function socialLoginUpdate($request, $id)
    {
        $generalSettings = $this->index();
        $generalSettings->google_oauth = json_encode($request->google);
        $generalSettings->facebook_oauth = json_encode($request->facebook);
        $generalSettings->save();
    }

    /**
     * social media status update method
     *
     * @param $request
     */
    public function socialMediaStatusUpdate($request)
    {
        $name =  $request->name;
        $generalSettings = $this->index();
        $keyValue = (json_decode($generalSettings->social_media, true));
        $item = json_decode($keyValue[$name], true) ;
        if($item['status'] == 'Active'){
            $item['status'] = 'DeActive';
        } else{
            $item['status'] = 'Active';
        }
        $keyValue[$name] = json_encode($item);
        $generalSettings->social_media = json_encode($keyValue);
        $generalSettings->save();
    }


    /**
     * update mail config
     *
     * @param $request
     */
    public function updateMailConfig($request){
        $mail = GeneralRepository::findElement('Mail',$request->id,'id');
        $mail->driver_information  = (json_encode($request->driver));
        $mail->save();
    }

    /**
     * update a specific key status
     *
     * @param $request
     */

     public function updateKeyStatus($request){
        $generalSettings = $this->index();
        $key = $request->key;

        if($generalSettings->$key  == 'DeActive'){

            $generalSettings->update([
                $key  =>'Active'
            ]);
            $message = 'Activated';
        }
        else if($generalSettings->$key == 'Active'){

            $generalSettings->update([
                $key  =>'DeActive'
            ]);
            $message = 'DeActivated';
        }
        return $message;
     }


    /**
     * update mail status
     *
     * @param $request
     */
    public function updateMailStatus($request){
        updateStatus($request->id,'Mail');
        $mail =  Mail::where('id','!=',$request->id)->first();
        updateStatus($mail->id,'Mail');
    }


    /**
     * update recaptcha settings
     *
     * @param $request
     */
    public function updateRecaptcha($request){
        $generalSettings = $this->index();
        $generalSettings->recaptcha = json_encode($request->recaptcha);
        $generalSettings->save();
    }


    /**
     * update recaptcha status
     *
     * @param $request
     *
     */
    public function updateRecaptchaStatus($request){
        $generalSettings = $this->index();
        $data =  json_decode( $generalSettings->recaptcha,true);
        if( $data['status'] ==  'Active'){
            $data['status'] = 'DeActive';
        }
        else{
            $data['status'] = 'Active';
        }
        $generalSettings->recaptcha = json_encode($data);
        $generalSettings->save();
    }

    /**
     * update media login cred
     *
     * @param $request
     *
     */
    public function mediaLoginCredUpdate($request){
        $generalSettings = $this->index();
        $key = ($request->oauth_key);
        $oauthCreds  =  json_decode($generalSettings->social_login,true);
        $oauthCreds[$key] = (json_encode($request->$key));
        $generalSettings->social_login =   $oauthCreds ;
        $generalSettings->save();
    }


    /**
     * update media login cred
     *
     * @param $request
     *
     */
    public function credStatusUpdate($request){
        $generalSettings = $this->index();
        $oauthCreds  =  json_decode($generalSettings->social_login,true);
        $cred  = (json_decode($oauthCreds[$request->oauth_key],true));
        if($cred['status'] == 'Active'){
            $cred['status'] = 'DeActive';
        }
        else{
            $cred['status'] = 'Active';
        }
        $oauthCreds[$request->oauth_key] = json_encode($cred);
        $generalSettings->social_login =   $oauthCreds ;
        $generalSettings->save();
    }






}
