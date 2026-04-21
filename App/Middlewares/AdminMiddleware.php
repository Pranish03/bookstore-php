<?php

namespace App\Middleware;

class AdminMiddleware
{
    public function handle(): void
    {
        if (! isset($_SESSION['user'])) {
            $_SESSION['errors'] = ['general' => 'You must be logged in to access that page.'];
            header('Location: /login');
            exit;
        }

        if (($_SESSION['user']['role'] ?? '') !== 'admin') {
            header('Location: /');
            exit;
        }
    }
}
