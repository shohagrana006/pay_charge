<?php
namespace App\Http\Repositories\Admin;

use App\Cp\ImageProcessor;
use App\Http\Repositories\Eternal\GeneralRepository;
use App\Models\Admin;
use App\Models\Currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class CurrencyRepository
{
    public $currency;
    public function __construct(Currency $currency){
        $this->currency = $currency;
    }

    /**
     * show all currency
     */
    public function index(){
        return  $this->currency->with(['createdBy','updatedBy'])->latest()->get();
    }

    /**
     * get specific currency
     */
    public function getSpecificedItem($id){
        return  $this->currency->where('id',$id)->first();
    }



    /**
     * store a specific currency
     *
     * @param $request
     */
    public function store($request){
        $this->currency->name = $request->name;
        $this->currency->created_by = authUser()->id;
        $this->currency->symbol = $request->symbol;
        $this->currency->rate = $request->rate;
        $this->currency->save();
    }


    /**
     * update currency information
     */
    public function update($request){

        $currency = $this->getSpecificedItem($request->id);
        $currency->name = $request->name;
        $currency->updated_by = authUser()->id;
        $currency->symbol = $request->symbol;
        $currency->rate = $request->rate;
        $currency->save();
    }


    /**
     * destroy currency
     * @param $request
     */
    public function delete($request){
        $currency =  $this->getSpecificedItem($request->id);
        if(count($currency->paymentMethod) > 0){
            $data['error'] = false;
            $data['message'] =  decode('Can Not Deleted !! This Currency Has Payment Method !!');
        }else{
            $currency->delete();
            $data['success'] =  true;
            $data['message'] =  decode('Deleted');
        }
        return $data;
    }

    /**
     * status Update
     *
     * @param $request
     */
    public function status($request)
    {
        updateStatus($request->id, "Currency");
    }



}
