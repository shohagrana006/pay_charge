<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageList;
use App\Models\PackageService;
class PackageServiceController extends Controller
{

    public function index($id){
        
        $data['pacakge'] = Package::where('id', $id)->active()->first();
        if($data['pacakge']){
            $packageServices = PackageService::where('package_id', $data['pacakge']->id)->pluck('id')->toArray();
            $data['list'] = PackageList::whereIn('package_service_id', $packageServices)->get();
            return $this->ResponseWithSuccess("Pacakge And all list get successfully", 200, $data);
        } else{
            return $this->ResponseWithError('No data found', 404);
        }
    }



}
