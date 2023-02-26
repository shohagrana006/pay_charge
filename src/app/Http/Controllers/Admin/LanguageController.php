<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\LanguageRepository;;
use App\Http\Requests\Admin\LanguageStoreRequest;
use App\Http\Requests\Admin\LanguageUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Repositories\Eternal\GeneralRepository;

class LanguageController extends Controller
{
    /**
     * constract a method
     */
    public $languageRepository ;
    public $user;
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->user = authUser();
            return $next($request);
        });
        $this->languageRepository = $languageRepository;
    }


    /**
     * get all language
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('language.index')) {
            abort(403, UnauthorizedMessage());
        }
        return view('admin.pages.language.index', [
            'languages'=>$this->languageRepository->index(),
            'countryCodes'=>json_decode(GeneralRepository::getCountryCode(), true)
        ]);
    }

    /**
     * store a specific language
     *
     * @param LanguageStoreRequest $request
     * @return void
     */
    public function store(LanguageStoreRequest $request)
    {
        if (is_null($this->user) || !$this->user->can('language.store')) {
            abort(403, UnauthorizedMessage());
        }
        $this->languageRepository->create($request);
        return back()->with('success', decode('Language Created Successfully'));
    }

    /**
     * update a specific language
     *
     * @param $request ,$id
     */

    public function update(LanguageUpdateRequest $request)
    {
        if (is_null($this->user) || !$this->user->can('language.edit')) {
            abort(403, UnauthorizedMessage());
        }
        $this->languageRepository->update($request);
        return back()->with('success', decode('Language Updated Successfully'));
    }

    /**
     * edit a specific lang key
     */
    public function translate($key)
    {
        if (is_null($this->user) || !$this->user->can('language.edit')) {
            abort(403, UnauthorizedMessage());
        }
        $language = $this->languageRepository->getSpecificLanguageBykey($key);
        return view('admin.pages.language.translate', [
          'language'=>$language,
          "languageKeyWithData" => json_decode(getLangFile(strtolower($language->code)), true)
        ]);
    }


    /**
     * translate a specific keyword
     * @param $data
     */
    public function tranlateKey(Request $request){
        if(is_null($this->user) || !$this->user->can('language.edit')){
             abort(403,UnauthorizedMessage());
        }
        $response = $this->languageRepository->translateLang($request);
        return json_encode([
            "success" => $response
        ]);
    }

    /**
     * update a specific language status
     * @param $request
     */
    public function statusUpdate(Request $request){
        if(is_null($this->user) || !$this->user->can('language.edit')){
            abort(403,UnauthorizedMessage());
        }
        $request->validate([
            'id'=>'required|exists:languages,id'
        ],[
            'id.required'=>decode('The Id Field Is Required')
        ]);
        $language = $this->languageRepository->getSpecificLanguage($request->id);

        if(session()->get('locale') == $language->code){
            $response = 'error';
            $message = 'System Current Language Status Cant not be Updated';
        }
        else{
            if($language->is_default == 1){
                $response = 'error';
                $message = 'You Can not Update Default language Status';
            }
            else
            {
                $response = 'success';
                $message = 'Status Updated Successfully';
                updateStatus($language->id,'Language');
            }

        }
        return back()->with($response,decode($message));
    }

    /**
     * update a specific language status
     * @param $request
     */
    public function setDefaultLang(Request $request){

        if(is_null($this->user) || !$this->user->can('language.edit')){
            abort(403,UnauthorizedMessage());
        }
        $request->validate([
            'id'=>'required|exists:languages,id'
        ],[
            'id.required'=>decode('The Id Field Is Required')
        ]);
        $language = $this->languageRepository->getSpecificLanguage($request->id);
        if($language->is_default == 1){
            $response = 'error';
            $message = 'You Can not Update Default language Status';
        }
        else{
            $this->languageRepository->setDefaultLanguage($request->id);
            $response = 'success';
            $message = 'Default Language Updated Successfully';
        }
        return back()->with($response,decode($message));
    }

    /**
     * destory a specific language
     *
     * @param $id
     */

    public function destroy(Request $request){
        if(is_null($this->user) || !$this->user->can('language.destroy')){
            return json_encode([
                'success'=>false,
                'message'=> 'Sorry!! You Dont Have Access To Delete it!!'
            ]);
        }
        $response  = $this->languageRepository->delete($request->id);
        if($response == "deleted"){
            $success = true;
            $message = decode('Language Deleted Success');
        }
        else{
            $success = false;
            $message = $response;
        }
        return json_encode(
            [
            'success'=> $success,
            'message'=> $message
            ]
        );
    }

}

