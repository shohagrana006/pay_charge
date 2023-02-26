<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserVerifyRegistrationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $user;
    private  $userVerifyEmail;
    private $mailTemplate;
    private $route;

    public function __construct($data)
    {
        $this->user = $data['value']['user'];
        $this->userVerifyEmail =  $data['value']['userVerifyEmail'];
        $this->mailTemplate =  $data['value']['mailTemplate'];
        $this->route =  $data['route'];
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $this->mailTemplate->body = str_replace("{{name}}", $this->user->name, $this->mailTemplate->body);
        $this->mailTemplate->body = str_replace("{{link}}", $this->userVerifyEmail->token, $this->mailTemplate->body);
        $this->mailTemplate->body = str_replace("{{time}}", now(), $this->mailTemplate->body);
        
        return (new MailMessage)
                    ->line($this->user->name)
                    ->subject($this->mailTemplate->subject)
                    ->line($this->mailTemplate->body)
                    ->action('Click account activeted', $this->route)
                    ->line('Thank you for using our application!');
    }

}
