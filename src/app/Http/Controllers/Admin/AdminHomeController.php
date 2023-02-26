<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eternal\GeneralRepository;
class AdminHomeController extends Controller
{


    /**
     * Construct method
     */
    public $user;
    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->user = authUser();
            return $next($request);
        });
    }

    /**
     * admin home page
     *
     */
    public function index(){
        return view('admin.pages.home.index');
    }

     /**
     * show admin home
     */
    public function readNotification(Request $request){
        if(is_null($this->user) || !$this->user->can('admin.index')){
            abort(403, UnauthorizedMessage());
        }
        $response = GeneralRepository::readNotifications($this->user,$request);
        return json_encode([
            'response' => $response
        ]);
    }

}
