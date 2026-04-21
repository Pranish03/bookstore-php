<?php

namespace App\Controllers;

use App\Models\Book;

class PageController extends BaseController
{
    private Book $book;

    public function __construct()
    {
        $this->book = new Book();
    }

    public function index()
    {
        $books = $this->book->all();
        $this->view('page.index', ['books' => $books]);
    }

    public function show($id)
    {
        $book = $this->book->find($id);
        if (!$book) {
            $this->not_found();
            return;
        }
        $this->view('page.show', ['book' => $book]);
    }

    public function not_found()
    {
        $this->view('errors.404');
    }
}
