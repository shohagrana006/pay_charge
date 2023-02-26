<?php

namespace Database\Seeders\Admin;

use App\Http\Repositories\Admin\RolePermissionRepository;
use Illuminate\Database\Seeder;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // check if role exists or not
        if(!(RolePermissionRepository::getRole())){
            $roleSuperAdmin = RolePermissionRepository::createRole();
            //create role permission
            RolePermissionRepository::createPermission($roleSuperAdmin);
        }

    }
}
