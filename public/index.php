<?php

declare(strict_types= 1);

use App\App;
use App\Container;
use App\Controller\HomeController;
use App\Database;
use App\Repository;

require_once dirname(__DIR__) ."/vendor/autoload.php";

$container = new DI\Container([
    Database::class => function () {
        return new Database(
            host:"127.0.0.1",
            name:"test",
            user:"root",
            password:""
        );
    },
]);

$app = $container->get(App::class);

$app->get('/', [HomeController::class,'index']);

$app->get('/about', function() {
    echo "This is about page";
});

$app->run();
