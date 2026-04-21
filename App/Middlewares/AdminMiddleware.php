<?php

namespace App\Middlewares;

use App\Models\User;

class AdminMiddleware
{
    public function handle(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $user = (new User())->find($_SESSION['user']['id']);

        if (!$user || empty($user['is_admin'])) {
            header('Location: /');
            exit;
        }

        $_SESSION['user']['is_admin'] = $user['is_admin'];
    }
}
