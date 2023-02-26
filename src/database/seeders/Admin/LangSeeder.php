<?php

namespace Database\Seeders\Admin;

use App\Http\Repositories\Eternal\GeneralRepository;
use App\Models\Language;
use Illuminate\Database\Seeder;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!GeneralRepository::findElement('Language', 'us', 'code')) {
            Language::create([
                "name"=>'English',
                "code"=>'us',
                "created_by"=>1,
                "status"=>'Active',
                'is_default'=>1,
            ]);
        }
    }
}
