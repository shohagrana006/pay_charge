<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\MailTemplateRepository;
use App\Http\Requests\Admin\MailTemplateUpdateRequest;
use Illuminate\Http\Request;

class MailTemplateController extends Controller
{
    /**
     * constract a method
     */
    public $mailTemplateRepository, $user;
    public function __construct(MailTemplateRepository $mailTemplateRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->user = authUser();
            return $next($request);
        });
        $this->mailTemplateRepository = $mailTemplateRepository;
    }


    /**
     * List of all package
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('generalSettings.index')) {
            abort(403, UnauthorizedMessage());
        }
        return view('admin.pages.mail_template.index', [
            'mailTemplates' => $this->mailTemplateRepository->index()
        ]);
    }



    /**
     *edit  a specifice package information
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('generalSettings.index')) {
            abort(403, UnauthorizedMessage());
        }
        return view('admin.pages.mail_template.edit', [
            'mailTemplate' => $this->mailTemplateRepository->getSpecificedItem($id),
        ]);
    }

    /**
     * Update a specefic package
     *
     * @param MailTemplateUpdateRequest $request
     */
    public function update(MailTemplateUpdateRequest $request)
    {
        if (is_null($this->user) || !$this->user->can('generalSettings.index')) {
            abort(403, decode(UnauthorizedMessage()));
        }
        $this->mailTemplateRepository->update($request);
        return back()->with('success', decode('Mail Template Update Successfully'));
    }

    /**
     * Update a specefic admin information
     *
     */
    public function statusUpdate(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('generalSettings.index')) {
            abort(403, decode(UnauthorizedMessage()));
        }

        $request->validate([
            'id' => 'required|exists:mail_templates,id'
        ], [
            'id.required' => decode('The Id Field Is Required'),
            'id.exists' => decode('Enter A Valid Id')
        ]);
        updateStatus($request->id, 'MailTemplate');
        return back()->with('success', decode('status updated Succesfully'));
    }

    /**
     * get category data by status
     * @param $status
     */
    public function statusData($status)
    {
        if (is_null($this->user) || !$this->user->can('generalSettings.index')) {
            abort(403, decode(UnauthorizedMessage()));
        }
        return view('admin.pages.mail_template.index', [
            'mailTemplates' => getDataByStatus($status, 'MailTemplate')
        ]);
    }

    /**
     * Mark  all selected category
     * @param Request $request
     */
    public function mark(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('generalSettings.index')) {
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
        markStatusUpdate('MailTemplate', $status, $request->ids);
        $message = 'All Mail Template ' . $status . 'ed Successfully';
        return back()->with('success', decode($message));
    }
}
