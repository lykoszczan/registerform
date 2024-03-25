<?php

namespace App\Service;

use App\Exception\CSRF\InvalidTokenException;
use App\Exception\CSRF\TokenExpiredException;
use InvalidArgumentException;

class CSRFTokenService
{
    public function createToken(int $token_time = 3600): void
    {
        session_start();
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        $_SESSION['token_expire'] = time() + $token_time;
        session_write_close();
    }

    public function validateToken(string $form_token): void
    {
        session_start();
        $session_token = $_SESSION['token'];
        $session_time = $_SESSION['token_expire'];

        if (!$session_token) {
            throw new InvalidArgumentException('session token cannot be empty');
        }

        if ($session_token !== $form_token) {
            throw new InvalidTokenException();
        }

        if (time() > $session_time) {
            throw new TokenExpiredException();
        }

        unset($_SESSION['token'], $_SESSION['token_expire']);
        session_write_close();
    }
}