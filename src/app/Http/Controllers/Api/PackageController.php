<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\PackageRepository;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    


    public function index($id = null)
    {
        if($id == null){

            $pacakge = Package::with(['createdBy', 'updatedBy', 'servicePackage'])->active()->latest()->get();

            if(count($pacakge) > 0)
            {
                return $this->ResponseWithSuccess("All pacakges get successfully", 200, $pacakge);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        } else{
            $pacakge = Package::with(['createdBy', 'updatedBy', 'servicePackage'])->where('id', $id)->active()->latest()->first();
            if($pacakge)
            {
                return $this->ResponseWithSuccess("Pacakge get successfully", 200, $pacakge);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        }
    }





}
