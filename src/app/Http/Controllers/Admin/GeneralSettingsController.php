<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\GeneralSettingsRepository;
use App\Http\Repositories\Admin\PaymentMethodRepository;
use App\Http\Repositories\Eternal\GeneralRepository;
use App\Http\Requests\Admin\GeneralSettingRequest;
use App\Http\Requests\Admin\OauthRequest;
use App\Http\Requests\Admin\SocialMediaUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Utility\SendMailUtility;
use App\Models\Currency;

class GeneralSettingsController extends Controller
{

    private $generalSettings ,$user;
    public function __construct(GeneralSettingsRepository $generalSettings)
    {
        $this->middleware(function($request,$next){
            $this->user = authUser();
            return $next($request);
        });
        $this->generalSettings = $generalSettings;
    }


    /**
     * send test mail
     *
     * @param $email
     */
     public function testMail(Request $request){
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        $request->validate([
            'email'=>'required|email'
        ],[
            'email.required' => decode('Email Field Is Requireed'),
            'email.email' => decode('Enter A valid Email'),
        ]);
        $details = [
            'view' => 'mail.testMail',
            'from' => getMailFromAddress(),
            'subject'=> decode('Test Mail'),
            'title' => decode('Test Mail'),
            'message'=>decode('Test Mail Message'),
            'body' => decode('test mail body'),
        ];
        $response  =  SendMailUtility::sendMail($details,$request->email);
        if($response == "failed"){
            $success = 'error';
            $message = 'Mail Config Failed';
        }
        else{
            $success ='success';
            $message = 'Test Email Send Successfully';
        }
        return back()->with($success, decode($message));
     }


    /**
     * general setting show method
     */
    public function generalSettings()
    {
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.settings.business_logic.index',[
            'generalSettings' => $this->generalSettings->index(),
        ]);
    }

    /**
     * general setting update
     *
     * @param GeneralSettingRequest $request
     */
    public function generalSettingsUpdate(GeneralSettingRequest $request)
    {
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        $this->generalSettings->update($request);
        return back()->with('success', decode('Setting Updated Successfully !!!'));
    }

    /**
     * update countedBy
     */
    public function updateCountedBy(Request $request){
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        $generalSettings = $this->generalSettings->index();
        $generalSettings->count_by = $request->count_by;
        $generalSettings->save();
        return back()->with('success', decode('Setting Updated Successfully !!!'));
    }

    /**
     * update social media link
     */
    public function socialMediaUpdate(Request $request){
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        $generalSettings = $this->generalSettings->updateSocialMedia($request);
        return back()->with('success', decode('Setting Updated Successfully !!!'));
    }

    /**
     * social media link show method
     *
     */
    public function socialMediaLink(){
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.settings.media_pages.social_media_link');
    }

    /**
     * social media status update method
     *
     * @param Request $request
     */
    public function socialMediaStatus(SocialMediaUpdateRequest $request){
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        $this->generalSettings->socialMediaStatusUpdate($request);
        return back()->with('success', decode('Status Updated Successfully !!!'));
    }


    /**
     * social login show method
     *
     */
    public function socialLogin()
    {
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.settings.social_login',[
            'socialLogin' => $this->generalSettings->index(),
        ]);
    }

    /**
     * social login update method
     *
     * @param $id
     */
    public function socialLoginUpdate(OauthRequest $request, $id){
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        $this->generalSettings->socialLoginUpdate($request, $id);
        return back()->with('success', decode('Oauth Updated successfully'));
    }


    /**
     * mail configaration show
     */
    public function mail()
    {
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.settings.3rd_party.mail_config');
    }

    /**
     * mail configaration update function
     *
     * @param Request $request
     */
    public function mailConfigUpdate(Request $request){
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }

        $this->generalSettings->updateMailConfig($request);
        return back()->with('success', decode('Mail Config Updated successfully'));
    }

    /**
     * mail status update function
     *
     * @param Request $request
     */
    public function mailStatusUpdate(Request $request){
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        $this->generalSettings->updateMailStatus($request);
        GeneralRepository::optimizeClear();
        return back()->with('success', decode('Mail Status Updated successfully'));
    }

    /**
     * payment method configaration show
     */
    public function paymentMethod(){
        if(is_null($this->user) || !$this->user->can('paymentMethod.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.settings.3rd_party.payment_method',[
            'paymentMethods' => PaymentMethodRepository::index(),
            'currencies' => Currency::active()->get()
        ]);
    }

    /**
     * recapture configaration show
     */
    public function recaptcha(){
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.settings.3rd_party.recaptcha');
    }

    /**
     * recapture status update method
     *
     * @param $request
     */
    public function updateRecaptchaStatus(Request $request){
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        $this->generalSettings->updateRecaptchaStatus($request);
        return back()->with('success', decode('Recaptcha status Updated successfully'));
    }

    /**
     * recapture configaration update
     */
    public function recaptchaUpdate(Request $request){
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        $this->generalSettings->updateRecaptcha($request);
        return back()->with('success', decode('Recaptcha Config Updated successfully'));

    }

    /**
     * social media login configaration
     */
    public function mediaLogin()
    {
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.settings.3rd_party.social_media_login');
    }

    /**
     * social media login configaration update
     *
     * @param Request $request
     */
    public function mediaLoginUpdate(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        $this->generalSettings->mediaLoginCredUpdate($request);
        return back()->with('success', decode('Social Login Credential Updated Successfully'));
    }

    /**
     * social media login status  update
     *
     * @param Request $request
     */
    public function mediaLoginStatusUpdate(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        $this->generalSettings->credStatusUpdate($request);
        return back()->with('success', decode('Credential Status Updated Successfully'));
    }

    public function updateKeyStatus(Request $request){

        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        $response = $this->generalSettings->updateKeyStatus($request);
        return back()->with('success', decode($request->key." ". $response .' Successfully'));
    }

}
