<?php

namespace App\Http\Controllers\Admin;

use App\Cp\ImageProcessor;
use App\Http\Controllers\Controller;
use App\Models\SupportFile;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupportTicketController extends Controller
{
    /**
     * Construct method
     */
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = authUser();
            return $next($request);
        });
    }


    public function index()
    {
        if(is_null($this->user) || !$this->user->can('ticket.index')){
            abort(403, UnauthorizedMessage());
        }
        $supportTickets = SupportTicket::with('user')->latest()->get();
        return view('admin.pages.support.index', compact('supportTickets'));
    }

    public function running()
    {
        if (is_null($this->user) || !$this->user->can('ticket.index')) {
            abort(403, UnauthorizedMessage());
        }
        $supportTickets = SupportTicket::with('user')->where('status', 1)->latest()->get();
        return view('admin.pages.support.index', compact( 'supportTickets'));
    }

    public function answered()
    {
        if (is_null($this->user) || !$this->user->can('ticket.index')) {
            abort(403, UnauthorizedMessage());
        }
        $supportTickets = SupportTicket::with('user')->where('status', 2)->latest()->get();
        return view('admin.pages.support.index', compact('supportTickets'));
    }

    public function replied()
    {
        if (is_null($this->user) || !$this->user->can('ticket.index')) {
            abort(403, UnauthorizedMessage());
        }
        $supportTickets = SupportTicket::with('user')->where('status', 3)->latest()->get();
        return view('admin.pages.support.index', compact('supportTickets'));
    }


    public function closeds()
    {
        if (is_null($this->user) || !$this->user->can('ticket.index')) {
            abort(403, UnauthorizedMessage());
        }
        $supportTickets = SupportTicket::with('user')->where('status', 4)->latest()->get();
        return view('admin.pages.support.index', compact('supportTickets'));
    }

    public function ticketDetails($id)
    {
        if (is_null($this->user) || !$this->user->can('ticket.reply')) {
            abort(403, UnauthorizedMessage());
        }
        $ticket = SupportTicket::with('messages')->findOrFail($id);
        return view('admin.pages.support.detail', compact('ticket'));
    }

    public function ticketReply(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('ticket.reply')) {
            abort(403, UnauthorizedMessage());
        }
        $supportTicket = SupportTicket::findOrFail($id);
        $supportTicket->status = 2;
        $supportTicket->save();

        $message = new SupportMessage();
        $message->support_ticket_id = $supportTicket->id;
        $message->admin_id = authUser()->id;
        $message->message = $request->message;
        $message->save();

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                try {
                    $supportFile = new SupportFile();
                    $supportFile->support_message_id = $message->id;
                    $supportFile->file = ImageProcessor::uploadFile($file, 'support_ticket');
                    $supportFile->save();
                } catch (\Exception $exp) {
                    return back()->with('error', decode('Could not upload your file'));
                }
            }
        }

        return back()->with('success', decode('Support ticket replied successfully'));
    }


    public function closedTicket($id)
    {
        if (is_null($this->user) || !$this->user->can('ticket.closed')) {
            abort(403, UnauthorizedMessage());
        }
        $supportTicket = SupportTicket::findOrFail($id);
        $supportTicket->status = 4;
        $supportTicket->save();
        return back()->with('success', decode('Support ticket has been closed'));
    }

    public function supportTicketDownload($id)
    {
        if (is_null($this->user) || !$this->user->can('ticket.download')) {
            abort(403, UnauthorizedMessage());
        }
        $supportFile = SupportFile::findOrFail(decrypt($id));
        $file = $supportFile->file;
        $path = ImageProcessor::filePath()['support_ticket']['path'] . '/' . $file;
        $title = Str::slug('file') . '-' . $file;
        $mimetype = mime_content_type($path);
        header('Content-Disposition: attachment; filename=' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($path);
    }

}
