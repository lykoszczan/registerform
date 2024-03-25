<?php

use App\Controller\RegistrationController;
use App\Router;

$router = new Router();

$router->get('/', RegistrationController::class, 'index');
$router->post('/registered', RegistrationController::class, 'register');

$router->dispatch();