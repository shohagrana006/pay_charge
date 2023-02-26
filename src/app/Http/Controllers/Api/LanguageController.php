<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\LanguageRepository;
use App\Http\Repositories\Eternal\GeneralRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public $languageRepository;
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;    
    }

    public function index($id = null)
    {
        if($id == null){
            $language = $this->languageRepository->index();
            if(count($language) > 0)
            {
                return $this->ResponseWithSuccess("All Language lists get successfully", 200, $language);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        } else{
            $language = $this->languageRepository->getSpecificLanguage($id);
            if($language)
            {
                return $this->ResponseWithSuccess("Language list get successfully", 200, $language);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        }
    }

    public function changeLanguage($code)
    {
        App::setLocale($code);
        $langCode = App::getLocale();
        session()->put('locale', $langCode);
        return $this->ResponseWithSuccess("Successfully Change", 200, $langCode);
    }

    public function locale()
    {
        $langCode = App::getLocale();
        if($langCode) {
            return $this->ResponseWithSuccess("Locale code get successfully", 200, $langCode);
        }else {
            $locale = (GeneralRepository::findElement('Language', '1', 'is_default'))->code;
            return $this->ResponseWithSuccess("Locale code get successfully", 200, $locale);
        }
    }



}
