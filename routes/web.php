<?php

use App\Controllers\PageController;
use App\Controllers\AuthController;
use App\Controllers\CartController;
use App\Controllers\CheckoutController;
use App\Controllers\BooksController;


$pageController  = new PageController();
$authController  = new AuthController();
$cartController = new CartController();
$checkoutController = new CheckoutController();
$booksController = new BooksController();

$router->map('GET', '/', [$pageController,  'home']);
$router->map('GET', '/book/[i:id]', [$pageController,  'book']);
$router->map('GET', '/register', [$pageController,  'register']);
$router->map('GET', '/login', [$pageController,  'login']);

$router->map('POST', '/register', [$authController,  'register']);
$router->map('POST', '/login', [$authController,  'login']);
$router->map('POST', '/logout', [$authController,  'logout']);

$router->map('GET',  '/cart',        [$cartController, 'index']);
$router->map('POST', '/cart/add',    [$cartController, 'add']);
$router->map('POST', '/cart/update', [$cartController, 'update']);
$router->map('POST', '/cart/remove', [$cartController, 'remove']);

$router->map('GET',  '/checkout',      [$checkoutController, 'index']);
$router->map('POST', '/checkout',      [$checkoutController, 'store']);
$router->map('GET',  '/orders',        [$checkoutController, 'history']);
$router->map('GET',  '/orders/[i:id]', [$checkoutController, 'show']);

$router->map('GET', '/admin/books', [$booksController, 'index']);
$router->map('GET', '/admin/books/create', [$booksController, 'create']);
$router->map('GET', '/admin/books/[i:id]', [$booksController, 'show']);
$router->map('POST', '/admin/books', [$booksController, 'store']);
$router->map('GET', '/admin/books/[i:id]/edit', [$booksController, 'edit']);
$router->map('PUT', '/admin/books/[i:id]', [$booksController, 'update']);
$router->map('DELETE', '/admin/books/[i:id]', [$booksController, 'destroy']);
