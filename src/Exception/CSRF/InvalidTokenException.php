<?php

namespace App\Exception\CSRF;

use Exception;

class InvalidTokenException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid token');
    }
}