<?php

namespace App\Rules\Admin;

use Illuminate\Contracts\Validation\Rule;

class SocialMediaUpdateRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $socialMedia = array_keys(json_decode(generalSetting()->social_media, true));
        if(in_array($value, $socialMedia)){
            return true;
        }else{
            return false;
        }          
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return decode('This social media Key does not exist');
    }
}
