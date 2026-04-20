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

    public function show($id)
    {
        $book = $this->book->find($id);

        if (! $book) {
            $_SESSION['error'] = 'Book not found.';
            header('Location: /admin/books');
            exit;
        }

        $this->view('admin.books.show', ['book' => $book]);
    }

    public function create()
    {
        $this->view('admin.books.create');
    }

    public function store()
    {
        $validator = new BookValidator();

        if (! $validator->validate($_POST, $_FILES, true)) {
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

        if (! is_dir(dirname($uploadPath))) {
            mkdir(dirname($uploadPath), 0755, true);
        }

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

    public function edit($id)
    {
        $book = $this->book->find($id);

        if (! $book) {
            $_SESSION['error'] = 'Book not found.';
            header('Location: /admin/books');
            exit;
        }

        $this->view('admin.books.edit', ['book' => $book]);
    }
    public function update($id)
    {
        $book = $this->book->find($id);

        if (! $book) {
            $_SESSION['error'] = 'Book not found.';
            header('Location: /admin/books');
            exit;
        }

        $validator = new BookValidator();

        if (! $validator->validate($_POST, $_FILES, false)) {
            $_SESSION['errors']   = $validator->errors();
            $_SESSION['old_input'] = $_POST;
            header("Location: /admin/books/{$id}/edit");
            exit;
        }

        $data = $validator->validated();

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image'];
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $filename = uniqid('book_', true) . '.' . $ext;
            $uploadPath = __DIR__ . '/../../public/uploads/books/' . $filename;

            if (! is_dir(dirname($uploadPath))) {
                mkdir(dirname($uploadPath), 0755, true);
            }

            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                if (file_exists(__DIR__ . '/../../public/' . $book['image'])) {
                    unlink(__DIR__ . '/../../public/' . $book['image']);
                }
                $data['image'] = 'uploads/books/' . $filename;
            } else {
                $_SESSION['errors'] = ['image' => 'Failed to upload image.'];
                $_SESSION['old_input'] = $_POST;
                header("Location: /admin/books/{$id}/edit");
                exit;
            }
        }

        $this->book->update($id, $data);

        $_SESSION['success'] = 'Book updated successfully.';
        header('Location: /admin/books');
        exit;
    }

    public function destroy($id)
    {
        $book = $this->book->find($id);

        if (! $book) {
            $_SESSION['error'] = 'Book not found.';
            header('Location: /admin/books');
            exit;
        }

        if (file_exists(__DIR__ . '/../../public/' . $book['image'])) {
            unlink(__DIR__ . '/../../public/' . $book['image']);
        }

        $this->book->delete($id);

        $_SESSION['success'] = 'Book deleted successfully.';
        header('Location: /admin/books');
        exit;
    }
}
