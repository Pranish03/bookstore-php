<?php

namespace App\Controllers;

use App\Middlewares\AdminMiddleware;
use App\Models\User;

class UsersController extends BaseController
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        (new AdminMiddleware())->handle();

        $query = trim($_GET['q'] ?? '');
        $users = $query ? $this->user->search($query) : $this->user->allOrdered();

        $this->view('admin.users.index', compact('users', 'query'));
    }

    public function show($id)
    {
        (new AdminMiddleware())->handle();

        $user = $this->user->find($id);

        if (! $user) {
            $_SESSION['error'] = 'User not found.';
            $this->redirect('/admin/users');
        }

        $this->view('admin.users.show', compact('user'));
    }

    public function toggleAdmin($id)
    {
        (new AdminMiddleware())->handle();

        if ((int) $id === (int) $_SESSION['user']['id']) {
            $_SESSION['error'] = 'You cannot change your own admin status.';
            $this->redirect("/admin/users/{$id}");
        }

        $user = $this->user->find($id);

        if (! $user) {
            $_SESSION['error'] = 'User not found.';
            $this->redirect('/admin/users');
        }

        $this->user->update($id, ['is_admin' => $user['is_admin'] ? 0 : 1]);

        $_SESSION['success'] = 'User admin status updated.';
        $this->redirect("/admin/users/{$id}");
    }

    public function destroy($id)
    {
        (new AdminMiddleware())->handle();

        if ((int) $id === (int) $_SESSION['user']['id']) {
            $_SESSION['error'] = 'You cannot delete your own account.';
            $this->redirect("/admin/users/{$id}");
        }

        $user = $this->user->find($id);

        if (! $user) {
            $_SESSION['error'] = 'User not found.';
            $this->redirect('/admin/users');
        }

        $this->user->delete($id);

        $_SESSION['success'] = 'User deleted successfully.';
        $this->redirect('/admin/users');
    }
}
