<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\AdminRepository;
use App\Http\Repositories\Admin\RolePermissionRepository;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * constract a method
     */
     public $adminRepository ,$user;
     public function __construct(AdminRepository $adminRepository)
     {
        $this->middleware(function($request,$next){
            $this->user = authUser();
            return $next($request);
        });
        $this->adminRepository = $adminRepository;
     }

    /**
     * List of all admins
     */
    public function index(){

        if(is_null($this->user) || !$this->user->can('admin.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.admin.index',[
            'admins' => $this->adminRepository->index()
        ]);
    }

    /**
     * Show the form of creating new admins
     */
    public function create(){
        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.admin.create',[
            'roles'=> RolePermissionRepository::getAllRoles()
        ]);
    }

   /**
    * Store a new admin information
    */
    public function store(AdminStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('admin.store')){
            abort(403,UnauthorizedMessage());
        }
        $admin = $this->adminRepository->store($request);
        if($request->role){
            $admin->assignRole($request->role);
        }
        return back()->with('success',decode('Admin added Successfully'));
     }


    /**
     * Show the from of specifice admin information
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403,UnauthorizedMessage());
        }
        $data['admin'] = $this->adminRepository->admin($id);
        $data['roles'] =  RolePermissionRepository::getAllRoles();
        return view('admin.pages.admin.edit',[
            'data' => $data
        ]);
    }

    /**
     * Update a specefic admin information
     *
     * @param AdminUpdateRequest $request
     */
    public function update(AdminUpdateRequest $request){
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }
        $admin = $this->adminRepository->update($request);
        $admin->syncRoles([$request->role]);
        return back()->with('success',decode('Admin Update Successfully'));
    }
    /**
     * Update a specefic admin information
     *
     * @param AdminUpdateRequest $request
     */
    public function statusUpdate(Request $request){
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }
        $request->validate([
            'id'=>'required|exists:admins,id'
        ],[
            'id.required'=>decode('The Id Field Is Required')
        ]);
        updateStatus($request->id,'Admin');
        return back()->with('success', decode('status updated Succesfully'));
    }

    /**
     * Update a specefic admin information
     *
     * @param AdminUpdateRequest $request
     */
    public function statusData($status){
        if(is_null($this->user) || !$this->user->can('admin.index')){
            abort(403,decode(UnauthorizedMessage()));
        }
        return view('admin.pages.admin.index',[
            'admins' => getDataByStatus($status,'Admin')
        ]);
    }

    /**
     * show a specific admin info
     * @param $id
     */
    public function show($id){
        if(is_null($this->user) || !$this->user->can('admin.index')){
            abort(403,decode(UnauthorizedMessage()));
        }
        return view('admin.pages.admin.show',[
            'admin' => $this->adminRepository->admin($id)
        ]);
    }

   /**
    * Destroy a specefic admin
    */
    public function destroy(Request $request){
        if(is_null($this->user) || !$this->user->can('admin.destroy')){
            return json_encode([
                'success'=>false,
                'message'=> 'Sorry!! You Dont Have Access To Delete it!!'
            ]);
        }
        $response = $this->adminRepository->destory($request);
        return json_encode([
            'success'=>true,
            'message'=>$response
        ]);
    }

    /**
     * Mark  all selected admin
     *
     */
    public function mark(Request $request){
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403,UnauthorizedMessage());
        }

        $request->validate([
            'status' => 'required|in:Active,DeActive',
            'ids' => 'required'
        ],[
            'ids.required'=>decode('Id is Required')
        ]);
       $status = request()->get('status');
       $this->adminRepository->markStatusUpdate(request()->get('status'),request()->get('ids'));
       $message = 'All Admin '.$status.'ed Successfully';
       return back()->with('success',decode($message));
    }

}
