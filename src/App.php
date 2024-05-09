<?php

declare(strict_types= 1);

namespace App;

use App\Http\Router;
use DI\Container;

class App {
    public function __construct(
        private Router $router,
        private Container $container
        ) {

    }
    public function run() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch(path: $path, method: $method, container: $this->container);
    }

    public function get(string $path, array|callable $controller) {
        $this->router->addRoutes(
            method:'GET',
            path: $path,
            controller: $controller);
    }
}