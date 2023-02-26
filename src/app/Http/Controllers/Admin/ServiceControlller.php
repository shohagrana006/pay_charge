<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\ServiceRepository;
use App\Http\Requests\Admin\ServiceStoreRequest;
use App\Http\Requests\Admin\ServiceUpdateRequest;
use App\Models\Country;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceControlller extends Controller
{
    /**
    * constract a method
    */
    public $serviceRepository ,$user;
    public function __construct(ServiceRepository $serviceRepository)
    {
       $this->middleware(function($request,$next){
           $this->user = authUser();
           return $next($request);
       });
       $this->serviceRepository = $serviceRepository;
    }


    /**
     * List of all category
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('service.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.service.index',[
            'services' => $this->serviceRepository->index()
        ]);
    }

       /**
     * create a new category
     */
    public function create(){

        if(is_null($this->user) || !$this->user->can('service.create')){
            abort(403,UnauthorizedMessage());
        }
        $countries = Country::select('id', 'name')->get();
        $categories = ServiceCategory::select('id', 'name')->get();
        return view('admin.pages.service.create',[
            'countries' => $countries,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceStoreRequest $request)
    {
        if(is_null($this->user) || !$this->user->can('service.store')){
            abort(403,UnauthorizedMessage());
        }
        $this->serviceRepository->store($request);
        return back()->with('success','Service added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_null($this->user) || !$this->user->can('service.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.service.show',[
            'service'  => $this->serviceRepository->getSpecificedItem($id),       
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('service.edit')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.service.edit',[
            'service'    => $this->serviceRepository->getSpecificedItem($id),
            'countries'  => Country::select('id', 'name')->get(),
            'categories' => ServiceCategory::select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceUpdateRequest $request)
    {
        if(is_null($this->user) || !$this->user->can('service.edit')){
            abort(403,UnauthorizedMessage());
        }

        $this->serviceRepository->update($request);
        return back()->with('success',decode('Service Update Successfully'));
    }

    /**
     * delete a specefic user
     *
     * @param $id
     */
    public function destroy(Request $request){
        if(is_null($this->user) || !$this->user->can('service.destroy')){
            return json_encode([
                'success'=>false,
                'message'=> 'Sorry!! You Don\'t Have Access To Delete it!!'
            ]);
        }
        $response = $this->serviceRepository->delete($request);
        return json_encode($response);
    }

        /**
     * Update a specefic admin information
     *
     */
    public function serviceCategoryStatus(Request $request){
        if(is_null($this->user) || !$this->user->can('service.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }

        $request->validate([
            'id'=>'required|exists:services,id'
        ],[
            'id.required'=>decode('The Id Field Is Required'),
            'id.exists'=>decode('Enter A Valid Id')
        ]);
        updateStatus($request->id,'Service');
        return back()->with('success', decode('status updated Succesfully'));
    }

    /**
     * get category data by status
     * @param $status
     */
    public function statusData($status){
        if(is_null($this->user) || !$this->user->can('service.index')){
            abort(403,decode(UnauthorizedMessage()));
        }
        return view('admin.pages.service.index',[
            'services' => getDataByStatus($status,'Service')
        ]);
    }

     /**
     * Mark  all selected category
     * @param Request $request
     */
    public function mark(Request $request){
        if(is_null($this->user) || !$this->user->can('service.edit')){
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
       markStatusUpdate('Service', $status, $request->ids);
       $message = 'All Service '.$status.'ed Successfully';
       return back()->with('success',decode($message));
    }
}
