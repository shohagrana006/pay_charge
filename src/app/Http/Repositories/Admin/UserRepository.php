<?php
namespace App\Http\Repositories\Admin;

use App\Cp\ImageProcessor;
use App\Models\User;
use Carbon\Carbon;

class UserRepository {


    /**
     * constract a method
     */
    private $user;
    public function __construct(User $user)
    {
      $this->user = $user;
    }

    /**
     * show all user
     */
    public function index(){
        return  $this->user->with(['createdBy','updatedBy'])->latest()->get();
    }

    /**
     * get specefic user
     *
     * @param $id
     */
    public function getSpecificedItem($id){
        return  $this->user->with(['createdBy','updatedBy'])->where('id',$id)->first();
    }


    /**
     * store a specif user
     *
     * @param $request
     */
    public function store($request){
        $this->user->name = $request->name;
        $this->user->email = $request->email;
        $this->user->phone = $request->phone;
        $this->user->password = passwordEncrypt($request->password);
        $this->user->status = $request->status;
        $this->user->address = json_encode($request->address);
        $this->user->last_login_time = Carbon::now();
        $this->user->created_by = authUser()->id;
        $this->user->updated_by = authUser()->id;
        if($request->hasFile('photo')){
            try{
                $this->user->profile_image = ImageProcessor::uploadFile($request->photo,'user_profile');
            }catch (\Exception $exp){

            }
        }
        $this->user->save();
    }


    /**
     * update user information
     */
    public function update($request){
        $user = $this->getSpecificedItem($request->id);
        $user->status = $request->status;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->updated_by = authUser()->id;
        $user->phone = $request->phone;
        $user->address = json_encode($request->address);
        if($request->hasFile('photo')){
            ImageProcessor::deleteFile($user->profile_image,'user_profile');
            try{
              $user->profile_image = ImageProcessor::uploadFile($request->photo,'user_profile');
            }catch (\Exception $exp){

            }
        }
        $user->save();
    }


    /**
     * destroy user
     */
    public function delete($request){
        $user =  $this->getSpecificedItem($request->id);
        if($user->profile_image){
            ImageProcessor::deleteFile($user->profile_image, 'user_profile');
        }
        $user->delete();
    }

    /**
     * status Update
     *
     * @param $request
     */
    public function status($request)
    {
        updateStatus($request->id, "User");
    }


}
