<?php
namespace App\Http\Repositories\Admin;

use App\Cp\ImageProcessor;
use App\Http\Repositories\Eternal\GeneralRepository;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminRepository
{
    public $admin;
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * get all admin
     */
    public function  index(){
        return  $this->admin::with('roles')->get();
    }

    /**
     * create a new admin
     *
     * @param [type] $request
     */
    public function store($request)
    {
        $this->admin->name = $request->name;
        $this->admin->email = $request->email;
        $this->admin->user_name = $request->user_name;
        $this->admin->phone = $request->phone;
        $this->admin->password = passwordEncrypt($request->password);
        $this->admin->status = $request->status;
        $this->admin->created_by = authUser()->id;
        if($request->address){
            $address = json_encode($request->address);
        }
        else{
            $address = json_encode(getEmptyAddress());
        }
        $this->admin->address = ($address);
        if($request->hasFile('profile_image')){
            try{
                $this->admin->profile_image = ImageProcessor::uploadFile($request->profile_image,'admin_profile');
            }catch (\Exception $exp){

            }
        }
        $this->admin->save();
        return $this->admin;
    }


    /**
     * update a specific admin
     *
     * @param [type] $request
     */
    public function update($request)
    {
        $admin = GeneralRepository::findElement('Admin', $request->id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->user_name = $request->user_name;
        $admin->phone = $request->phone;
        $admin->updated_by = authUser()->id;
        $admin->status = $request->status;
        if($request->address){
            $address = json_encode($request->address);
        }
        else{
            $address = json_encode(getEmptyAddress());
        }
        $admin->address =  $address;
        if($request->hasFile('profile_image')){
            if($admin->profile_image){
                ImageProcessor::deleteFile($admin->profile_image,'admin_profile');
            }
            try{
                $admin->profile_image = ImageProcessor::uploadFile($request->profile_image,'admin_profile');
            }catch (\Exception $exp){

            }
        }
        $admin->save();
        return $admin;
    }

    /**
     * destory a specific admin
     *
     * @param [type] $request
     */
    public function destory($request)
    {
        $admin = GeneralRepository::findElement('Admin', $request->id);
        $admin->roles()->detach();
        if($admin->profile_image){
            ImageProcessor::deleteFile($admin->profile_image, 'admin_profile');
        }
        $admin->delete();
        return decode(('Admin Deleted successfully'));
    }


    /**
     * This function return specifice admin
     */
    public function admin($id){
       return $this->admin::with('roles')->where('id',$id)->first();
    }

    /**
     * mark active or decative a status
     *
     * @param mixed $status,$id
     */
    public function markStatusUpdate($status,$ids){
        $this->admin::whereIn('id',$ids)->update([
            'status'=>$status
        ]);
    }

}
