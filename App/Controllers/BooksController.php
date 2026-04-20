<?php

namespace App\Controllers;

use App\Models\Book;
use App\Validation\BookValidator;

class BooksController extends BaseController
{
    private Book $book;

    public function __construct()
    {
        $this->book = new Book();
    }

    public function index()
    {
        $books = $this->book->all();
        $this->view('admin.books.index', ['books' => $books]);
    }

    public function create()
    {
        $this->view('admin.books.create');
    }

    public function store()
    {
        $validator = new BookValidator();

        if (! $validator->validate($_POST, $_FILES)) {
            $_SESSION['errors']   = $validator->errors();
            $_SESSION['old_input'] = $_POST;
            header('Location: /admin/books/create');
            exit;
        }

        $data = $validator->validated();

        $image = $_FILES['image'];
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $filename = uniqid('book_', true) . '.' . $ext;
        $uploadPath = __DIR__ . '/../../public/uploads/books/' . $filename;

        if (! move_uploaded_file($image['tmp_name'], $uploadPath)) {
            $_SESSION['errors'] = ['image' => 'Failed to upload image.'];
            $_SESSION['old_input'] = $_POST;
            header('Location: /admin/books/create');
            exit;
        }

        $data['image'] = 'uploads/books/' . $filename;

        $this->book->create($data);

        $_SESSION['success'] = 'Book added successfully.';
        header('Location: /admin/books');
        exit;
    }
}
