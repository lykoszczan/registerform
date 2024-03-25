<?php

namespace App\Repository;

use App\Model\User;
use mysqli;

class UserRepository
{
    public function __construct(private mysqli $db)
    {
    }

    public function hasUserWithEmail(string $email): bool
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($_row = $result->fetch_assoc()) {
            return true;
        }

        return false;
    }

    public function addUser(User $user): void
    {
        $email = $user->getEmail();
        $first_name = $user->getFirstName();
        $second_name = $user->getSecondName();
        $password_hash = $user->getPasswordHash();

        $stmt = $this->db->prepare("INSERT INTO users (email, first_name, second_name, password_hash) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $first_name, $second_name, $password_hash);
        $stmt->execute();
    }
}