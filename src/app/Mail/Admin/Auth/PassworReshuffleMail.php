<?php

namespace App\Mail\Admin\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PassworReshuffleMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $details;
    public function __construct($details)
    {
        $this->details =  $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->details['view'])
        ->from($this->details['from'], env('MAIL_FROM_NAME'))
        ->subject($this->details['subject'])
        ->with([
            'details' => $this->details
        ]);
    }
}
