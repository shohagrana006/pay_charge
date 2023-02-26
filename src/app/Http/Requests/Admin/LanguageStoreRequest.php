<?php

namespace App\Http\Requests\Admin;

use App\Rules\Admin\LengthCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class LanguageStoreRequest extends FormRequest
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
            'name' => 'required|max:255|unique:languages,name',
            'code' => 'required|max:255|unique:languages,code|max:5',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => decode('please enter country name'),
            'code.required' => decode('please enter country code'),
            'code.unique' => decode('This Country Code is Already Taken , Try Another'),
            'code.max' => decode('Maximum Code lenght is 5'),
            'name.unique' => decode('This Country Name is Already Taken , Try Another'),
        ];
    }
}

