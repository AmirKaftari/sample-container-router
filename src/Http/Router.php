<?php

declare(strict_types= 1);

namespace App\Http;

use DI\Container;

class Router {
    private array $routes = [];

    public function addRoutes(string $method, string $path, array|callable $controller) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller
        ];
    }

    public function dispatch(string $method, string $path, Container $container) { 
        foreach ($this->routes as $route) { 
            if($method === $route['method'] && $path === $route['path']) {
                if(is_array($route['controller'])) {
                    [$class, $function] = $route['controller'];
                    $classInstanse = $container->get($class) ?? new $class();
                    return $classInstanse->{$function}();
                }
                else if(is_callable($route['controller'])){
                    return call_user_func($route['controller']);
                }
            }
        }
        http_response_code(404);
        echo "Page not found...";
    }
}