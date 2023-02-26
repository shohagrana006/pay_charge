<?php

namespace App\Http\Controllers\General;

use App\Cp\ImageProcessor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eternal\GeneralRepository;
use Spatie\Sitemap\SitemapGenerator;
class GeneralController extends Controller
{
    /**
     * make image using size
     *
     * @param [type] $size
     * @return void
     */
    public function createImage($size=null)
    {
        ImageProcessor::createImage($size);
    }

    /**
     * make image using size
     *
     * @param [type] $size
     * @return void
     */
    public function changeLanguage($code)
    {
        GeneralRepository::changeLanguage($code);
        return redirect()->back();
    }

    /**
     * download sitemap
     */

    public function siteMap(){
        SitemapGenerator::create(url('/'))->writeToFile(public_path('sitemap.xml'));
        $filePath = public_path("sitemap.xml");
        return response()->download($filePath);
    }
}
