<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqStoreRequest extends FormRequest
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
            'qsn.'.getSystemLocale() =>'required',
        ];
    }


    public function messages(){
        return [
            'qsn.'.getSystemLocale().'.required' => decode('Please enter faq question name'),
        ];
    }
}
