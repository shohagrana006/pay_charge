<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\PackageListRepository;
use App\Http\Requests\Admin\PackageListStoreRequest;
use App\Http\Requests\Admin\PackageListUpdateRequest;
use App\Models\PackageService;
use Illuminate\Http\Request;

class PackageListController extends Controller
{
    /**
    * constract a method
    */
   public $packageListRepository ,$user;
   public function __construct(PackageListRepository $packageListRepository)
   {
      $this->middleware(function($request,$next){
          $this->user = authUser();
          return $next($request);
      });
      $this->packageListRepository = $packageListRepository;
   }


   /**
    * List of all category
    *
    * @return \Illuminate\Http\Response
    */
   public function index(){
       if(is_null($this->user) || !$this->user->can('package.list.index')){
           abort(403,UnauthorizedMessage());
       }
       return view('admin.pages.package_list.index',[
           'packageLists' => $this->packageListRepository->index()
       ]);
   }

      /**
    * create a new category
    */
   public function create($id){
       if(is_null($this->user) || !$this->user->can('package.list.create')){
           abort(403,UnauthorizedMessage());
       }
       return view('admin.pages.package_list.create',[
            'packageService' => PackageService::with(['package', 'service'])->where('id', $id)->first()
       ]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(PackageListStoreRequest $request)
   {
       if(is_null($this->user) || !$this->user->can('package.list.store')){
           abort(403,UnauthorizedMessage());
       }

       $this->packageListRepository->store($request);
       return back()->with('success','Package List added Successfully');
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       if(is_null($this->user) || !$this->user->can('package.list.index')){
           abort(403,UnauthorizedMessage());
       }
       return view('admin.pages.package_list.details',[
           'packageList' => $this->packageListRepository->getSpecificedItem($id),       
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
       if(is_null($this->user) || !$this->user->can('package.list.edit')){
           abort(403,UnauthorizedMessage());
       }
       return view('admin.pages.package_list.edit',[
           'packageList'=> $this->packageListRepository->getSpecificedItem($id),
       ]);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(PackageListUpdateRequest $request)
   {
       if(is_null($this->user) || !$this->user->can('package.list.edit')){
           abort(403,UnauthorizedMessage());
       }

       $this->packageListRepository->update($request);
       return back()->with('success',decode('Package List Update Successfully'));
   }

   /**
    * delete a specefic user
    *
    * @param $id
    */
   public function destroy(Request $request){
       if(is_null($this->user) || !$this->user->can('package.list.destroy')){
           return json_encode([
               'success'=>false,
               'message'=> 'Sorry!! You Don\'t Have Access To Delete it!!'
           ]);
       }
       $this->packageListRepository->delete($request);
       return json_encode([
           'success'=> true,
           'message'=> 'User Delete Successfully',
       ]);
   }

    /**
     * Update a specefic admin information
     *
     */
    public function statusUpdate(Request $request){
        if(is_null($this->user) || !$this->user->can('package.list.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }

        $request->validate([
            'id'=>'required|exists:package_lists,id'
        ],[
            'id.required'=>decode('The Id Field Is Required'),
            'id.exists'=>decode('Enter A Valid Id')
        ]);
        updateStatus($request->id,'PackageList');
        return back()->with('success', decode('status updated Succesfully'));
    }


   /**
    * get category data by status
    * @param $status
    */
   public function statusData($status){
       if(is_null($this->user) || !$this->user->can('package.list.index')){
           abort(403,decode(UnauthorizedMessage()));
       }
       return view('admin.pages.package_list.index',[
           'packageLists' => getDataByStatus($status,'PackageList')
       ]);
   }

    /**
    * Mark  all selected category
    * @param Request $request
    */
   public function mark(Request $request){
       if(is_null($this->user) || !$this->user->can('package.list.edit')){
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
      markStatusUpdate('PackageList', $status, $request->ids);
      $message = 'All Package List '.$status.'ed Successfully';
      return back()->with('success',decode($message));
   }

   public function details()
   {
        if(is_null($this->user) || !$this->user->can('package.list.create')){
            abort(403,UnauthorizedMessage());
        }
        // dd(PackageService::with(['package','service', 'service.country', 'service.serviceCategory'])->latest()->get());
        return view('admin.pages.package_list.show',[
            'packageServiceLists' => PackageService::with(['package','service', 'service.country', 'service.serviceCategory'])->latest()->get(),
        ]);
   }


}
