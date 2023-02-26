<?php

namespace App\Rules\Admin;

use App\Http\Repositories\Admin\RolePermissionRepository;
use Illuminate\Contracts\Validation\Rule;
use Spatie\Permission\Models\Role;

class RoleAssignCheckRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $role = RolePermissionRepository::getAllRoles()->pluck('name')->toArray();
        if(in_array($value, $role)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return decode('Please Select A Valid Role');
    }
}
