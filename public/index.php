<?php

require __DIR__ . '/../vendor/autoload.php';

use AltoRouter;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$router = new AltoRouter();
$router->setBasePath('');

require __DIR__ . '/../routes/web.php';

$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    http_response_code(404);
    $pageController = new App\Controllers\PageController();
    $pageController->not_found();
}
