<?php

namespace Veronica\Validator;

class Text
{

    /**
     * Check is $value not empty string
     *
     * @param mixed $value
     * @return bool
     *
     */

    public function isString($value) : bool
    {
        return is_string($value) && mb_strlen(trim($value), 'utf-8') > 0;
    }

}
