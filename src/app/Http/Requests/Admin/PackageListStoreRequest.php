<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageListStoreRequest extends FormRequest
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
            'package_service_id' => 'required|numeric|exists:package_services,id',
            'minute' => 'nullable|numeric',
            'mb' => 'nullable|numeric',
            'sms' => 'nullable|numeric',
            'duration' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'discount_price' => 'nullable|numeric',
        ];
    }
 
    public function messages(){
        return [
            'package_service_id.required' => decode('Please enter service package id'),
            'package_service_id.numeric' => decode('Type must be number'),
            'package_service_id.exists' => decode('Please enter valid id'),
            'minute.numeric' => decode('Must be Number'),
            'mb.numeric' => decode('Must be Number'),
            'sms.numeric' => decode('Must be Number'),
            'duration.numeric' => decode('Must be Number'),
            'price.numeric' => decode('Must be Number'),
            'discount_price.numeric' => decode('Must be Number'),
        ];
    }
}
