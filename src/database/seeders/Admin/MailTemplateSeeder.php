<?php

namespace Database\Seeders\Admin;

use App\Models\MailTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(countModelData('MailTemplate') == 0){
             
            $templates = [

                [
                    'name'   => 'Password Reset',
                    'slug'   => Str::slug('Password Reset'),
                    'subject' => 'Password Reset',
                    'body'   => '<p> We have received a request to reset the password for your account on {{code}} and Request time {{time}} </p>',
                    'codes'  => json_encode([
                        "code" => "Password Reset Code",
                        "time" => "Time"
                    ]),
                ],

                [
                    'name'   => 'Admin Support Reply',
                    'slug'   => Str::slug('Admin Support Reply'),
                    'subject' => 'Support Ticket Reply',
                    'codes'  => json_encode([
                        "ticket_number" => "Support Ticket Number",
                        "link" => "Ticket URL For relpy"
                    ]),
                ],

                [
                    'name'   => 'Payment Confirmation',
                    'slug'   => Str::slug('Payment Confirmation'),
                    'subject' => 'Payment confirm',
                    'body'   => '<p>Your Transaction Number {{trx}} and payment amount {{amount}} and charge {{charge}}</p>',
                    'codes'  => json_encode([
                        "trx" => "Transaction Number",
                        "amount" => "Payment Amount",
                        "charge" => "Payment Gateway Charge",
                        "currency" => "Site Currency",
                        "rate" => "Conversion Rate",
                        "method_name" => "Payment Method name",
                        "method_currency" => "Payment Method Currency",
                    ]),
                ],

                [
                    'name'   => 'Admin Password Reset',
                    'slug'   => Str::slug('Admin Password Reset'),
                    'subject' => 'Admin Password Reset',
                    'body'   => '<p>We have received a request to reset the password for your account on {{code}} and Request time {{time}}</p>',
                    'codes'  => json_encode([
                        "code" => "Password Reset Code",
                        "time" => "Time"
                    ]),
                ],

                [
                    'name'   => 'Password Reset Confirm',
                    'slug'   => Str::slug('Password Reset Confirm'),
                    'subject' => 'Password Reset Confirm',
                    'body'   => '<p>We have received a request to reset the password for your account on {{code}} and Request time {{time}}</p>',
                    'codes'  => json_encode([
                        "time" => "Time"
                    ]),
                ],

                [
                    'name'   => 'Registration Verify',
                    'slug'   => Str::slug('Registration Verify'),
                    'subject' => 'Registration Verify',
                    'body'   => '<p>Hi, {{name}} We have received a request to create an account, you need to verify email first, your verification code is {{code}} and request time {{time}}</p>',
                    'codes'  => json_encode([
                        "name" => "Name",
                        "code" => "Password Reset Code",
                        "time" => "Time"
                    ]),
                ],
            ];

            foreach ($templates as $template) {
                MailTemplate::create($template);
            }
        }
    }
}
