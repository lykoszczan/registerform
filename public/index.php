<?php

require_once __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

set_error_handler('App\Error::errorHandler');
set_exception_handler('App\Error::exceptionHandler');

$router = require __DIR__ . '/../src/Routes/index.php';