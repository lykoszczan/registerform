<?php

namespace App\Exception\CSRF;

use Exception;

class TokenExpiredException extends Exception
{
    public function __construct()
    {
        parent::__construct('Token expired');
    }
}