<?php

namespace App\Service;

use App\Model\User;

class BotDetectionService
{
    private const array NOT_ALLOWED_USER_AGENTS = [];

    public function isBot(User $user_to_register, string $user_agent): bool
    {
        return
            !(
                $this->isEmailCorrect($user_to_register->getEmail()) &&
                $this->isEmailVerified($user_to_register->getEmail()) &&
                $this->isUserAgentValid($user_agent)
            );
    }

    private function isEmailCorrect(string $email): bool
    {
        return true;
    }

    private function isEmailVerified(string $email): bool
    {
        return true;
    }

    private function isUserAgentValid(string $user_agent): bool
    {
        return !in_array($user_agent, self::NOT_ALLOWED_USER_AGENTS, true);
    }
}