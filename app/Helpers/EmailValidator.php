<?php

namespace App\Helpers;

class EmailValidator
{
    public static function isValid($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}
