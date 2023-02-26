<?php

namespace App\Http\Requests\Admin;

use App\Cp\ImageProcessor;
use App\Rules\Admin\RoleAssignCheckRule;
use App\Rules\General\FileExtentionCheckRule;
use App\Rules\General\FileLengthCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
        $imageSize = explode('x',ImageProcessor::filePath()['admin_profile']['size']);
        return [

            'name' => 'required',
            'user_name' => 'required|unique:admins,user_name,'.request()->id,
            'email' => 'required|unique:admins,email,'.request()->id,
            'status' => 'in:Active,DeActive',
            'role' => ['required', new RoleAssignCheckRule()],
            'profile_image' => ['nullable', new FileExtentionCheckRule(fileFormat()), new FileLengthCheckRule($imageSize[0], $imageSize[1])],

        ];
    }

    public function messages()
    {
        return [
            'name.required' => decode('please enter  name'),
            'user_name.required' => decode('please enter User Name'),
            'user_name.unique' => decode('This User Name Is Already Taken!! Please Try Another'),
            'email.required' => decode('please enter Email'),
            'email.unique' => decode('This Eamil Is Already Taken!! Please Try Another'),
            'status.in' => decode('Choose A valid status'),
            'role.required' => decode('Choose A Role Name'),
        ];
    }
}
