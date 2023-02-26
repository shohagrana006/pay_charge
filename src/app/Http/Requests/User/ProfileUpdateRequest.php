<?php

namespace App\Http\Requests\User;

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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',            
            'profile_image' => ['nullable', new FileExtentionCheckRule(fileFormat())],
        ];
    }

    public function messages(){
        return [
            'name.required' => decode('please enter name'),          
        ];
    }
}
