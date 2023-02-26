<?php

namespace Database\Seeders\Admin;

use App\Models\Mail;
use Illuminate\Database\Seeder;

class MailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(countModelData('Mail') == 0){
            Mail::create([
                'name'=>'SMTP',
                'driver_information'=>json_encode(getMailTrapSetup())
            ]);
            Mail::create([
                'name'=>'SendGrid',
                'status'=>'DeActive',
                'driver_information'=>json_encode(getSandGridSetup())
            ]);
        }

    }
}
