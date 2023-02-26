<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;    
    }

    public function index($id = null)
    {
        if($id == null){
            $user = $this->userRepository->index();

            if(count($user) > 0)
            {
                return $this->ResponseWithSuccess("All pacakge lists get successfully", 200, $user);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        } else{
            $pacakgeList = $this->userRepository->getSpecificedItem($id);
            if($pacakgeList)
            {
                return $this->ResponseWithSuccess("Pacakge list get successfully", 200, $pacakgeList);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        }
    }
}
