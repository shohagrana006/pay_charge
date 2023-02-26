<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\ManualPaymentRepository;
use Illuminate\Http\Request;

class ManualPaymentMethodController extends Controller
{
   
    public $manualPaymentRepository;
    public function __construct(ManualPaymentRepository $manualPaymentRepository)
    {
        $this->manualPaymentRepository = $manualPaymentRepository;    
    }

    public function index($id = null)
    {
        if($id == null){
            $manualPayment = $this->manualPaymentRepository->index();

            if(count($manualPayment) > 0)
            {
                return $this->ResponseWithSuccess("All Manual Payment get successfully", 200, $manualPayment);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        } else{
            $manualPayment = $this->manualPaymentRepository->getSpecificedItem($id);
            if($manualPayment)
            {
                return $this->ResponseWithSuccess("Manual Payment get successfully", 200, $manualPayment);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        }
    }






}
