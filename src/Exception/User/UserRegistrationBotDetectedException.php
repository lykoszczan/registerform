<?php

namespace App\Exception\User;

use Exception;

class UserRegistrationBotDetectedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Bot detected');
    }
}