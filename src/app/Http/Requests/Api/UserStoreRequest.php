<?php

namespace App\Http\Requests\Api;

use App\Rules\General\FileExtentionCheckRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'photo' => ['image', new FileExtentionCheckRule(fileFormat())]
        ];
    }

    public function messages(){
        return [
            'name.required'         => decode('Name Must be required'),
            'email.required'        => decode('Email Must be required'),
            'email.email'           => decode('Email Must be valid format'),
            'email.unique'          => decode('Email Must be Unique'),
            'password.required'     => decode('Password Must be required'),
            'password.min'          => decode('Password at least 8 character'),
            'password_confirmation.required' => decode('Confirmation Password Must be required'),
            'password_confirmation.same'     => decode('Confirmation password does not match'),         
            'photo.image'           => decode('Upload A valid image')
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
    
        $response = response()->json([
            'success'=> false,
            'message' => $errors->messages(),
        ], 422);
    
        throw new HttpResponseException($response); 
    }
}
