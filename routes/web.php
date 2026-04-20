<?php

use App\Controllers\PageController;
use App\Controllers\BookController;

$pageController = new PageController();
$bookController = new BookController();

$router->map('GET', '/', [$pageController, 'home']);

$router->map('GET', '/admin/books/create', [$bookController, 'create']);
$router->map('POST', '/admin/books', [$bookController, 'store']);
