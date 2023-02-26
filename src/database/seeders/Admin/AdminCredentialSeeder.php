<?php

namespace Database\Seeders\Admin;
use App\Http\Repositories\Eternal\GeneralRepository;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isNull;

class AdminCredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!GeneralRepository::findElement('Admin','superadmin@example.com','email')){
            $admin = Admin::create([
                'name' => 'SuperAdmin',
                'user_name' => 'admin',
                'email' => 'superadmin@example.com',
                'password' => passwordEncrypt(),
                'address'=>json_encode(getEmptyAddress()),
                'status' => 'Active'
            ]);
            $admin->assignRole('SuperAdmin');
        }
    }
}
