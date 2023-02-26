<?php

namespace App\Listeners;

use App\Events\NewNotificationEventProcess;
use App\Models\Admin;
use App\Notifications\NewEventNotification;
use Illuminate\Support\Facades\Notification;
class SendNewNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewNotificationEventProcess  $event
     * @return void
     */
    public function handle(NewNotificationEventProcess $event)
    {
        $users = Admin::all();
        Notification::send($users, new NewEventNotification($event->details));
    }
}
