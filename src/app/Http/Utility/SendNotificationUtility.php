<?php
namespace App\Http\Utility;

use App\Events\NewNotificatioEventProcess;
use App\Events\NewNotificationEventProcess;
use App\Mail\Admin\Auth\PassworReshuffleMail;
use App\Mail\Admin\TestMail;
use Illuminate\Support\Facades\Mail;

class SendNotificationUtility{

    /**
     * send database notification
     *
     * @param $details
     */
    public static function sendNotification($details){
        event(new NewNotificationEventProcess($details));
    }

}
