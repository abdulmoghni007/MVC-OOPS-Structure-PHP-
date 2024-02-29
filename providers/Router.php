<?php

namespace App\Providers;

use App\Services\UserService;
use Closure;
use Exception;

class Router
{
    protected static $routes = [];
    protected static $authRequiredRotes = [];

    private static function addRoute(string $method, string $url, Closure | array $target, bool $isAuthRequired)
    {
        SELF::$routes[$method][$url] = $target;
        if ($isAuthRequired) {
            SELF::$authRequiredRotes[$method][$url] = $target;
            return;
        }
    }

    public static function matchRoute()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];
        if (isset(SELF::$routes[$method])) {
            foreach (SELF::$routes[$method] as $routeUrl => $target) {
                if (isset(SELF::$authRequiredRotes[$method][$url])) {
                    self::auth();
                }
                if ($routeUrl === $url) {
                    if (is_array($target)) {
                        $controller = $target[0];
                        $method = $target[1];
                        $output = (new $controller)->$method();
                        return $output;
                    }
                    $output = call_user_func($target);
                    return $output;
                }
            }
        }
        throw new Exception('Route not found');
    }

    public static function get(string $url, Closure | array $target, bool $isAuthRequired = false)
    {
        SELF::addRoute('GET', $url, $target, $isAuthRequired);
    }

    public static function post(string $url, array | Closure $target, bool $isAuthRequired = false)
    {
        SELF::addRoute('POST', $url, $target, $isAuthRequired);
    }

    public static function auth()
    {
        UserService::validateToken();
        return new self;
    }
}
