<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Repositories\Admin\UserRepository;
use App\Http\Requests\Admin\UserStoreRequest;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Construct method
     */
    public $user,$userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = authUser();
            return $next($request);
        });
        $this->userRepository = $userRepository;
    }

    /**
     * show all user
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403, UnauthorizedMessage());
        }
        return view('admin.pages.user.index',[
            'users' => $this->userRepository->index()
        ]);
    }

    /**
     * show create new user form
     */
    public function create(){
        if(is_null($this->user) || !$this->user->can('user.create')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.user.create');
    }

    /**
     * Store a new user
     *
     * @param $request
     */
    public function store(UserStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('user.create')){
            abort(403,UnauthorizedMessage());
        }

        $this->userRepository->store($request);
        return back()->with('success','User Create Successfully');
    }

    /**
     * show a sepecefiec user
     *
     * @param $id
     */
    public function show($id){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.user.show',[
            'user' => $this->userRepository->getSpecificedItem($id)
        ]);
    }

    /**
     * show a edit form of  a user
     *
     * @param $id
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('user.edit')){
            abort(403,UnauthorizedMessage());
        }
        return view('admin.pages.user.edit',[
            'user' => $this->userRepository->getSpecificedItem($id)
        ]);
    }

    /**
     * update a specefied user
     *
     * @param $request
     */
    public function update(UserUpdateRequest $request){
        if(is_null($this->user) || !$this->user->can('user.edit')){
            abort(403,UnauthorizedMessage());
        }
        $this->userRepository->update($request);
        return back()->with('success','user Update Successfully');
    }

    /**
     * delete a specefic user
     *
     * @param $id
     */
    public function destroy(Request $request){
        if(is_null($this->user) || !$this->user->can('user.destroy')){
            return json_encode([
                'success'=>false,
                'message'=> 'Sorry!! You Dont Have Access To Delete it!!'
            ]);
        }
        $this->userRepository->delete($request);
        return json_encode([
            'success'=> true,
            'message'=> 'User Delete Successfully',
        ]);
    }

     /**
     * status update a specefic user
     *
     * @param $request
     */
    public function updateStatus(Request $request){
        $request->validate([
            'id'=>'required|exists:users,id'
        ],[
            'id.required'=>decode('The Id Field Is Required')
        ]);
        $this->userRepository->status($request);
        return back()->with('success','Status Updated Successfulyy');
    }

      /**
     * Update a specefic user information
     *
     * @param $status
     */
    public function statusData($status){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403,decode(UnauthorizedMessage()));
        }
        return view('admin.pages.user.index',[
            'users' => getDataByStatus($status,'User')
        ]);
    }

    /**
     * Mark  all selected user
     *
     */
    public function mark(Request $request){
        if(is_null($this->user) || !$this->user->can('user.edit')){
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
       markStatusUpdate('User', $status, $request->ids);
       $message = 'All User '.$status.'ed Successfully';
       return back()->with('success',decode($message));
    }
}
