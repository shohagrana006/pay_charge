<?php
namespace App\Http\Repositories\Admin;

use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolePermissionRepository {


    /**
     * get all roles with permission
     *
     */
    public static function getAllRoles(){
        return Role::with('permissions')->get();
    }

    /**
     * create new roles
     * @param $request
     *
     * @return void
     */
    public static function createRoles($request){
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'admin',
        ]);
        $permissions = $request->permissions;
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
    }

    /**
     * update new roles
     * @param $request
     *
     * @return void
     */
    public static function updateRoles($request){
        $role =  Role::findById($request->id);
        $role->revokePermissionTo($role->permissions);
        Role::where('id',$request->id)->update([
            'name' => $request->role_name,
            'guard_name' => 'admin',
            'status' => 'Active'
        ]);;
        if(!empty($request->input('permissions'))){
            $role->syncPermissions($request->input('permissions'));
        }

    }

    /**
     * update a specific role status
     * @param $request
     *
     * @return void
     */
    public static function updateRolestatus($request){
        $role = self::getSpecificRole($request->id);
        if($role->status == 'Active'){
            $status = 'DeActive';
        }
        else{
           $status = 'Active';
        }
        $role->update([
            'status'=>$status
        ]);

    }
    /**
     * destory a specific role status
     * @param $request
     *
     * @return void
     */
    public static function roleDestroy($request){
        $role =  Role::findById($request->id);
        $rolesUser = count(Admin::role($role->name)->get());
        $response =  decode('Can Not Deleted !! Roles Has User !! Please Try Again');
        if(!is_null($role)){
            if($rolesUser == 0){
                $role->delete();
                $response =  'deleted';
            }

        }
        return $response;

    }

    /**
     * get specific role
     *
     * @param $id
     */
    public static function getSpecificRole($id){
        return Role::with('permissions')->where('id',$id)->first();
    }
    /**
     * get  a specific role which name superadmin
     *
     * @param  $roleName,$guardName,$method
     * @return role
     */
    public static function getRole($roleName='SuperAdmin',$guardName ='admin',$method ='first'){
        return Role::where('name',$roleName)->where('guard_name',$guardName)->$method();
    }


    /**
     * create a specific role for admin
     *
     * @param $roleName,$guardName,
     * @return role
     */
    public static function createRole($roleName='SuperAdmin',$guardName ='admin'){
        return Role::create(['name' => $roleName,'guard_name' => $guardName]);
    }

    /**
     * create permission array
     *
     * @param $roleSuperAdmin
     * @return $permissions
     */
    public static function createPermission($roleSuperAdmin){

        $permissions = [
                [
                    //dashboard permission
                    'group_name' => 'dashboard',
                    'permissions' => [
                        'dashboard.index',
                    ]
                ],
                
                [
                    //admin permission
                    'group_name' => 'admin',
                    'permissions' => [
                        'admin.index',
                        'admin.create',
                        'admin.store',
                        'admin.edit',
                        'admin.destroy',
                        'admin.restore',
                        'admin.permanentDelete',
                    ]
                ],

                [
                    //role permission
                    'group_name' => 'role',
                    'permissions' => [
                        'role.index',
                        'role.create',
                        'role.store',
                        'role.edit',
                        'role.destroy',

                    ]
                ],

                [
                    //profile permission
                    'group_name' => 'profile',
                    'permissions' => [
                        'profile.index',
                        'profile.edit',
                    ]
                ],

                [
                    //general settings permission
                    'group_name' => 'settings',
                    'permissions' => [
                        'generalSettings.index',
                    ]
                ],

                [
                    //config settings permission
                    'group_name' => 'settings',
                    'permissions' => [
                        'configSettings.index',
                    ]
                ],

                [
                    //user permission
                    'group_name' => 'user',
                    'permissions' => [
                        'user.index',
                        'user.create',
                        'user.store',
                        'user.edit',
                        'user.destroy',
                        'user.restore',
                        'user.permanentDelete',

                    ]
                ],
                [
                    //language permission
                    'group_name' => 'language',
                    'permissions' => [
                        'language.index',
                        'language.create',
                        'language.store',
                        'language.edit',
                        'language.destroy',
                    ]
                ],            

                [
                    //seo permission
                    'group_name' => 'seo',
                    'permissions' => [
                        'seo.index',
                        'seo.create',
                        'seo.store',
                        'seo.edit',
                        'seo.destroy',
                    ]
                ],
                [
                    //currency permission
                    'group_name' => 'currency',
                    'permissions' => [
                        'currency.index',
                        'currency.create',
                        'currency.store',
                        'currency.edit',
                        'currency.destroy',
                    ]
                ],
                [
                    //country permission
                    'group_name' => 'country',
                    'permissions' => [
                        'country.index',
                        'country.create',
                        'country.store',
                        'country.edit',
                        'country.destroy',
                    ]
                ],
                [
                    //service category permission
                    'group_name' => 'service.category',
                    'permissions' => [
                        'service.category.index',
                        'service.category.create',
                        'service.category.store',
                        'service.category.edit',
                        'service.category.destroy',
                    ]
                ],
                [
                    //service permission
                    'group_name' => 'service',
                    'permissions' => [
                        'service.index',
                        'service.create',
                        'service.store',
                        'service.edit',
                        'service.destroy',
                    ]
                ],
                [
                    //service permission
                    'group_name' => 'purchase.log',
                    'permissions' => [
                        'purchase.log.index',
                        'purchase.log.edit',
                    ]
                ],
                [
                    //package permission
                    'group_name' => 'package',
                    'permissions' => [
                        'package.index',
                        'package.create',
                        'package.store',
                        'package.edit',
                        'package.destroy',
                    ]
                ],
                [
                    //package list permission
                    'group_name' => 'package.list',
                    'permissions' => [
                        'package.list.index',
                        'package.list.create',
                        'package.list.store',
                        'package.list.edit',
                        'package.list.destroy',
                    ]
                ],

                [
                    //PaymentMethod permission
                    'group_name' => 'paymentMethod',
                    'permissions' => [
                        'paymentMethod.index',
                        'paymentMethod.edit',
                    ]
                ],
                
                [
                    //Manual Payment permission
                    'group_name' => 'payment.manual',
                    'permissions' => [
                        'payment.manual.index',
                        'payment.manual.create',
                        'payment.manual.store',
                        'payment.manual.edit',
                        'payment.manual.destroy',
                    ]
                ],
                [
                    //faq permission
                    'group_name' => 'faq',
                    'permissions' => [
                        'faq.index',
                        'faq.create',
                        'faq.store',
                        'faq.edit',
                        'faq.destroy',
                    ]
                ],
                [
                    //choose permission
                    'group_name' => 'choose',
                    'permissions' => [
                        'choose.index',
                        'choose.create',
                        'choose.store',
                        'choose.edit',
                        'choose.destroy',
                    ]
                ],               
                [
                    //support ticket permission
                    'group_name' => 'ticket',
                    'permissions' => [
                        'ticket.index',
                        'ticket.reply',
                        'ticket.download',
                        'ticket.closed',
                    ]
                ],               

        ];
        self::assignPermission($permissions,$roleSuperAdmin);
    }

    /**
     * assign permission for a specific role
     *
     * @param $permission ,$roleSuperAdmin
     */
    public static function assignPermission($permissions,$roleSuperAdmin){

        for($i = 0; $i<count($permissions); $i++){
                $permissionGroup = $permissions[$i]['group_name'];

                for($j = 0; $j<count($permissions[$i]['permissions']); $j++){
                    //create permission for a specific role
                    $permission = Permission::create([
                            'name' => $permissions[$i]['permissions'][$j],
                            'group_name' => $permissionGroup,
                            'guard_name' => 'admin'
                    ]);
                    //assign permission to a specific role
                    $roleSuperAdmin->givePermissionTo($permission);
                    $permission->assignRole($roleSuperAdmin);
                }
        }
    }


    /**
     * all permission get by gorupBy
     *
     * @return $permission
     */
    public static function allPermission(){
        return Permission::select('id','name','group_name')->orderBy('group_name')->get()->groupBy(function($query){
            return  $query->group_name;
        });
    }
}
