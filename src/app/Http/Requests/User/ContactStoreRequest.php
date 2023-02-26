<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'email|required',
            'message'=>'required',
            'subject'=>'required',
        ];
    }


    public function messages(){
        return [
            'name.required'     => decode('Name Must be required'),
            'subject.required'     => decode('Subject Must be required'),
            'message.required'     => decode('Message Must be required'),
            'email.required'    => decode('Email Must be required'),
            'email.email'      => decode('Enter An Email'),
        ];
    }
}
