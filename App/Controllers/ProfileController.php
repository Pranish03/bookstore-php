<?php

namespace App\Controllers;

use App\Middlewares\AuthMiddleware;
use App\Models\User;

class ProfileController extends BaseController
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function show()
    {
        (new AuthMiddleware())->handle();

        $user = $this->user->find($_SESSION['user']['id']);
        $this->view('page.profile', compact('user'));
    }

    public function updateInfo()
    {
        (new AuthMiddleware())->handle();

        $userId = $_SESSION['user']['id'];
        $name   = trim($_POST['name'] ?? '');
        $email  = trim($_POST['email'] ?? '');
        $errors = [];

        if (empty($name)) {
            $errors['name'] = 'Name is required.';
        } elseif (strlen($name) > 255) {
            $errors['name'] = 'Name must be under 255 characters.';
        }

        if (empty($email)) {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format.';
        } elseif ($this->isEmailTakenByOther($email, $userId)) {
            $errors['email'] = 'That email is already in use.';
        }

        if (!empty($errors)) {
            $_SESSION['errors']     = $errors;
            $_SESSION['old_input']  = $_POST;
            $_SESSION['active_tab'] = 'info';
            header('Location: /profile');
            exit;
        }

        $this->user->update($userId, ['name' => $name, 'email' => $email]);

        $_SESSION['user']['name']  = $name;
        $_SESSION['user']['email'] = $email;

        $_SESSION['success']    = 'Profile updated successfully.';
        $_SESSION['active_tab'] = 'info';
        header('Location: /profile');
        exit;
    }

    public function changePassword()
    {
        (new AuthMiddleware())->handle();

        $userId  = $_SESSION['user']['id'];
        $current = $_POST['current_password'] ?? '';
        $new     = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';
        $errors  = [];

        $user = $this->user->find($userId);

        if (empty($current)) {
            $errors['current_password'] = 'Current password is required.';
        } elseif (!password_verify($current, $user['password'])) {
            $errors['current_password'] = 'Current password is incorrect.';
        }

        if (empty($new)) {
            $errors['new_password'] = 'New password is required.';
        } elseif (strlen($new) < 8) {
            $errors['new_password'] = 'Password must be at least 8 characters.';
        }

        if (empty($confirm)) {
            $errors['confirm_password'] = 'Please confirm your new password.';
        } elseif (empty($errors['new_password']) && $new !== $confirm) {
            $errors['confirm_password'] = 'Passwords do not match.';
        }

        if (!empty($errors)) {
            $_SESSION['errors']    = $errors;
            $_SESSION['active_tab'] = 'password';
            header('Location: /profile');
            exit;
        }

        $this->user->update($userId, [
            'password' => password_hash($new, PASSWORD_DEFAULT)
        ]);

        $_SESSION['success']    = 'Password changed successfully.';
        $_SESSION['active_tab'] = 'password';
        header('Location: /profile');
        exit;
    }

    public function uploadAvatar()
    {
        (new AuthMiddleware())->handle();

        $userId = $_SESSION['user']['id'];
        $file   = $_FILES['avatar'] ?? null;

        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['errors']     = ['avatar' => 'Please select an image to upload.'];
            $_SESSION['active_tab'] = 'avatar';
            header('Location: /profile');
            exit;
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $maxSize      = 2 * 1024 * 1024;

        if (!in_array($file['type'], $allowedTypes)) {
            $_SESSION['errors']     = ['avatar' => 'Image must be JPG, PNG, or WEBP.'];
            $_SESSION['active_tab'] = 'avatar';
            header('Location: /profile');
            exit;
        }

        if ($file['size'] > $maxSize) {
            $_SESSION['errors']     = ['avatar' => 'Image must be under 2MB.'];
            $_SESSION['active_tab'] = 'avatar';
            header('Location: /profile');
            exit;
        }

        $ext        = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename   = 'avatar_' . $userId . '_' . uniqid() . '.' . $ext;
        $uploadDir  = __DIR__ . '/../../public/uploads/avatars/';
        $uploadPath = $uploadDir . $filename;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $currentUser = $this->user->find($userId);
        if (!empty($currentUser['profile'])) {
            $oldPath = __DIR__ . '/../../public/' . $currentUser['profile'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $_SESSION['errors']     = ['avatar' => 'Failed to upload image. Please try again.'];
            $_SESSION['active_tab'] = 'avatar';
            header('Location: /profile');
            exit;
        }

        $profilePath = 'uploads/avatars/' . $filename;
        $this->user->update($userId, ['profile' => $profilePath]);

        $_SESSION['user']['profile'] = $profilePath;

        $_SESSION['success']    = 'Profile picture updated.';
        $_SESSION['active_tab'] = 'avatar';
        header('Location: /profile');
        exit;
    }

    public function removeAvatar()
    {
        (new AuthMiddleware())->handle();

        $userId = $_SESSION['user']['id'];
        $user   = $this->user->find($userId);

        if (!empty($user['profile'])) {
            $oldPath = __DIR__ . '/../../public/' . $user['profile'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $this->user->update($userId, ['profile' => null]);
        $_SESSION['user']['profile'] = null;

        $_SESSION['success']    = 'Profile picture removed.';
        $_SESSION['active_tab'] = 'avatar';
        header('Location: /profile');
        exit;
    }

    private function isEmailTakenByOther(string $email, int $userId): bool
    {
        $existing = $this->user->findByEmail($email);
        return $existing && (int) $existing['id'] !== $userId;
    }
}
