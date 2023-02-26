<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserVerificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() 
    {
        $arr = [
            'name'=> $this->data['user']->name,
            'link'=> $this->data['userVerifyEmail']->token,
            'time'=> now(),            
        ];

        $this->data['mailTemplate']->body = templateReplace($this->data['mailTemplate'], $arr);

        return $this->view('mail.user.verify_mail_template')
                    ->subject($this->data['mailTemplate']->subject)
                    ->with([
                        'mailTemplate' => $this->data['mailTemplate'],
                        'verifyLink' => url('api/v1/user/account/verify/' . $this->data['userVerifyEmail']->token),
                    ]);
    }
}
