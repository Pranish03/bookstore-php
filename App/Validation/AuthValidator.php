<?php

namespace App\Validation;

class AuthValidator
{
    private array $errors = [];
    private array $data = [];

    public function validate(array $post, bool $isRegistration = false): bool
    {
        $this->errors = [];
        $this->data = [];

        if ($isRegistration) {
            if (empty(trim($post['name'] ?? ''))) {
                $this->errors['name'] = 'Name is required.';
            } elseif (strlen($post['name']) > 255) {
                $this->errors['name'] = 'Name must be under 255 characters.';
            }
        }

        if (empty(trim($post['email'] ?? ''))) {
            $this->errors['email'] = 'Email is required.';
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email format is invalid.';
        }

        if (empty(trim($post['password'] ?? ''))) {
            $this->errors['password'] = 'Password is required.';
        } elseif (strlen($post['password']) < 8) {
            $this->errors['password'] = 'Password must be at least 8 characters.';
        }

        if ($isRegistration) {
            if (empty(trim($post['confirm_password'] ?? ''))) {
                $this->errors['confirm_password'] = 'Confirm Password is required.';
            } elseif (
                empty($this->errors['password']) &&
                $post['password'] !== $post['confirm_password']
            ) {
                $this->errors['confirm_password'] = 'Passwords do not match.';
            }
        }

        if (empty($this->errors)) {
            $this->data = [
                'email'    => trim($post['email']),
                'password' => $post['password'],
            ];

            if ($isRegistration) {
                $this->data['name'] = trim($post['name'] ?? '');
            }
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function validated(): array
    {
        return $this->data;
    }
}
