<?php

namespace App\Service;

use App\Exception\User\UserAlreadyExistsException;
use App\Exception\User\UserRegistrationBotDetectedException;
use App\Model\User;
use App\Repository\UserRepository;
use InvalidArgumentException;

class UserRegistrationService
{
    public function __construct(
        private PasswordHashService $password_hash_service,
        private BotDetectionService $bot_detection_service,
        private UserRepository      $user_repository
    )
    {
    }

    public function handle(
        string $email,
        string $first_name,
        string $second_name,
        string $password,
        string $user_agent
    ): void
    {
        $model_to_register = $this->createModel($email, $first_name, $second_name, $password);

        if ($this->bot_detection_service->isBot($model_to_register, $user_agent)) {
            throw new UserRegistrationBotDetectedException();
        }

        $this->user_repository->addUser($model_to_register);
    }

    private function createModel(
        string $email,
        string $first_name,
        string $second_name,
        string $password): User
    {
        foreach (compact($email, $first_name, $second_name) as $name => $value) {
            if (empty($value)) {
                throw new InvalidArgumentException($name . ' cannot be empty');
            }
        }

        if ($this->user_repository->hasUserWithEmail($email)) {
            throw new UserAlreadyExistsException();
        }

        return new User(
            $email,
            $first_name,
            $second_name,
            $this->password_hash_service->hashPassword($password)
        );
    }
}