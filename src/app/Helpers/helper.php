<?php

use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use App\Http\Repositories\Eternal\GeneralRepository;
use App\Models\GeneralSettings;
use App\Models\Mail;
use App\Models\Package;
use App\Models\PaymentMethod;
use App\Models\SeoSetting;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Config;



/**
 * check if guard is authenticate or not
 *
 * @param string $guardName
 * @return boolean
 */
function authCheck($guardName = 'web'){
    if(Auth::guard($guardName)->check()){
        return true;
    }
    else{
        return false;
    }
}   

/**
 * get auth user info
 *
 * @param $guardName
 * @return $AuthUser
 */
function authUser($guardName = 'admin'){
    return Auth::guard($guardName)->User();
}


/**
 * get auth user info
 *
 * @param $text
 */
function makeSlug($text){
    return preg_replace('/\s+/u', '-', trim($text));
}


/**
 * get auth user info
 *
 * @param $guardName
 * @return $AuthUser
 */
function getTotalPermission(){
    return Permission::count();
}

/**
* password hasing method
*
* @param $password
*/
function passwordEncrypt($password = '123456789'){
    return Hash::make($password);
}

/**
* pagination number method
*
* @param $number
*/
function paginationNumber(){
    return generalSetting()->pagination_number;
}

/**
 * genarate random token
 *
 * @param $length
 */
function token($length = 10){
    return Str::random($length);
}

/**
 * genarate random token
 *
 * @param $length
 */
function fileFormat($type = 'image'){
    $imageFormat = ['jpg','jpeg','png','jfif','webp'];
    $fileFormat = ['pdf','doc','exel'];
    if($type = 'image'){
        return $imageFormat;
    }
    else{
        return $fileFormat;
    }
}

/**
 *
 * @param mixed $imageFile ,$size
 */
function displayImage($imageFile, $size=null){
    if(file_exists($imageFile) && is_file($imageFile)) {
        return asset($imageFile);
    }
    if($size){
        return route('make.image',$size);
    }
}

/**
 * get general setting
 *
 */
function getSystemLanguage(){
    return GeneralRepository::findElement('Language', 'Active','status','get');
}


/**
 * language translation
 *
 * @param [string] $keyWord
 * @param [string] $langCode
 * @return $data[$lang_key]
 */
function decode($keyWord, $langCode = null,){
try{
    if ($langCode == null) {
        $langCode = App::getLocale();
        if($langCode ==  'En'){
            $langCode  = 'us';
        }
    } 

    $lang_key = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($keyWord)));
    if($langCode){
        $localeTranslateData = getLangFile($langCode);
        $localeTranslateDataArray = json_decode($localeTranslateData,true);
        if(is_array($localeTranslateDataArray)){
            if(!array_key_exists($lang_key,$localeTranslateDataArray)){
                $localeTranslateDataArray[$lang_key] = $keyWord;
                $path = resource_path(config('constants.options.langFilePath')).$langCode.'.json';
                File::put($path, json_encode($localeTranslateDataArray));
            }
            $data = $localeTranslateDataArray[$lang_key] ;
        }
        else{
            $data = $keyWord;
        }
    }
    else{
        $data = $keyWord;
    }
}
catch (\Exception $ex) {
    $data = $keyWord;
}
return $data;
}

/**
 * get lang file
 *
 */
function getLangFile($langCode){
    return file_get_contents(resource_path(config('constants.options.langFilePath')). $langCode.'.json');
}

/**
 * status update
 * @param $id,$modelName
 *
 */
function updateStatus($id,$modelName){
    $data = GeneralRepository::findElement($modelName,$id,'id');
    if($data->status == 'Active'){
        $data->status = 'DeActive';
    }
    else{
        $data->status = 'Active';
    }
    if($data->updated_by){
        $data->updated_by = authUser()->id;
    }
    $data->save();
}

/**
 * status update by type
 * @param $id,$modelName ,$type
 *
 */
function updateStatusByType($id,$modelName ,$type){
    $data = GeneralRepository::findElement($modelName,$id,'id');
    if($data->$type== 'Active'){
        $data->$type = 'DeActive';
    }
    else{
        $data->$type = 'Active';
    }
    if($data->updated_by){
        $data->updated_by = authUser()->id;
    }
    $data->save();
}

/**
 * Mark status update
 *
 * @param $modelName, $status
 */
function markStatusUpdate($modelName, $status, $ids){
app(config('constants.options.modelNamespace').$modelName)::whereIn('id', $ids)->update([
    'status' => $status
]);
}

/**
 * get data by status
 * @param $status,$modelName
 *
 */
function getDataByStatus($status,$modelName){
    $data = GeneralRepository::findElement($modelName,$status,'status','get');
    return $data;
}

/**
 * count a specific model data
 * @param $modelName
 *
 */
function countModelData($modelName){
    return app(config('constants.options.modelNamespace').$modelName)::count();
}

/**
 * general setting helper function
 *
 */
function generalSetting(){
    return GeneralSettings::first();
}

/**
 * UnauthorizedMessage function
 */
function UnauthorizedMessage($message='Unauthorized access'){
    return decode($message);
}

/**
 * UnauthorizedMessage function
 */
function getActiveMailCredential(){
    return Mail::where('status','Active')->first();
}


/**
 * get empty address
 */
function getEmptyAddress(){
    $address['city'] ='';
    $address['zip_code'] ='';
    $address['postal_code'] ='';
    $address['state'] ='';
    $address['address'] ='';
    return $address;
}
/**
 * get Mail Trap Setup
 */
function getMailTrapSetup(){
    $fromAddress['address'] = 'test@igensolutionsltd.com';
    $fromAddress['name'] = 'test@igensolutionsltd.com';
    $driverInfo['driver'] ='smtp';
    $driverInfo['host'] ='smtp.mailtrap.io';
    $driverInfo['port'] ='2525';
    $driverInfo['from'] = ($fromAddress);
    $driverInfo['encryption'] = 'tls';
    $driverInfo['username'] = 'c897d544de221f';
    $driverInfo['password'] = '7e09909de881c2';
    return $driverInfo;
}

/**
 * get sandgrid Setup
 */
function getSandGridSetup(){
    $fromAddress['address'] = '';
    $fromAddress['name'] = '';
    $driverInfo['driver'] ='';
    $driverInfo['host'] ='';
    $driverInfo['port'] ='';
    $driverInfo['from'] = ($fromAddress);
    $driverInfo['encryption'] = '';
    $driverInfo['username'] = '';
    $driverInfo['password'] = '';
    return $driverInfo;
}

/**
 * get mail config
 */
function mailConfig(){
    return  Mail::get();
}

/**
 * get mail from address
 */
function getMailFromAddress(){
    return (Config::get('mail')['from']);
}

/**
 * get system current language
 *
 */
function getSystemLocale(){
    if(session()->get('locale')){
        return session()->get('locale');
    }
    else{
        return App::getLocale();
    }
}

/**
 * page seo by page name
 */
function pageSeo($name){
    $seoSetting = SeoSetting::where('name',$name)->first();
    if($seoSetting != null){
        return  $seoSetting;
    }
}


/**
 * get all active package
 */
function packages(){
    return Package::with(['packageDetails'])->where('status','Active')->get();
}

/**
 * get all active package
 */
function getPackageDetails(){
    $details = ['Changing Visible URL','Allow Image Upload','Phone Number,Email,and Address','Social Media Contacts','Bypass Redirection Page','Bypass Details Page','Deep Link'];
    return $details;
}
/**
 * get all active package
 */
function countRating($link , $number){
    return $link->linkReview->where('total_star',$number)->count();
}

/**
* get active payment methods
*/
function paymentMethods(){
    return PaymentMethod::where('status','Active')->get();
}

/**
* SSLCommerz method
*/
function build_post_fields( $data,$existingKeys='',&$returnArray=[]){
    if(($data instanceof CURLFile) or !(is_array($data) or is_object($data))){
        $returnArray[$existingKeys]=$data;
        return $returnArray;
    }
    else{
        foreach ($data as $key => $item) {
            build_post_fields($item,$existingKeys?$existingKeys."[$key]":$key,$returnArray);
        }
        return $returnArray;
    }
}

/**
* Summary of trxNumber
*/
function trxNumber(){
    $random = strtoupper(Str::random(10));
    return $random;
}

/**
 * Template body text replace
 */
function templateReplace($template, $arr)
{
    $templateResult = $template->body;
    foreach($arr as $key => $value){
        $templateResult = str_replace("{{" . $key . "}}", $value, $templateResult);
    }
    return $templateResult;
  
}

