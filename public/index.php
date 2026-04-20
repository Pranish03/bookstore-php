<?php

use AltoRouter;
use App\Controllers\HomeController;

require __DIR__ . '/../vendor/autoload.php';

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
