<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
            'role_name' => 'required|unique:roles,name,'.request()->id,
        ];
    }
    public function messages()
    {
        return [
            'role_name.required' => decode('Please enter name'),
            'role_name.unique' => decode('This roles already exists, please try another'),
        ];
    }
}
