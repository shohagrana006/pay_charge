<?php

namespace App\Http\Requests\Admin;

use App\Cp\ImageProcessor;
use App\Rules\General\FileExtentionCheckRule;
use App\Rules\General\FileLengthCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
;
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'status' => 'required|in:Active,DeActive',
            'phone' => 'nullable',
            'photo' => ['image', new FileExtentionCheckRule(fileFormat())]
        ];
    }

    public function messages(){
        return [
            'name.required'         => decode('Name Must be required'),
            'email.required'        => decode('Email Must be required'),
            'email.unique'          => decode('Email Must be Unique'),
            'password.required'     => decode('Password Must be required'),
            'password.min'          => decode('Password at least 8 character'),
            'password_confirmation.required' => decode('Confirmation Password Must be required'),
            'password_confirmation.same'     => decode('Confirmation password does not match'),
            'status.in'             => decode('Please Select A Valid Status'),
            'photo.image'           => decode('Upload A valid image')
        ];
    }
}
