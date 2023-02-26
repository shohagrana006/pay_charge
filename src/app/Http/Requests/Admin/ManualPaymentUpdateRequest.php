<?php

namespace App\Http\Requests\Admin;

use App\Cp\ImageProcessor;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\General\FileExtentionCheckRule;
use App\Rules\General\FileLengthCheckRule;

class ManualPaymentUpdateRequest extends FormRequest
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
        $imageSize = explode('x',ImageProcessor::filePath()['manual_payment']['size']);
        return [
            'gateway_name'  => 'required|unique:manual_payments,gateway_name,'.request()->id,
            'minimum_amount' => 'nullable|numeric',
            'maximum_amount' => 'nullable|numeric',
            'percent_charge' => 'nullable|numeric',
            'fixed_charge' => 'nullable|numeric',
            'logo' => ['nullable', new FileExtentionCheckRule(fileFormat()), new FileLengthCheckRule($imageSize[0], $imageSize[1])],
            'input.*.name' => 'required',
        ];
    }
 
    public function messages(){
        return [          
            'gateway_name.required' => decode('please enter gateway name'),
            'gateway_name.unique' => decode('Gateway name already exist'),
            'minimum_amount.numeric' => decode('please enter number'),
            'maximum_amount.numeric' => decode('please enter number'),
            'percent_charge.numeric' => decode('please enter number'),
            'fixed_charge.numeric' => decode('please enter number'),
            'input.*.name.required' => decode('Field name must be required')
        ];
    }
}
