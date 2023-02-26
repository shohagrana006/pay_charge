<?php

namespace App\Http\Requests\Admin;

use App\Rules\Admin\RoleAssignCheckRule;
use App\Rules\General\FileExtentionCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'name' => 'required',
           'user_name' => 'required|unique:admins,user_name',
           'email' => 'required|unique:admins,email',
           'password' => 'required|min:8',
           'password_confirmation' => 'required|same:password',
           'status' => 'in:Active,DeActive',
           'role' => ['nullable','required', new RoleAssignCheckRule()],
           'profile_image' => ['nullable', new FileExtentionCheckRule(fileFormat())],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => decode('please enter  name'),
            'user_name.required' => decode('please enter User Name'),
            'user_name.unique' => decode('This User Name Is Already Taken!! Please Try Another'),
            'email.required' => decode('please enter Email'),
            'email.email' => decode('please enter a valid Email'),
            'email.unique' => decode('This Eamil Is Already Taken!! Please Try Another'),
            'password.required' => decode('Enter A PassWord'),
            'password.min' => decode('min 8 character required'),
            'password_confirmation.required' => decode('Confiram Password Feild Is Required'),
            'password_confirmation.same' => decode('Confiram Password Does Not Match With Password'),
            'status.in' => decode('Choose A valid status'),
            'role.required' => decode('Choose A Role Name'),
        ];
    }
}
