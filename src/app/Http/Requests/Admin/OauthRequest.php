<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OauthRequest extends FormRequest
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
            'google.status' => 'required|in:Active,DeActive',
            'facebook.status' => 'required|in:Active,DeActive'
        ];
    }

    public function messages(){
        return [
            'google.status.required' => decode('Status must be required'),
            'google.status.in' => decode('Status must be Valid'),
            'facebook.status.required' => decode('Status must be required'),
            'facebook.status.in' => decode('Status must be Valid'),
        ];
    }
}
