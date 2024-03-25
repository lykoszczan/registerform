<?php

namespace App\Service;

class PasswordHashService
{
    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, [
            'cost' => 12
        ]);
    }
}