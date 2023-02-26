<?php

namespace App\Http\Requests\Admin;

use App\Rules\General\FileExtentionCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
           'user_name' => 'required|unique:admins,user_name,'.authUser()->id,
           'email' => 'required|unique:admins,email,'.authUser()->id,
           'profile_image' => ['nullable', new FileExtentionCheckRule(fileFormat())],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => decode('please enter name'),
            'user_name.required' => decode('please enter User Name'),
            'user_name.unique' => decode('This User Name Is Already Taken!! Please Try Another'),
            'email.required' => decode('please enter Email'),
            'email.email' => decode('please enter a valid Email'),
            'email.unique' => decode('This Eamil Is Already Taken!! Please Try Another'),
        ];
    }
}
