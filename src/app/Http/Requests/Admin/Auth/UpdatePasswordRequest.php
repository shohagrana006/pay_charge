<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'email' => 'required|exists:password_resets,email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => decode('please enter your email'),
            'email.exists' => decode('email is not exists in system'),
            'token.required' => decode('token is required'),
            'password.required' => decode('please enter your password'),
            'password.confirmed' => decode('confirm password does not match'),
            'password.min' => decode('MiniMum 8 char is required')
        ];
    }
}
