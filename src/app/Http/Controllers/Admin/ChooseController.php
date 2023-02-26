<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\ChooseRepository;
use App\Http\Requests\Admin\ChooseStoreRequest;
use Illuminate\Http\Request;

class ChooseController extends Controller
{
    /**
     * constract a method
     */
    public $chooseRepository, $user;
    public function __construct(ChooseRepository $chooseRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->user = authUser();
            return $next($request);
        });
        $this->chooseRepository = $chooseRepository;
    }


    /**
     * List of all package
     */
    public function index()
    {

        if (is_null($this->user) || !$this->user->can('faq.index')) {
            abort(403, UnauthorizedMessage());
        }
        return view('admin.pages.choose.index', [
            'chooses' => $this->chooseRepository->index()
        ]);
    }


    /**
     * create a new package
     */
    public function create()
    {

        if (is_null($this->user) || !$this->user->can('choose.create')) {
            abort(403, UnauthorizedMessage());
        }
        return view('admin.pages.choose.create');
    }

    /**
     * Store a new package information
     */
    public function store(ChooseStoreRequest $request)
    {
        if (is_null($this->user) || !$this->user->can('faq.store')) {
            abort(403, UnauthorizedMessage());
        }
        $this->chooseRepository->store($request);
        return back()->with('success', 'Message added Successfully');
    }


    /**
     *edit  a specifice package information
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('choose.edit')) {
            abort(403, UnauthorizedMessage());
        }
        return view('admin.pages.choose.edit', [
            'choose' => $this->chooseRepository->getSpecificedItem($id),
        ]);
    }

    /**
     * Update a specefic package
     *
     * @param ChooseStoreRequest $request
     */
    public function update(ChooseStoreRequest $request)
    {
        if (is_null($this->user) || !$this->user->can('choose.edit')) {
            abort(403, decode(UnauthorizedMessage()));
        }
        $this->chooseRepository->update($request);
        return back()->with('success', decode('Message Update Successfully'));
    }

    /**
     * delete a specefic user
     *
     * @param $id
     */
    public function destroy(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('choose.destroy')) {
            return json_encode([
                'success' => false,
                'message' => 'Sorry!! You Don\'t Have Access To Delete it!!'
            ]);
        }
        $response = $this->chooseRepository->delete($request);
        return json_encode($response);
    }


    /**
     * Update a specefic admin information
     *
     */
    public function statusUpdate(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('choose.edit')) {
            abort(403, decode(UnauthorizedMessage()));
        }

        $request->validate([
            'id' => 'required|exists:chooses,id'
        ], [
            'id.required' => decode('The Id Field Is Required'),
            'id.exists' => decode('Enter A Valid Id')
        ]);
        updateStatus($request->id, 'Choose');
        return back()->with('success', decode('status updated Succesfully'));
    }

    /**
     * get category data by status
     * @param $status
     */
    public function statusData($status)
    {
        if (is_null($this->user) || !$this->user->can('choose.index')) {
            abort(403, decode(UnauthorizedMessage()));
        }
        return view('admin.pages.choose.index', [
            'chooses' => getDataByStatus($status, 'Choose')
        ]);
    }

    /**
     * Mark  all selected category
     * @param Request $request
     */
    public function mark(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('choose.edit')) {
            abort(403, UnauthorizedMessage());
        }
        $request->validate(
            [
                'status' => 'required|in:Active,DeActive',
                'ids' => 'required'
            ],
            [
                'ids.required' => decode('Id is Required')
            ]
        );
        $status = request()->get('status');
        markStatusUpdate('Choose', $status, $request->ids);
        $message = 'All choose ' . $status . 'ed Successfully';
        return back()->with('success', decode($message));
    }
}
