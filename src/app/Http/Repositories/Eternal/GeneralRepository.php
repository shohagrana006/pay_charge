<?php
namespace App\Http\Repositories\Eternal;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
class GeneralRepository{

    /**
     * find data by model name
     *
     * @return query result
     */
    public static function findElement($modelName,$searchBy, $columnName ='id',$method='first',$latest='created_at',){
        return app(config('constants.options.modelNamespace').$modelName)::where($columnName ,$searchBy)->orderBy($latest)->$method();
    }

    /**
     * genarate random token
     *
     * @param $length
     */
    public static function token($length = 10){
        return Str::random($length);
    }

    /**
     * send mail
     *
     * @param $details , $email
     */
    public static function sendMail($details,$email){
        Mail::send('mail.mail', ['details' => $details],function($message) use($email,$details){
            $message->to($email)->subject($details['subject']);
        });
    }

    /**
    * create  lang json file
    *
    * @param $code
    */
    public static function createLangJson($code = 'EN'){
        $json_data = file_get_contents(resource_path(config('constants.options.langFilePath')) . 'us.json');
        $file = strtolower($code) . '.json';
        $path = resource_path(config('constants.options.langFilePath')) . $file;
        File::put($path, $json_data);
    }

    /**
    * create  lang json file
    *
    * @param $filePath,$fileName;
    */
    public static function getLangJsonFile($filePath, $fileName){
        return resource_path($filePath) . $fileName;
    }

    /**
    * change system language
    *
    * @param $code
    */
    public static function changeLanguage($code){
        App::setLocale($code);
        session()->put('locale', $code);
    }

    /**
     * get country code
     *
     */
    public static function getCountryCode(){
        return file_get_contents(resource_path(config('constants.options.countryJsonFilePath')) . 'countries.json');
    }

    /**
     * call optimize clear
     *
     */
    public static function optimizeClear(){
        Artisan::call('optimize:clear');
    }

    /**
     * call config cache
     *
     */
    public static function configCache(){
        Artisan::call('config:cache');
    }

    /**
     * call config clear
     *
     */
    public static function configCler(){
        Artisan::call('config:clear');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function validatAbleKey(){
        $localeLang = getSystemLocale();
        $validatAbleKey = [];
        $validatAbleKey =
            [
                'title' => 'title.'.$localeLang,
            ];
        return $validatAbleKey ;
    }

    /**
     * mark delete all support
     */
    public static function markDestroySupport($ids,$model){
        app(config('constants.options.modelNamespace').$model)::whereIn('id', $ids)->delete();
    }

    public static function readNotifications($user, $request)
    {
        $user->unreadNotifications->where('id', $request->input('id'))->markAsRead();
        return true;
    }


}
