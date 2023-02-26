<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eternal\GeneralRepository;
class ConfigSettingsController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->user = authUser();
            return $next($request);
        });

    }
    /**
     * optimize clear functuion
     */
    public function optimizeClear(){
        if(is_null($this->user) || !$this->user->can('configSettings.index')){
            abort(403,UnauthorizedMessage());
        }
        GeneralRepository::optimizeClear();
        return back()->with('success', decode('optimize cleared Successfully !!!'));

    }
}
