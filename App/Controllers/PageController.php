<?php

namespace App\Controllers;

use App\Middlewares\GuestMiddleware;
use App\Models\Book;

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
        $this->view('page.index', ['books' => $books]);
    }

    public function book($id)
    {
        $book = $this->book->find($id);
        if (!$book) {
            $this->not_found();
            return;
        }
        $this->view('page.book', ['book' => $book]);
    }

    public function search()
    {
        $query = trim($_GET['q'] ?? '');

        if (empty($query)) {
            header('Location: /');
            exit;
        }

        $books = $this->book->search($query);
        $this->view('page.search', compact('books', 'query'));
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
