<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\ServiceCategoryRepository;
use App\Http\Requests\Admin\ServiceCategoryStoreRequest;
use App\Http\Requests\Admin\ServiceCategoryUpdateRequest;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    /**
     * constract a method
     */
    public $serviceCategoryRepository ,$user;
    public function __construct(ServiceCategoryRepository $serviceCategoryRepository)
    {
       $this->middleware(function($request,$next){
           $this->user = authUser();
           return $next($request);
       });
       $this->serviceCategoryRepository = $serviceCategoryRepository;
    }


    /**
     * List of all category
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('service.category.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.service_category.index',[
            'serviceCategories' => $this->serviceCategoryRepository->index()
        ]);
    }

       /**
     * create a new category
     */
    public function create(){

        if(is_null($this->user) || !$this->user->can('service.category.create')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.service_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceCategoryStoreRequest $request)
    {
        if(is_null($this->user) || !$this->user->can('service.category.store')){
            abort(403,UnauthorizedMessage());
        }
        $this->serviceCategoryRepository->store($request);
        return back()->with('success','Service Category added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('service.category.edit')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.service_category.edit',[
            'serviceCategory' => $this->serviceCategoryRepository->getSpecificedItem($id),        
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceCategoryUpdateRequest $request)
    {
        if(is_null($this->user) || !$this->user->can('service.category.edit')){
            abort(403,UnauthorizedMessage());
        }

        $this->serviceCategoryRepository->update($request);
        return back()->with('success',decode('Service Category Update Successfully'));
    }

    /**
     * delete a specefic user
     *
     * @param $id
     */
    public function destroy(Request $request){
        if(is_null($this->user) || !$this->user->can('service.category.destroy')){
            return json_encode([
                'success'=>false,
                'message'=> 'Sorry!! You Don\'t Have Access To Delete it!!'
            ]);
        }
        $response = $this->serviceCategoryRepository->delete($request);
        return json_encode($response);
    }

        /**
     * Update a specefic admin information
     *
     */
    public function serviceCategoryStatus(Request $request){
        if(is_null($this->user) || !$this->user->can('service.category.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }

        $request->validate([
            'id'=>'required|exists:service_categories,id'
        ],[
            'id.required'=>decode('The Id Field Is Required'),
            'id.exists'=>decode('Enter A Valid Id')
        ]);
        updateStatus($request->id,'ServiceCategory');
        return back()->with('success', decode('status updated Succesfully'));
    }

    /**
     * get category data by status
     * @param $status
     */
    public function statusData($status){
        if(is_null($this->user) || !$this->user->can('service.category.index')){
            abort(403,decode(UnauthorizedMessage()));
        }
        return view('admin.pages.service_category.index',[
            'serviceCategories' => getDataByStatus($status,'ServiceCategory')
        ]);
    }

     /**
     * Mark  all selected category
     * @param Request $request
     */
    public function mark(Request $request){
        if(is_null($this->user) || !$this->user->can('service.category.edit')){
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
       markStatusUpdate('ServiceCategory', $status, $request->ids);
       $message = 'All Service Category '.$status.'ed Successfully';
       return back()->with('success',decode($message));
    }
}
