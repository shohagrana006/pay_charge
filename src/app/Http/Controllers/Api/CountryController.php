<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function index($id = null)
    {
        if($id == null){
            
            $country = Country::with(['createdBy', 'updatedBy'])->where('status', 'Active')->latest()->get();
            if(count($country) > 0)
            {
                return $this->ResponseWithSuccess("All countries get successfully", 200, $country);
            } else {
                return $this->ResponseWithError('No data found', 404);
            }
           
        } else{

            $country = Country::with(['createdBy', 'updatedBy'])->where('id', $id)->where('status', 'Active')->first();
            if($country)
            {
                return $this->ResponseWithSuccess("Country get successfully", 200, $country);
            } else {
                return $this->ResponseWithError('No data found', 404);
            }
            
        }
    }
}
