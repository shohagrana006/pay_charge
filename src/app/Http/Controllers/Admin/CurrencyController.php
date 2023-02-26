<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\CurrencyRepository;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * constract a method
     */
    public $currencyRepository ;
    public $user;
    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->user = authUser();
            return $next($request);
        });
        $this->currencyRepository = $currencyRepository;
    }


    /**
     * get all currency
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('currency.index')) {
            abort(403, UnauthorizedMessage());
        }
        return view('admin.pages.currency.index', [
            'currencies'=>$this->currencyRepository->index(),
        ]);
    }

    /**
     * store a specific currency
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('currency.store')) {
            abort(403, UnauthorizedMessage());
        }
        $request->validate(
            [
            'name'=> 'required|unique:currencies,name',
            'symbol'=> 'required|unique:currencies,symbol',
            'rate'=> 'required',
            ],[
                'name.required' => decode('Curency Name is Required'),
                'symbol.required' => decode('Curency symbol is Required'),
                'rate.required' => decode('Curency rate is Required'),
                'name.unique' => decode('This Currency Name Is ALready Taken! Try Another'),
                'symbol.unique' => decode('This symbol Name Is ALready Taken! Try Another'),
            ]
        );
        $this->currencyRepository->store($request);
        return back()->with('success', decode('Currency Created Successfully'));
    }

    /**
     * update a specific currency
     *
     * @param $request ,$id
     */

    public function update(Request $request)
    {
        $request->validate(
            [
            'name'=> 'required|unique:currencies,name,'.$request->id,
            'symbol'=> 'required|unique:currencies,symbol,'.$request->id,
            'rate'=> 'required',
            ],[
                'name.required' => decode('Curency Name is Required'),
                'name.unique' => decode('This Currency Name Is ALready Taken! Try Another'),
                'symbol.unique' => decode('This symbol Name Is ALready Taken! Try Another'),
                'symbol.required' => decode('Curency symbol is Required'),
                'rate.required' => decode('Curency rate is Required'),
            ]
        );
        if (is_null($this->user) || !$this->user->can('currency.edit')) {
            abort(403, UnauthorizedMessage());
        }
        $this->currencyRepository->update($request);
        return back()->with('success', decode('Currency Updated Successfully'));
    }


    /**
     * Update a specefic admin information
     *
     */
    public function statusUpdate(Request $request){
        if(is_null($this->user) || !$this->user->can('currency.edit')){
            abort(403,decode(UnauthorizedMessage()));
        }

        $request->validate([
            'id'=>'required|exists:currencies,id'
        ],[
            'id.required'=>decode('The Id Field Is Required'),
            'id.exists'=>decode('Enter A Valid Id')
        ]);
        updateStatus($request->id,'Currency');
        return back()->with('success', decode('status updated Succesfully'));
    }

    /**
     * get currency data by status
     * @param $status
     */
    public function statusData($status){
        if(is_null($this->user) || !$this->user->can('currency.index')){
            abort(403,decode(UnauthorizedMessage()));
        }
        return view('admin.pages.currency.index',[
            'currencies' => getDataByStatus($status,'Currency')
        ]);
    }

   /**
    * Destroy a specefic currency
    */
    public function destroy(Request $request){
        if(is_null($this->user) || !$this->user->can('currency.destroy')){
            return json_encode([
                'success'=>false,
                'message'=> 'Sorry!! You Dont Have Access To Delete it!!'
            ]);
        }
        $data = $this->currencyRepository->delete($request);
        return json_encode($data);
    }


}
