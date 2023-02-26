<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\CountryRepository;
use App\Http\Requests\Admin\CountryStoreRequest;
use App\Http\Requests\Admin\CountryUpdateRequest;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    /**
     * constract a method
     */
    public $countryRepository ,$user;
    public function __construct(CountryRepository $countryRepository)
    {
       $this->middleware(function($request,$next){
           $this->user = authUser();
           return $next($request);
       });
       $this->countryRepository = $countryRepository;
    }


    /**
     * List of all category
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('country.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.country.index',[
            'countries' => $this->countryRepository->index()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryStoreRequest $request)
    {

        if(is_null($this->user) || !$this->user->can('country.store')){
            abort(403,UnauthorizedMessage());
        }
        $this->countryRepository->store($request);
        return back()->with('success','Country added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('country.edit')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.country.edit',[
            'country' => $this->countryRepository->getSpecificedItem($id),        
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryUpdateRequest $request)
    {
        if(is_null($this->user) || !$this->user->can('country.edit')){
            abort(403,UnauthorizedMessage());
        }

        $this->countryRepository->update($request);
        return back()->with('success',decode('Country Update Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        if(is_null($this->user) || !$this->user->can('country.destroy')){
            return json_encode([
                'success'=>false,
                'message'=> 'Sorry!! You Don\'t Have Access To Delete it!!'
            ]);
        }
        $response = $this->countryRepository->delete($request);
        return json_encode($response);
    }

    /**
     * Update a specefic admin information
     *
     */
    public function countryStatus(Request $request){
        if(is_null($this->user) || !$this->user->can('country.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }

        $request->validate([
            'id'=>'required|exists:countries,id'
        ],[
            'id.required'=>decode('The Id Field Is Required'),
            'id.exists'=>decode('Enter A Valid Id')
        ]);
        updateStatus($request->id,'Country');
        return back()->with('success', decode('status updated Succesfully'));
    }

    /**
     * get category data by status
     * @param $status
     */
    public function statusData($status){
        if(is_null($this->user) || !$this->user->can('country.index')){
            abort(403,decode(UnauthorizedMessage()));
        }
        return view('admin.pages.country.index',[
            'countries' => getDataByStatus($status,'Country')
        ]);
    }

    /**
     * Mark  all selected category
     * @param Request $request
     */
    public function mark(Request $request){
        if(is_null($this->user) || !$this->user->can('country.edit')){
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
       markStatusUpdate('Country', $status, $request->ids);
       $message = 'All Country '.$status.'ed Successfully';
       return back()->with('success',decode($message));
    }
}