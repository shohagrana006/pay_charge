<?php

namespace App\Rules\General;

use Illuminate\Contracts\Validation\Rule;

class FileLengthCheckRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $width,$height;
    public function __construct($width,$height)
    {
        $this->width = $width;
        $this->height = $height;
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
        $flag = 1;
        if(is_array($value)){
            foreach($value as $image){
                $size  = getimagesize($image);
                if($this->width !=  $size[0]  &&  $this->height !=  $size[1]){
                    $flag = 0;
                    break;
                }
            }
        }else{
            $size  = getimagesize($value);
            if($this->width !=  $size[0]  &&  $this->height !=  $size[1]){
                $flag = 0;
            }         
        }

        if($flag == 1){
            return true;
        }
        else{
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
        return decode('Image size must be '.$this->width."X".$this->height);
    }
}
