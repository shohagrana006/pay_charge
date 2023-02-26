<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\ChooseRepository;
use Illuminate\Http\Request;

class ChooseController extends Controller
{
    public $chooseRepository;

    public function __construct(ChooseRepository $chooseRepository)
    {
        $this->chooseRepository = $chooseRepository;
    }


    public function index($id = null)
    {
        if ($id == null) {

            $choose = $this->chooseRepository->index();
            if (count($choose) > 0) {
                return $this->ResponseWithSuccess("All Chooses get successfully", 200, $choose);
            } else {
                return $this->ResponseWithError('No data found', 404);
            }
        } else {
            $choose = $this->chooseRepository->getSpecificedItem($id);
            if ($choose) {
                return $this->ResponseWithSuccess("Pacakge get successfully", 200, $choose);
            } else {
                return $this->ResponseWithError('No data found', 404);
            }
        }
    }





}
