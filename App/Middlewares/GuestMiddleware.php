<?php

namespace App\Middlewares;

class GuestMiddleware
{
    public function handle(): void
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }
    }
}
