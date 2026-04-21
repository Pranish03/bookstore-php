<?php

use App\Controllers\PageController;
use App\Controllers\AuthController;
use App\Controllers\ProfileController;
use App\Controllers\CartController;
use App\Controllers\CheckoutController;
use App\Controllers\UsersController;
use App\Controllers\BooksController;
use App\Controllers\OrdersController;


$pageController     = new PageController();
$profileController  = new ProfileController();
$authController     = new AuthController();
$cartController     = new CartController();
$checkoutController = new CheckoutController();
$usersController    = new UsersController();
$booksController    = new BooksController();
$ordersController   = new OrdersController();

$router->map('GET', '/',            [$pageController, 'home']);
$router->map('GET', '/book/[i:id]', [$pageController, 'book']);
$router->map('GET', '/search',      [$pageController, 'search']);
$router->map('GET', '/admin',       [$pageController, 'dashboard']);
$router->map('GET', '/register',    [$pageController, 'register']);
$router->map('GET', '/login',       [$pageController, 'login']);

$router->map('POST', '/register', [$authController,  'register']);
$router->map('POST', '/login',    [$authController,  'login']);
$router->map('POST', '/logout',   [$authController,  'logout']);

$router->map('GET',  '/profile',                 [$profileController, 'show']);
$router->map('POST', '/profile/update-info',     [$profileController, 'updateInfo']);
$router->map('POST', '/profile/change-password', [$profileController, 'changePassword']);
$router->map('POST', '/profile/upload-avatar',   [$profileController, 'uploadAvatar']);
$router->map('POST', '/profile/remove-avatar',   [$profileController, 'removeAvatar']);

$router->map('GET',  '/cart',        [$cartController, 'index']);
$router->map('POST', '/cart/add',    [$cartController, 'add']);
$router->map('POST', '/cart/update', [$cartController, 'update']);
$router->map('POST', '/cart/remove', [$cartController, 'remove']);

$router->map('GET',  '/checkout',             [$checkoutController, 'index']);
$router->map('POST', '/checkout',             [$checkoutController, 'store']);
$router->map('GET',  '/orders',               [$checkoutController, 'history']);
$router->map('GET',  '/orders/[i:id]',        [$checkoutController, 'show']);
$router->map('POST', '/orders/[i:id]/cancel', [$checkoutController, 'cancel']);

$router->map('GET',    '/admin/users',                     [$usersController, 'index']);
$router->map('GET',    '/admin/users/[i:id]',              [$usersController, 'show']);
$router->map('POST',   '/admin/users/[i:id]/toggle-admin', [$usersController, 'toggleAdmin']);
$router->map('DELETE', '/admin/users/[i:id]',              [$usersController, 'destroy']);

$router->map('GET',    '/admin/books',             [$booksController, 'index']);
$router->map('GET',    '/admin/books/create',      [$booksController, 'create']);
$router->map('GET',    '/admin/books/[i:id]',      [$booksController, 'show']);
$router->map('POST',   '/admin/books',             [$booksController, 'store']);
$router->map('GET',    '/admin/books/[i:id]/edit', [$booksController, 'edit']);
$router->map('PUT',    '/admin/books/[i:id]',      [$booksController, 'update']);
$router->map('DELETE', '/admin/books/[i:id]',      [$booksController, 'destroy']);

$router->map('GET',  '/admin/orders',               [$ordersController, 'index']);
$router->map('GET',  '/admin/orders/[i:id]',        [$ordersController, 'show']);
$router->map('POST', '/admin/orders/[i:id]/status', [$ordersController, 'updateStatus']);
