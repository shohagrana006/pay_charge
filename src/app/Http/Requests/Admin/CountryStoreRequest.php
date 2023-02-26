<?php

namespace App\Http\Requests\Admin;

use App\Cp\ImageProcessor;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\General\FileExtentionCheckRule;
use App\Rules\General\FileLengthCheckRule;


class CountryStoreRequest extends FormRequest
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
            'name' => 'required|unique:countries,name',      
            'logo' => ['nullable', new FileExtentionCheckRule(fileFormat()), new FileLengthCheckRule($imageSize[0], $imageSize[1])],
        ];
    }
 
    public function messages(){
        return [
            'name.required' => decode('please enter Country name'),
            'name.unique' => decode('This Country name already taken')
        ];
    }
}
