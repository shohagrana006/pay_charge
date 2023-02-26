<?php

namespace App\Rules\Admin;

use Illuminate\Contracts\Validation\Rule;

class LengthCheckRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $length ;
    public function __construct($length)
    {
        $this->length = $length;
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
        dd($this->length);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return decode('Length Is Too Long For Country Code, More Than 5 Word is not Acceptable');
    }
}
