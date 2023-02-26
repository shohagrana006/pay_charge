<?php

namespace Database\Seeders;

use Database\Seeders\Admin\AdminCredentialSeeder;
use Database\Seeders\Admin\RolePermissionSeeder;
use Database\Seeders\Admin\LangSeeder;
use Database\Seeders\Admin\GeneralSettingSeeder;
use Database\Seeders\Admin\MailSeeder;
use Database\Seeders\Admin\MailTemplateSeeder;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolePermissionSeeder::class,
            AdminCredentialSeeder::class,
            LangSeeder::class,
            GeneralSettingSeeder::class,
            MailSeeder::class,
            MailTemplateSeeder::class,
        ]);
    }
}
