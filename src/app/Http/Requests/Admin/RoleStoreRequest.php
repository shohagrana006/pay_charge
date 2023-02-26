<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
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
            'name' => 'required|unique:roles,name',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => decode('Please enter name'),
            'name.unique' => decode('This roles already exists, please try another'),
        ];
    }
}
