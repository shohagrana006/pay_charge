<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\AdminRepository;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public $adminRepository;
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;    
    }

    public function index($id = null)
    {
        if($id == null){
            $admin = $this->adminRepository->index();

            if(count($admin) > 0)
            {
                return $this->ResponseWithSuccess("All admin lists get successfully", 200, $admin);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        } else{
            $admin = $this->adminRepository->admin($id);
            if($admin)
            {
                return $this->ResponseWithSuccess("Admin list get successfully", 200, $admin);
            }else{
                return $this->ResponseWithError('No data found', 404);
            }
        }
    }
}
