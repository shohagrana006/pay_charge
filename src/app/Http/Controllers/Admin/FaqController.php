<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\FaqRepository;
use App\Http\Requests\Admin\FaqStoreRequest;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * constract a method
     */
    public $faqRepository ,$user;
    public function __construct(FaqRepository $faqRepository)
    {
       $this->middleware(function($request,$next){
           $this->user = authUser();
           return $next($request);
       });
       $this->faqRepository = $faqRepository;
    }


    /**
     * List of all package
     */
    public function index(){

        if(is_null($this->user) || !$this->user->can('faq.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.faq.index',[
            'faqs' => $this->faqRepository->index()
        ]);
    }


    /**
     * create a new package
     */
    public function create(){

        if(is_null($this->user) || !$this->user->can('faq.create')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.faq.create');
    }

   /**
    * Store a new package information
    */
    public function store(FaqStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('faq.store')){
            abort(403,UnauthorizedMessage());
        }
        $this->faqRepository->store($request);
        return back()->with('success','FAQ added Successfully');
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($this->user) || !$this->user->can('faq.index')) {
            abort(403, UnauthorizedMessage());
        }
        return view('admin.pages.faq.show', [
            'faq' => $this->faqRepository->getSpecificedItem($id),
        ]);
    }


    /**
     *edit  a specifice package information
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('faq.edit')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.faq.edit',[
            'faq' => $this->faqRepository->getSpecificedItem($id),
        ]);
    }

    /**
     * Update a specefic package
     *
     * @param FaqStoreRequest $request
     */
    public function update(FaqStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('faq.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }
        $this->faqRepository->update($request);
        return back()->with('success',decode('Faq Update Successfully'));
    }

    /**
     * delete a specefic user
     *
     * @param $id
     */
    public function destroy(Request $request){
        if(is_null($this->user) || !$this->user->can('faq.destroy')){
            return json_encode([
                'success'=>false,
                'message'=> 'Sorry!! You Don\'t Have Access To Delete it!!'
            ]);
        }
        $response = $this->faqRepository->delete($request);
        return json_encode($response);
    }


    /**
     * Update a specefic admin information
     *
     */
    public function statusUpdate(Request $request){
        if(is_null($this->user) || !$this->user->can('faq.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }

        $request->validate([
            'id'=>'required|exists:faqs,id'
        ],[
            'id.required'=>decode('The Id Field Is Required'),
            'id.exists'=>decode('Enter A Valid Id')
        ]);
        updateStatus($request->id,'Faq');
        return back()->with('success', decode('status updated Succesfully'));
    }

    /**
     * get category data by status
     * @param $status
     */
    public function statusData($status){
        if(is_null($this->user) || !$this->user->can('faq.index')){
            abort(403,decode(UnauthorizedMessage()));
        }
        return view('admin.pages.faq.index',[
            'faqs' => getDataByStatus($status,'Faq')
        ]);
    }

    /**
     * Mark  all selected category
     * @param Request $request
     */
    public function mark(Request $request){
        if(is_null($this->user) || !$this->user->can('faq.edit')){
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
       markStatusUpdate('Faq', $status, $request->ids);
       $message = 'All faq '.$status.'ed Successfully';
       return back()->with('success',decode($message));
    }
}
