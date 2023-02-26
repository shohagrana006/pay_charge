<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{

    public function index($id = null)
    {
        if($id == null){

            $serviceCategory = ServiceCategory::with(['createdBy', 'updatedBy'])->where('status', 'Active')->latest()->get();
            if (count($serviceCategory) > 0) {
                return $this->ResponseWithSuccess("All Service Category get successfully", 200, $serviceCategory);
            } else {
                return $this->ResponseWithError('No data found', 404);
            }

        } else{
            $serviceCategory = ServiceCategory::with(['createdBy', 'updatedBy'])->where('id', $id)->where('status', 'Active')->first();
            if ($serviceCategory) {
                return $this->ResponseWithSuccess("Service Category get successfully", 200, $serviceCategory);
            } else {
                return $this->ResponseWithError('No data found', 404);
            }
        }
    }




}
