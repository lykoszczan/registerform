<?php

namespace App;

use ErrorException;
use Throwable;

class Error
{
    public static function errorHandler(int $level, string $message, string $file, int $line): void
    {
        if (error_reporting() !== 0) {
            throw new ErrorException($message, 0, $level, $file, $line);
        }
    }

    public static function exceptionHandler(Throwable $exception): void
    {
        $code = $exception->getCode();
        if ($code !== 404) {
            $code = 500;
        }
        error_log($exception->getMessage());
        http_response_code($code);
        View::renderError();
    }
}