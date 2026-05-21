<?php

namespace Lib;

class Router
{
    private static array $routes = [
        "GET" => [],
        "POST" => [],
    ];

    private static function convertRouteToRegex(string $route): string
    {
        return "#^" .
            preg_replace("/\{([a-zA-Z_]+)\}/", "([a-zA-Z0-9\-]+)", $route) .
            "$#";
    }

    public static function get(string $route, mixed $callback): void
    {
        self::$routes["GET"][] = [
            "pattern" => self::convertRouteToRegex($route),
            "callback" => $callback,
        ];
    }

    public static function post(string $route, mixed $callback): void
    {
        self::$routes["POST"][] = [
            "pattern" => self::convertRouteToRegex($route),
            "callback" => $callback,
        ];
    }

    public static function dispatch()
    {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = $_SERVER["REQUEST_METHOD"];

        foreach (self::$routes[$method] ?? [] as $route) {
            if (preg_match($route["pattern"], $uri, $matches)) {
                array_shift($matches);

                $callback = $route["callback"];

                if (is_array($callback)) {
                    [$class, $action] = $callback;

                    $controller = new $class();

                    return $controller->$action(...$matches);
                }

                return $callback(...$matches);
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
