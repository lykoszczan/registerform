<?php

namespace App;

use InvalidArgumentException;

class View
{
    public static function render(string $view, array $params = []): void
    {
        extract($params);

        $view_path = __DIR__ . "/View/$view.php";

        if (!is_readable($view_path)) {
            throw new InvalidArgumentException("View $view not found");
        }

        require_once $view_path;
    }

    public static function renderError(): void
    {
        $view_path = __DIR__ . "/View/error.php";

        if (!is_readable($view_path)) {
            throw new InvalidArgumentException("Error view not found");
        }

        include $view_path;
    }
}