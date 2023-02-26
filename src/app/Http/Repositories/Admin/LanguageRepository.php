<?php
namespace App\Http\Repositories\Admin;

use App\Http\Repositories\Eternal\GeneralRepository;
use App\Cp\ImageProcessor;
use App\Http\Services\fileHandleService;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class LanguageRepository
{


    /**
     * constract a method
     */
    private $language;
    public function __construct(Language $language)
    {
      $this->language = $language;
    }

    /**
     * find a specific language
     *
     * @param $id
     */
    public function getSpecificLanguage($id){
       return  GeneralRepository::findElement('Language',$id,'id');
    }
    /**
     * find a specific language by code
     *
     * @param $code
     */
    public function getSpecificLanguageBykey($code){
       return  GeneralRepository::findElement('Language',$code,'code');
    }

    /**
     * get all latest created language
     */
     public function index(){
        return   $this->language::with(['createdBy','updatedBy'])->latest()->get();
     }

    /**
     * get all latest created language
     */
     public function setDefaultLanguage($id){
      $this->language::where('id','!=',$id)->update([
        'is_default'=>0,
        'updated_by'=>authUser()->id
      ]);
      $this->language::where('id',$id)->update([
        'is_default'=>1,
        'updated_by'=>authUser()->id,
        "status"=>'Active'
      ]);
     }

    /**
     * store a specific language
     *
     * @param $request
     */
     public function create($request){
        $this->language->name = $request->name;
        $this->language->code = strtolower($request->code);
        $this->language->is_default = 0;
        $this->language->created_by = authUser()->id;
        $this->language->save();
        GeneralRepository::createLangJson($request->code);
     }
     /**
      * transalte a specific keyword
      *
      * @param  $request
      * @return void
      */
     public function translateLang($request){
        $langData = json_decode(getLangFile($request->data['code']),true);
        if(array_key_exists($request->data['key'],$langData)){
            $langData[$request->data['key']] = $request->data['keyValue'];
            $path = resource_path(config('constants.options.langFilePath')).strtolower($request->data['code']).'.json';
            File::put($path, json_encode($langData));
            return true;
        }
        else{
            return false;
        }
     }

    /**
     * update a specific language
     *
     * @param $request
     */
     public function update($request){
        $language = $this->getSpecificLanguage($request->id);
        $language->name = $request->name;
        $language->updated_by = authUser()->id;
        $language->save();
    }

    /**
     * destroy a specific language
     *
     * @param $id
     */
    public function delete($id){
        $language = $this->getSpecificLanguage($id);
        if ($language->is_default == 1) {
            return 'Default Language CanNot Be Deleted';
        }
        if(session()->get('locale') == $language->code ){
            return decode('System Current Language CanNot Be Deleted');
        }
        else{
            unlink(GeneralRepository::getLangJsonFile(config('constants.options.langFilePath'),$language->code .'.json'));
            $language->delete();
            return 'deleted';
        }

    }

}
