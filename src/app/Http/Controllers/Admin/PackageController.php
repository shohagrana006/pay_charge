<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\PackageRepository;
use App\Http\Requests\Admin\PackageStoreRequest;
use App\Http\Requests\Admin\PackageUpdateRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * constract a method
     */
    public $packageRepository ,$user;
    public function __construct(PackageRepository $packageRepository)
    {
       $this->middleware(function($request,$next){
           $this->user = authUser();
           return $next($request);
       });
       $this->packageRepository = $packageRepository;
    }


    /**
     * List of all package
     */
    public function index(){

        if(is_null($this->user) || !$this->user->can('package.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.package.index',[
            'packages' => $this->packageRepository->index()
        ]);
    }


    /**
     * create a new package
     */
    public function create(){

        if(is_null($this->user) || !$this->user->can('package.create')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.package.create', [
            'services' => Service::select('id', 'name')->get(),
        ]);
    }

   /**
    * Store a new package information
    */
    public function store(PackageStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('package.store')){
            abort(403,UnauthorizedMessage());
        }
        $this->packageRepository->store($request);
        return back()->with('success','Package added Successfully');
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_null($this->user) || !$this->user->can('package.edit')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.package.show',[
            'package' => $this->packageRepository->getSpecificedItem($id),       
        ]);
    }


    /**
     *edit  a specifice package information
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('package.edit')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.package.edit',[
            'package' => $this->packageRepository->getSpecificedItem($id),
            'services' => Service::select('id', 'name')->get(),
        ]);
    }

    /**
     * Update a specefic package
     *
     * @param PackageUpdateRequest $request
     */
    public function update(PackageUpdateRequest $request){
        if(is_null($this->user) || !$this->user->can('package.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }
        $this->packageRepository->update($request);
        return back()->with('success',decode('Package Update Successfully'));
    }

    /**
     * delete a specefic user
     *
     * @param $id
     */
    public function destroy(Request $request){
        if(is_null($this->user) || !$this->user->can('package.destroy')){
            return json_encode([
                'success'=>false,
                'message'=> 'Sorry!! You Don\'t Have Access To Delete it!!'
            ]);
        }
        $response = $this->packageRepository->delete($request);
        return json_encode($response);
    }


    /**
     * Update a specefic admin information
     *
     */
    public function statusUpdate(Request $request){
        if(is_null($this->user) || !$this->user->can('package.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }

        $request->validate([
            'id'=>'required|exists:packages,id'
        ],[
            'id.required'=>decode('The Id Field Is Required'),
            'id.exists'=>decode('Enter A Valid Id')
        ]);
        updateStatus($request->id,'Package');
        return back()->with('success', decode('status updated Succesfully'));
    }

    /**
     * get category data by status
     * @param $status
     */
    public function statusData($status){
        if(is_null($this->user) || !$this->user->can('package.index')){
            abort(403,decode(UnauthorizedMessage()));
        }
        return view('admin.pages.package.index',[
            'packages' => getDataByStatus($status,'Package')
        ]);
    }

    /**
     * Mark  all selected category
     * @param Request $request
     */
    public function mark(Request $request){
        if(is_null($this->user) || !$this->user->can('package.edit')){
            abort(403,UnauthorizedMessage());
        }
        $request->validate([
            'status' => 'required|in:Active,DeActive',
            'ids' => 'required'
        ],
        [
            'ids.required'=>decode('Id is Required')
        ]);
       $status = request()->get('status');
       markStatusUpdate('Package', $status, $request->ids);
       $message = 'All Package '.$status.'ed Successfully';
       return back()->with('success',decode($message));
    }
}
