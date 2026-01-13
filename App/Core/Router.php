<?php
namespace App\Core;
use App\Controllers\ShopController;


class Router
{
    private static array $routes = [
        'GET'  => [],
        'POST' => [],
    ];

    public static function get(string $uri, array $action): void
    {
        self::$routes['GET'][$uri] = $action;
    }

    public static function post(string $uri, array $action): void
    {
        self::$routes['POST'][$uri] = $action;
    }


    public static function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = self::normalizeUri($_SERVER['REQUEST_URI']);

        if (!isset(self::$routes[$method][$uri])) {
            self::abort(404);
            return;
        }

        [$controller, $methodAction] = self::$routes[$method][$uri];

        if (!class_exists($controller)) {
            self::abort(500, 'Controller not found');
            return;
        }

        $controllerInstance = new $controller();

        if (!method_exists($controllerInstance, $methodAction)) {
            self::abort(500, 'Method not found');
            return;
        }

        $controllerInstance->$methodAction();
    }


    private static function normalizeUri(string $uri): string
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        return rtrim($uri, '/') ?: '/';
    }

    private static function abort(int $code, string $message = ''): void
    {
        http_response_code($code);
        echo $message ?: "HTTP Error $code";
        exit;
    }
}   