<?php

namespace App\Http\Requests\Admin;

use App\Cp\ImageProcessor;
use App\Rules\Admin\TranslateUniqueCheckRule;
use App\Rules\General\FileExtentionCheckRule;
use App\Rules\General\FileLengthCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceCategoryUpdateRequest extends FormRequest
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
        $imageSize = explode('x',ImageProcessor::filePath()['service_category']['size']);

        return [
            'name.'.getSystemLocale() =>'required',
            'name' =>  [new TranslateUniqueCheckRule('ServiceCategory','name', request()->id)],
            'slug' =>  [new TranslateUniqueCheckRule('ServiceCategory','slug', request()->id)],
            'logo' =>  ['nullable', new FileExtentionCheckRule(fileFormat()), new FileLengthCheckRule($imageSize[0], $imageSize[1])],
        ];
    }
 
    public function messages(){
        return [
            'name.'.getSystemLocale().'.required' => decode('please enter Name'),
        ];  
    }
}
