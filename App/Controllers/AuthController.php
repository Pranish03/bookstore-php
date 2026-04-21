<?php

namespace App\Controllers;

use App\Models\User;
use App\Validation\AuthValidator;

class AuthController extends BaseController
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function register()
    {
        $validator = new AuthValidator();

        if (! $validator->validate($_POST, true)) {
            $_SESSION['errors']    = $validator->getErrors();
            $_SESSION['old_input'] = $_POST;
            header('Location: /register');
            exit;
        }

        $data = $validator->validated();

        if ($this->user->emailExists($data['email'])) {
            $_SESSION['errors']    = ['email' => 'An account with that email already exists.'];
            $_SESSION['old_input'] = $_POST;
            header('Location: /register');
            exit;
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if (! $this->user->create($data)) {
            $_SESSION['errors']    = ['general' => 'Registration failed. Please try again.'];
            $_SESSION['old_input'] = $_POST;
            header('Location: /register');
            exit;
        }

        $sessionUser = $this->user->findByEmail($data['email']);

        unset($sessionUser['password']);

        $_SESSION['user']    = $sessionUser;
        $_SESSION['success'] = 'Registration successful.';
        header('Location: /');
        exit;
    }

    public function login()
    {
        // Logic for handling user login
    }

    public function logout()
    {
        // Logic for handling user logout
    }
}
