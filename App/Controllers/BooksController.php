<?php

namespace App\Controllers;

use App\Middlewares\AdminMiddleware;
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
        (new AdminMiddleware())->handle();

        $query = trim($_GET['q'] ?? '');
        $books = $query ? $this->book->search($query) : $this->book->all();

        $this->view('admin.books.index', compact('books', 'query'));
    }

    public function show($id)
    {
        (new AdminMiddleware())->handle();

        $book = $this->book->find($id);

        if (! $book) {
            $_SESSION['error'] = 'Book not found.';
            $this->redirect('/admin/books');
        }

        $this->view('admin.books.show', compact('book'));
    }

    public function create()
    {
        (new AdminMiddleware())->handle();

        $this->view('admin.books.create');
    }

    public function store()
    {
        (new AdminMiddleware())->handle();

        $validator = new BookValidator();

        if (! $validator->validate($_POST, $_FILES, true)) {
            $_SESSION['errors']    = $validator->errors();
            $_SESSION['old_input'] = $_POST;
            $this->redirect('/admin/books/create');
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
            $_SESSION['errors']    = ['image' => 'Failed to upload image.'];
            $_SESSION['old_input'] = $_POST;
            $this->redirect('/admin/books/create');
        }

        $data['image'] = 'uploads/books/' . $filename;

        $this->book->create($data);

        $_SESSION['success'] = 'Book added successfully.';

        $this->redirect('/admin/books');
    }

    public function edit($id)
    {
        (new AdminMiddleware())->handle();

        $book = $this->book->find($id);

        if (! $book) {
            $_SESSION['error'] = 'Book not found.';
            $this->redirect('/admin/books');
        }

        $this->view('admin.books.edit', compact('book'));
    }

    public function update($id)
    {
        (new AdminMiddleware())->handle();

        $book = $this->book->find($id);

        if (! $book) {
            $_SESSION['error'] = 'Book not found.';
            $this->redirect('/admin/books');
        }

        $validator = new BookValidator();

        if (! $validator->validate($_POST, $_FILES, false)) {
            $_SESSION['errors']    = $validator->errors();
            $_SESSION['old_input'] = $_POST;
            $this->redirect("/admin/books/{$id}/edit");
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
                $_SESSION['errors']    = ['image' => 'Failed to upload image.'];
                $_SESSION['old_input'] = $_POST;
                $this->redirect("/admin/books/{$id}/edit");
            }
        }

        $this->book->update($id, $data);

        $_SESSION['success'] = 'Book updated successfully.';
        $this->redirect('/admin/books');
    }

    public function destroy($id)
    {
        (new AdminMiddleware())->handle();

        $book = $this->book->find($id);

        if (! $book) {
            $_SESSION['error'] = 'Book not found.';
            $this->redirect('/admin/books');
        }

        if (file_exists(__DIR__ . '/../../public/' . $book['image'])) {
            unlink(__DIR__ . '/../../public/' . $book['image']);
        }

        $this->book->delete($id);

        $_SESSION['success'] = 'Book deleted successfully.';
        $this->redirect('/admin/books');
    }
}
