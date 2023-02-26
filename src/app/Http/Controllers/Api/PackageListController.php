<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\PackageListRepository;
use Illuminate\Http\Request;

class PackageListController extends Controller
{
    
    
    public $packageListRepository;
    public function __construct(PackageListRepository $packageListRepository)
    {
        $this->packageListRepository = $packageListRepository;    
    }

    public function index($id = null)
    {
        if($id == null){
            $pacakgeList = $this->packageListRepository->index();
            if(count($pacakgeList) > 0)
            {
                return $this->ResponseWithSuccess("All pacakge lists get successfully", 200, $pacakgeList);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        } else{
            $pacakgeList = $this->packageListRepository->getSpecificedItem($id);
            if($pacakgeList)
            {
                return $this->ResponseWithSuccess("Pacakge list get successfully", 200, $pacakgeList);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        }
    }






}
