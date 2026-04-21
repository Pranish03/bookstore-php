<?php

namespace App\Middlewares;

class GuestMiddleware
{
    public function handle(): void
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            exit();
        }
    }
}
