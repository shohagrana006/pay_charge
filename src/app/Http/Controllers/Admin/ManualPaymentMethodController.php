<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\ManualPaymentRepository;
use App\Http\Requests\Admin\ManualPaymentStoreRequest;
use App\Http\Requests\Admin\ManualPaymentUpdateRequest;
use Illuminate\Http\Request;

class ManualPaymentMethodController extends Controller
{
   
    /**
    * constract a method
    */
    public $manualPaymentRepository ,$user;
    public function __construct(ManualPaymentRepository $manualPaymentRepository)
    {
       $this->middleware(function($request,$next){
           $this->user = authUser();
           return $next($request);
       });
       $this->manualPaymentRepository = $manualPaymentRepository;
    }


    /**
     * List of all category
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('payment.manual.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.manual_payment.index',[
            'manualPayments' => $this->manualPaymentRepository->index()
        ]);
    }

       /**
     * create a new category
     */
    public function create(){

        if(is_null($this->user) || !$this->user->can('payment.manual.create')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.manual_payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManualPaymentStoreRequest $request)
    {
        if(is_null($this->user) || !$this->user->can('payment.manual.store')){
            abort(403,UnauthorizedMessage());
        }
        $this->manualPaymentRepository->store($request);
        return back()->with('success','Manual Payment added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_null($this->user) || !$this->user->can('payment.manual.edit')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.manual_payment.show',[
            'manualPayment' => $this->manualPaymentRepository->getSpecificedItem($id),       
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
        if(is_null($this->user) || !$this->user->can('payment.manual.edit')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.manual_payment.edit',[
            'manualPayment' => $this->manualPaymentRepository->getSpecificedItem($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManualPaymentUpdateRequest $request)
    {
        if(is_null($this->user) || !$this->user->can('payment.manual.edit')){
            abort(403,UnauthorizedMessage());
        }

        $this->manualPaymentRepository->update($request);
        return back()->with('success',decode('Manual Payment Update Successfully'));
    }

    /**
     * delete a specefic user
     *
     * @param $id
     */
    public function destroy(Request $request){
        if(is_null($this->user) || !$this->user->can('payment.manual.destroy')){
            return json_encode([
                'success'=>false,
                'message'=> 'Sorry!! You Don\'t Have Access To Delete it!!'
            ]);
        }
        $this->manualPaymentRepository->delete($request);
        return json_encode([
            'success'=> true,
            'message'=> 'User Delete Successfully',
        ]);
    }

        /**
     * Update a specefic admin information
     *
     */
    public function serviceCategoryStatus(Request $request){
        if(is_null($this->user) || !$this->user->can('payment.manual.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }

        $request->validate([
            'id'=>'required|exists:manual_payments,id'
        ],[
            'id.required'=>decode('The Id Field Is Required'),
            'id.exists'=>decode('Enter A Valid Id')
        ]);
        updateStatus($request->id,'ManualPayment');
        return back()->with('success', decode('status updated Succesfully'));
    }

    /**
     * get category data by status
     * @param $status
     */
    public function statusData($status){
        if(is_null($this->user) || !$this->user->can('payment.manual.index')){
            abort(403,decode(UnauthorizedMessage()));
        }
        return view('admin.pages.manual_payment.index',[
            'manualPayments' => getDataByStatus($status,'ManualPayment')
        ]);
    }

     /**
     * Mark  all selected category
     * @param Request $request
     */
    public function mark(Request $request){
        if(is_null($this->user) || !$this->user->can('payment.manual.edit')){
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
       markStatusUpdate('ManualPayment', $status, $request->ids);
       $message = 'All manual payment '.$status.'ed Successfully';
       return back()->with('success',decode($message));
    }
}
