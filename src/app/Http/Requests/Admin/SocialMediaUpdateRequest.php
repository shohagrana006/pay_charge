<?php

namespace App\Http\Requests\Admin;

use App\Rules\Admin\SocialMediaUpdateRule;
use Illuminate\Foundation\Http\FormRequest;

class SocialMediaUpdateRequest extends FormRequest
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
            'name' => ['required', new SocialMediaUpdateRule()],
        ];
    }
}
