<?php

namespace App\Http\Controllers\User;

use App\Cp\ImageProcessor;
use App\Http\Controllers\Controller;
use App\Models\SupportFile;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupportTicketController extends Controller
{
    public function index()
    {
        $user = authUser('web');
        $tickets = SupportTicket::where('user_id', $user->id)->latest()->get();
        return view('user.pages.support.index', compact('tickets'));       
    }

    public function create()
    {
        return view('user.pages.support.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|max:255',
            'priority' => 'required|in:1,2,3',
            'message' => 'required',
        ]);

        $user = authUser('web');
        $supportTicket = new SupportTicket();
        $supportTicket->ticket_number = mt_rand(1000, 999999);
        $supportTicket->user_id = $user->id;
        $supportTicket->name = @$user->name;
        $supportTicket->subject = $request->subject;
        $supportTicket->priority = $request->priority;
        $supportTicket->status = 1;
        $supportTicket->save();

        $message = new SupportMessage();
        $message->support_ticket_id = $supportTicket->id;
        $message->admin_id = null;
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
        return redirect()->route('user.support.ticket.index')->with('success', decode('Support ticket has been created'));
    }

    public function detail($id)
    {
        $user = authUser('web');
        $ticket = SupportTicket::with(['messages'])->where('user_id', $user->id)->where('id', $id)->firstOrFail();
        return view('user.pages.support.detail', compact('ticket'));
    }

    public function ticketReply(Request $request, $id)
    {
        $user = authUser('web');
        $supportTicket = SupportTicket::where('user_id', $user->id)->where('id', $id)->firstOrFail();
        $supportTicket->status = 3;
        $supportTicket->save();

        $message = new SupportMessage();
        $message->support_ticket_id = $supportTicket->id;
        $message->admin_id = null;
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
                    return back()->with('error', decode('Could not upload your'));
                }
            }
        }
        return back()->with('success', decode('Support ticket replied successfully'));
    }

    public function closedTicket($id)
    {
        $user = authUser('web');
        $supportTicket =  SupportTicket::where('user_id', $user->id)->where('id', $id)->firstOrFail();
        $supportTicket->status = 4;
        $supportTicket->save();
        return back()->with('success', decode('Support ticket has been closed'));
    }

    public function supportTicketDownload($id)
    {
        $supportFile = SupportFile::findOrFail(decrypt($id));
        $file = $supportFile->file;
        $path = ImageProcessor::filePath()['support_ticket']['path'] . '/' . $file;
        $title = Str::slug('file') . '-' . $file;
        $mimetype = mime_content_type($path);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($path);
    }
}