<?php

use AltoRouter;
use App\Controllers\HomeController;

require __DIR__ . '/../vendor/autoload.php';

$router = new AltoRouter();

$router->setBasePath('');

$router->map('GET', '/', [HomeController::class, 'index']);

$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo "404 Not Found";
}
