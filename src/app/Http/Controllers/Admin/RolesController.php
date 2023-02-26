<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\RolePermissionRepository;
use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;
use Illuminate\Http\Request;
class RolesController extends Controller
{
    /**
     * Construct method
     */
    public $user;
    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->user =  authUser();
            return $next($request);
        });
    }
    /**
     * Display all roles
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('role.index')){
            abort(403, UnauthorizedMessage());
        }
        $data['roles'] = RolePermissionRepository::getAllRoles();
        $data['permissions'] = RolePermissionRepository::allPermission();
        return view('admin.pages.roles.index',[
            'data' => $data
        ]);
    }

    /**
     * store the new role in
     */
    public function store(RoleStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('role.store')){
            abort(403, UnauthorizedMessage());
        }
        RolePermissionRepository::createRoles($request);
        return back()->with('success', decode('Role and Permissions Create Successfully'));

    }

     /**
      * Update the Speceific role
      */
      public function update(RoleUpdateRequest $request){
        if(is_null($this->user) || !$this->user->can('role.edit')){
            abort(403, UnauthorizedMessage());
        }
        RolePermissionRepository::updateRoles($request);
        return back()->with('success', decode('Role and Permission Update Successfully'));
      }

     /**
      * Update the Speceific role status
      */
      public function statusUpdate(Request $request){
        if(is_null($this->user) || !$this->user->can('role.edit')){
            abort(403, UnauthorizedMessage());
        }
        $request->validate([
            'id'=>'required|exists:roles,id'
        ],[
            'id.required'=>decode('The Id Field Is Required')
        ]);
        RolePermissionRepository::updateRolestatus($request);
        return back()->with('success', decode('Role ststus updated Succesfully'));
      }

      /**
       * Destroy the specefic role
       */
      public function destroy(Request $request){
        if(is_null($this->user) || !$this->user->can('role.destroy')){
            return json_encode([
                'success'=>false,
                'message'=> 'Sorry!! You Dont Have Access To Delete it!!'
            ]);
        }
        $response  = RolePermissionRepository::roleDestroy($request);
        if($response == "deleted"){
            $success = true;
            $message = decode('Roles Deleted');
        }
        else{
            $success = false;
            $message = $response;
        }
        return json_encode(
            [
            'success'=> $success,
            'message'=> $message
            ]
        );

      }

}
