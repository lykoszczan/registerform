<?php

namespace App;

use InvalidArgumentException;

class Router
{
    protected array $routes = [];

    private function addRoute(string $route, string $controller, string $action, string $method): void
    {
        $this->routes[$method][$route] = [
            'controller' => $controller,
            'action'     => $action
        ];
    }

    public function get(string $route, string $controller, string $action): void
    {
        $this->addRoute($route, $controller, $action, "GET");
    }

    public function post(string $route, string $controller, string $action): void
    {
        $this->addRoute($route, $controller, $action, "POST");
    }

    public function dispatch(): void
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];

        if (!array_key_exists($uri, $this->routes[$method])) {
            throw new InvalidArgumentException("No route found for URI: $uri", 404);
        }

        $controller = $this->routes[$method][$uri]['controller'];
        $action = $this->routes[$method][$uri]['action'];

        $controller = new $controller();
        $controller->$action();
    }
}