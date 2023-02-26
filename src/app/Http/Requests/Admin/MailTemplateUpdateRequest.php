<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MailTemplateUpdateRequest extends FormRequest
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
            'subject' => 'required',
            'body' => 'required',
           ];
    }


    public function messages()
    {
        return [
            'subject.required' => decode('Please enter subject'),                 
            'body.required' => decode('Please enter description'),                 
        ];
    }
}
