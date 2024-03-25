<?php

namespace App\Model;

class User
{
    public function __construct(
        private string $email,
        private string $first_name,
        private string $second_name,
        private string $password_hash,
    )
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getSecondName(): string
    {
        return $this->second_name;
    }

    public function getPasswordHash(): string
    {
        return $this->password_hash;
    }
}