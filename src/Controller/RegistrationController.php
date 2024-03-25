<?php

namespace App\Controller;

use App\Controller;
use App\Service\CSRFTokenService;
use App\Service\UserRegistrationService;
use App\View;

class RegistrationController extends Controller
{
    public function __construct(
        private UserRegistrationService $user_registration_service,
        private CSRFTokenService        $csrf_token_service
    )
    {
    }

    public function register(array $request): void
    {
        $this->csrf_token_service->validateToken($request['params']['token']);

        $this->user_registration_service->handle(
            $request['params']['email'],
            $request['params']['first_name'],
            $request['params']['second_name'],
            $request['params']['password'],
            $request['user_agent']
        );

        View::render('registered');
    }

    public function index(): void
    {
        $this->csrf_token_service->createToken();

        View::render('register', [
            'token' => $_SESSION['token']
        ]);
    }
}