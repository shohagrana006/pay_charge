<?php
namespace App\Http\Utility;

use Illuminate\Support\Facades\Mail;

class SendMailUtility{

    /**
     * send reset password mail
     *
     * @param $details , $email
     */
    public static function sendMail($details,$email){
        try {
            Mail::send(['details'=>$details], function($message)use($details,$email) {
                $message->to($email)->subject($details['subject']);
                $message->from($details['from']['address'],$details['from']['name']);
             });
        } catch (\Exception $e) {
          return 'failed';
        }
    }

}
