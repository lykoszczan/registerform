<?php

namespace App\Exception\User;

use Exception;

class UserAlreadyExistsException extends Exception
{
    public function __construct()
    {
        parent::__construct('User already exists');
    }
}