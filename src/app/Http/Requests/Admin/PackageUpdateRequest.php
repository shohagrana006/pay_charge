<?php

namespace App\Http\Requests\Admin;

use App\Cp\ImageProcessor;
use App\Rules\Admin\TranslateUniqueCheckRule;
use App\Rules\General\FileExtentionCheckRule;
use App\Rules\General\FileLengthCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class PackageUpdateRequest extends FormRequest
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
        $imageSize = explode('x',ImageProcessor::filePath()['package']['size']);
        return [
            'name.'.getSystemLocale() =>'required',
            'name' =>  [new TranslateUniqueCheckRule('Package','name',request()->id)],
            'service_id' => 'required|exists:services,id',
            'logo' =>  ['nullable', new FileExtentionCheckRule(fileFormat()), new FileLengthCheckRule($imageSize[0], $imageSize[1])],
        ];
    }


    public function messages(){
        return [
            'name.'.getSystemLocale().'.required' => decode('Please enter package name'),
            'service_id.required' => decode('Please select service name'),
            'service_id.exists' => decode('Please select valid service id'),
        ];
    }
}