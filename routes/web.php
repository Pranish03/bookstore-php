<?php

use App\Controllers\PageController;
use App\Controllers\BooksController;

$pageController = new PageController();
$booksController = new BooksController();

$router->map('GET', '/', [$pageController, 'home']);

$router->map('GET', '/admin/books', [$booksController, 'index']);
$router->map('GET', '/admin/books/create', [$booksController, 'create']);
$router->map('POST', '/admin/books', [$booksController, 'store']);
