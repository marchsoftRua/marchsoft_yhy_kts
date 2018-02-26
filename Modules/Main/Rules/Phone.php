<?php

namespace Modules\Main\Rules;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule
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
        //
        if(empty($value))
            return true;
        $isMatched = preg_match_all('/^((1[3,5,8][0-9])|(14[5,7])|(17[0,6,7,8])|(19[7]))\d{8}$/', $value);
        return $isMatched;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '你这个手机号不是很合适!';
    }
}
