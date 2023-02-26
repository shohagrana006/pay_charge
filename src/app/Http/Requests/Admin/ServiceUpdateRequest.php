<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Cp\ImageProcessor;
use App\Rules\Admin\TranslateUniqueCheckRule;
use App\Rules\General\FileExtentionCheckRule;
use App\Rules\General\FileLengthCheckRule;

class ServiceUpdateRequest extends FormRequest
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

            'name.'.getSystemLocale() =>'required',
            'name' =>  [new TranslateUniqueCheckRule('Service','name', request()->id)],
            'country_id' => 'required|exists:countries,id',
            'service_category_id' => 'required|exists:service_categories,id',
            'percent_charge' => 'nullable|numeric',
            'fixed_charge' => 'nullable|numeric',
            'logo' => ['nullable', new FileExtentionCheckRule(fileFormat()), new FileLengthCheckRule($imageSize[0], $imageSize[1])],
            'input.*.name' => 'required',
        ];
    }
 
    public function messages(){
        return [
            'name.'.getSystemLocale().'.required' => decode('please Service enter Name'),
            'country_id.required' => decode('please enter valid id'),
            'country_id.exists' => decode('please enter Country name'),
            'service_category_id.required' => decode('please enter Service Category name'),
            'service_category_id.exists' => decode('please enter valid id'),
            'percent_charge.numeric' => decode('please enter number'),
            'fixed_charge.numeric' => decode('please enter number'),
            'input.*.name.required' => decode('Field name must be required')
        ];
    }
}
