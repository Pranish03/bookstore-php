<?php

use App\Controllers\PageController;
use App\Controllers\AuthController;
use App\Controllers\BooksController;

$pageController = new PageController();
$authController = new AuthController();
$booksController = new BooksController();

$router->map('GET', '/', [$pageController, 'home']);
$router->map('GET', '/book/[i:id]', [$pageController, 'book']);
$router->map('GET', '/register', [$pageController, 'register']);
$router->map('GET', '/login', [$pageController, 'login']);

$router->map('POST', '/register', [$authController, 'register']);
$router->map('POST', '/login', [$authController, 'login']);

$router->map('GET', '/admin/books', [$booksController, 'index']);
$router->map('GET', '/admin/books/[i:id]', [$booksController, 'show']);
$router->map('GET', '/admin/books/create', [$booksController, 'create']);
$router->map('POST', '/admin/books', [$booksController, 'store']);
$router->map('GET', '/admin/books/[i:id]/edit', [$booksController, 'edit']);
$router->map('PUT', '/admin/books/[i:id]', [$booksController, 'update']);
$router->map('DELETE', '/admin/books/[i:id]', [$booksController, 'destroy']);
