<?php

namespace App\Controllers;

class PageController extends BaseController
{
    public function home()
    {
        $books = [
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald'],
            ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee'],
            ['title' => '1984', 'author' => 'George Orwell'],
        ];

        $this->view('page.index', ['books' => $books]);
    }

    public function not_found()
    {
        $this->view('errors.404');
    }
}
