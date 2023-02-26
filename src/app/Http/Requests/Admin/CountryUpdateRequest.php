<?php

namespace App\Http\Requests\Admin;

use App\Cp\ImageProcessor;
use App\Rules\General\FileExtentionCheckRule;
use App\Rules\General\FileLengthCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class CountryUpdateRequest extends FormRequest
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
        $imageSize = explode('x',ImageProcessor::filePath()['country']['size']);

        return [
            'name' => 'required|unique:countries,name,'.request()->id,
            'code' => 'nullable|unique:countries,code,'.request()->id,
            'logo' => ['nullable', new FileExtentionCheckRule(fileFormat()), new FileLengthCheckRule($imageSize[0], $imageSize[1])],
        ];
    }

    public function messages(){
        return [
            'name.required' => decode('please enter Country name'),
            'code.unique' => decode('This Country Code already taken'),
            'name.unique' => decode('This Country name already taken')
        ];
    }
}
