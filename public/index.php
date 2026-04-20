<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use AltoRouter;
use App\Controllers\HomeController;


$router = new AltoRouter();
$router->setBasePath('');

$homeController = new HomeController();

$router->map('GET', '/', [$homeController, 'index']);

$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    http_response_code(404);
    echo "404 Not Found";
}
