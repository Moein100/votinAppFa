<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckBasuStudent implements Rule
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
        return strpos($value,"@basu.ac.ir") ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'شما باید دانشجوی داشنگاه بوعلی همدان باشید <a href="/aboute-us" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">این لینکو چک کنین</a>';
    }
}
