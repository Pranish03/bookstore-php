<?php

namespace App\Controllers;

use App\Models\Book;

class BookController extends BaseController
{
    private Book $book;

    public function __construct()
    {
        $this->book = new Book();
    }

    public function index()
    {
        $books = $this->book->all();
        $this->view('books.index', ['books' => $books]);
    }

    public function create()
    {
        $this->view('admin.books.create');
    }

    public function store()
    {
        var_dump($_POST);
        // $_POST;
        // $this->book->create($data);
        // header('Location: /admin/books');
    }
}
