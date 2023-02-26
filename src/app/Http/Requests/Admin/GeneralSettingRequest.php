<?php

namespace App\Http\Requests\Admin;

use App\Cp\ImageProcessor;
use App\Rules\General\FileExtentionCheckRule;
use App\Rules\General\FileLengthCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingRequest extends FormRequest
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
        $logoSize = explode('x', ImageProcessor::filePath()['logo']['size']);
        $faviconSize = explode('x', ImageProcessor::filePath()['favicon']['size']);


        return [
            'currency.*'=>'required',
            'name' => 'required',
            'phone' => 'required',
            'copy_right_text' => 'required',
            'pagination_number' => 'required',
            'email' => 'required',
            'favicon' =>  [
                'image',
                new FileExtentionCheckRule(fileFormat()),
                new FileLengthCheckRule($faviconSize[0], $faviconSize[1]),
            ],
            'logo' =>  [
                'image',
                new FileExtentionCheckRule(fileFormat()),
                new FileLengthCheckRule($logoSize[0], $logoSize[1]),
            ],

        ];
    }

    public function messages(){
        return [
            'name.required' => decode('Name Must be required'),
            'currency.*.required' => decode('System Currency and symbol  Is Required'),
            'copy_right_text.required' => decode('Copy Right Text Field is Must be required'),
            'pagination_number.required' => decode('pagination number Field is required'),
            'phone.required' => decode('Phone Must be required'),
            'email.required' => decode('Email Must be required'),
            'favicon.image' => decode('Favicon Must be an iamge'),
            'logo.image' => decode('Logo Must be an iamge')
        ];
    }
}
