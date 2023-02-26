<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index($id = null)
    {
        if($id == null){
            $service = Service::with(['createdBy', 'updatedBy', 'country', 'serviceCategory'])->where('status', 'Active')->latest()->get();

            if(count($service) > 0)
            {
                return $this->ResponseWithSuccess("All services get successfully", 200, $service);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        } else{
            $service = Service::with(['createdBy', 'updatedBy', 'country', 'serviceCategory'])->where('id', $id)->where('status', 'Active')->first();
            if($service)
            {
                return $this->ResponseWithSuccess("Service get successfully", 200, $service);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        }
    }




}
