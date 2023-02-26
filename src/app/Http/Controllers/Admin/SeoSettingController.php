<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\SeoRepository;
use Illuminate\Http\Request;

class SeoSettingController extends Controller
{
    /**
     * constract a method
     */
    public $seoRepository ,$user;
    public function __construct(SeoRepository $seoRepository)
    {
       $this->middleware(function($request,$next){
           $this->user = authUser();
           return $next($request);
       });
       $this->seoRepository = $seoRepository;
    }

    /**
     * List of all seoSetting
     */
    public function index(){

        if(is_null($this->user) || !$this->user->can('seo.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.seo.index',[
            'seoSettings' => $this->seoRepository->index()
        ]);
    }

    /**
     * create a new seoSetting
     */
    public function create(){

        if(is_null($this->user) || !$this->user->can('seo.create')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.seo.create');
    }

   /**
    * Store a new seoSetting
    *
    * @param Request $request
    */
    public function store(Request $request){
        if(is_null($this->user) || !$this->user->can('seo.store')){
            abort(403,UnauthorizedMessage());
        }
        $request->validate([
            'name'=>'required|unique:seo_settings,name'
        ],
        [
            'name.required' => decode('Please enter Page Name'),
            'name.unique' => decode('This Name already exists, please try another'),
        ]);
        $this->seoRepository->store($request);
        return back()->with('success','SeoSetting Created Successfully');
     }


    /**
     * edit specifice seoSetting
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('seo.edit')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.seo.edit',[
            'seoSetting' => $this->seoRepository->getSpecificSeoSetting($id),
        ]);
    }

    /**
     * Update a specefic seoSetting information
     *
     * @param Request $request
     */
    public function update(Request $request){
        if(is_null($this->user) || !$this->user->can('seo.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }
        $this->seoRepository->update($request);
        return back()->with('success',decode('SeoSetting Update Successfully'));
    }


    /**
    * Destroy a specefic seoSetting
    */
    public function destroy(Request $request){
        if(is_null($this->user) || !$this->user->can('seo.destroy')){
            return json_encode([
                'success'=>false,
                'message'=> 'Sorry!! You Dont Have Access To Delete it!!'
            ]);
        }
        $this->seoRepository->delete($request);
        return json_encode([
            'success'=>true,
            'message'=> 'SeoSetting Deleted'
        ]);
    }


}
