<?php

namespace App\Controllers;

use App\Middlewares\AdminMiddleware;
use App\Middlewares\GuestMiddleware;
use App\Models\Book;
use App\Models\Order;
use App\Models\User;

class PageController extends BaseController
{
    private Book $book;

    public function __construct()
    {
        $this->book = new Book();
    }

    public function home()
    {
        $books = $this->book->all();
        $this->view('page.index', compact('books'));
    }

    public function book($id)
    {
        $book = $this->book->find($id);
        if (!$book) {
            $this->not_found();
            return;
        }
        $this->view('page.book', compact('book'));
    }

    public function search()
    {
        $query = trim($_GET['q'] ?? '');

        if (empty($query)) {
            $this->redirect('/');
        }

        $books = $this->book->search($query);
        $this->view('page.search', compact('books', 'query'));
    }

    public function dashboard()
    {
        (new AdminMiddleware())->handle();

        $book  = new Book();
        $user  = new User();
        $order = new Order();

        $data = [
            'totalBooks'       => count($book->all()),
            'totalUsers'       => count($user->all()),
            'totalOrders'      => count($order->all()),
            'totalRevenue'     => $order->getTotalRevenue(),
            'ordersByStatus'   => $order->getCountByStatus(),
            'recentOrders'     => $order->getRecent(5),
            'recentUsers'      => $user->getRecent(5),
        ];

        $this->view('admin.dashboard', $data);
    }

    public function register()
    {
        (new GuestMiddleware())->handle();

        $this->view('page.register');
    }

    public function login()
    {
        (new GuestMiddleware())->handle();

        $this->view('page.login');
    }

    public function not_found()
    {
        $this->view('errors.404');
    }
}
