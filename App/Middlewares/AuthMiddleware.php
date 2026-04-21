<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function handle(): void
    {
        if (! isset($_SESSION['user'])) {
            $_SESSION['errors'] = ['general' => 'You must be logged in to access that page.'];
            header('Location: /login');
            exit;
        }
    }
}
