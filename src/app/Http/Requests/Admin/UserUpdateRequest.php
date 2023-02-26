<?php

namespace App\Http\Requests\Admin;

use App\Cp\ImageProcessor;
use App\Rules\General\FileExtentionCheckRule;
use App\Rules\General\FileLengthCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => 'required|unique:users,email,'.request()->id,
            'status' => 'required|in:Active,DeActive',
            'photo' => ['image', new FileExtentionCheckRule(fileFormat())]
        ];
    }

    public function messages(){
        return [
            'name.required'     => decode('Name Must be required'),
            'email.required'    => decode('Email Must be required'),
            'email.unique'      => decode('This Email Is Already Taken ,Try Another'),
            'status.in'         => decode('Please Select Valid Status'),
            'photo.image'       => decode('Upload A valid image '),
        ];
    }



}
