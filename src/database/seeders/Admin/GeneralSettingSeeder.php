<?php

namespace Database\Seeders\Admin;
use App\Http\Repositories\Eternal\GeneralRepository;
use App\Models\GeneralSettings;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if(!GeneralRepository::findElement('GeneralSettings', 'nafiz0khan1@gmail.com', 'email')){

            GeneralSettings::create([
                'name' => 'Nafiz Khan',
                'phone' => '01616243666',
                'email' => 'nafiz0khan1@gmail.com',
                'address' => 'H-09',
                'mail_footer' => json_encode([
                    'logo'=>'',
                    'link'=>'#'
                ]),
                "currency_setup" =>  json_encode([
                    'currency'=>'USD',
                    'symbol'=>'$',
                ]),
                "frontend_loader" =>  json_encode([
                    'image'=>'#',
                    'status '=>'Active',
                ]),
                "recaptcha"=>  json_encode([
                    'key'=>'6LedlgUjAAAAAB2Ya-wfLOaTs_z5PAkceCJgo4Tl',
                    'secret_key'=>'6LedlgUjAAAAANIo4iedlmSY-zLakPWIMn47MS17',
                    'status'=>'Active']),

                'social_media'  => json_encode([
                    'facebook'  => json_encode([
                        'link'=>'#',
                        'icon'=>'<i class="fab fa-facebook"></i>',
                        'status'=>'Active',
                    ],),
                    'twitter'   => json_encode([
                        'link'=>'#',
                        'icon'=>'<i class="fab fa-facebook"></i>',
                        'status'=>'Active',
                    ],),
                    'instagram' => json_encode([
                        'link'=>'#',
                        'icon'=>'<i class="fab fa-facebook"></i>',
                        'status'=>'Active',
                    ],),
                    'linkedin'  => json_encode([
                        'link'=>'#',
                        'icon'=>'<i class="fab fa-facebook"></i>',
                        'status'=>'Active',
                    ],),
                    'google'  => json_encode([
                        'link'=>'#',
                        'icon'=>'<i class="fab fa-facebook"></i>',
                        'status'=>'Active',
                    ],),
                ]),
                'social_login'=>json_encode([
                    'google_oauth'   => json_encode([
                        'client_id'     => '#',
                        'client_secret' => '#',
                        'status'        => 'Active',
                    ]),
                    'facebook_oauth' => json_encode([
                        'client_id'     => '#',
                        'client_secret' => '#',
                        'status'        => 'Active',
                    ]),
                ]),


            ]);
        }
    }
}
