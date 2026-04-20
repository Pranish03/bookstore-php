<?php

use App\Controllers\PageController;

$pageController = new PageController();

$router->map('GET', '/', [$pageController, 'home']);
