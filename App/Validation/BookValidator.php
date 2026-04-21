<?php

namespace App\Validation;

class BookValidator
{
    private array $errors = [];
    private array $data = [];

    public function validate(array $post, array $files, bool $requireImage = true): bool
    {
        $this->errors = [];

        if (empty(trim($post['title'] ?? ''))) {
            $this->errors['title'] = 'Title is required.';
        } elseif (strlen($post['title']) > 255) {
            $this->errors['title'] = 'Title must be under 255 characters.';
        }

        if (empty(trim($post['author'] ?? ''))) {
            $this->errors['author'] = 'Author is required.';
        }

        if (!isset($post['price']) || $post['price'] === '') {
            $this->errors['price'] = 'Price is required.';
        } elseif (!is_numeric($post['price']) || $post['price'] < 0) {
            $this->errors['price'] = 'Price must be a positive number.';
        }

        if (isset($post['discount']) && $post['discount'] !== '') {
            if (!is_numeric($post['discount'])) {
                $this->errors['discount'] = 'Discount must be a number.';
            } elseif ($post['discount'] < 0 || $post['discount'] > 100) {
                $this->errors['discount'] = 'Discount must be between 0.00 and 100.00.';
            }
        }

        if (empty(trim($post['description'] ?? ''))) {
            $this->errors['description'] = 'Description is required.';
        }

        if (empty(trim($post['isbn'] ?? ''))) {
            $this->errors['isbn'] = 'ISBN is required.';
        } elseif (!preg_match('/^[0-9\-]{10,17}$/', $post['isbn'])) {
            $this->errors['isbn'] = 'ISBN format is invalid.';
        }

        if (empty($post['published_on'] ?? '')) {
            $this->errors['published_on'] = 'Published date is required.';
        } elseif (!strtotime($post['published_on'])) {
            $this->errors['published_on'] = 'Published date is invalid.';
        }

        if (empty(trim($post['published_by'] ?? ''))) {
            $this->errors['published_by'] = 'Publisher is required.';
        }

        if (!isset($post['pages']) || $post['pages'] === '') {
            $this->errors['pages'] = 'Pages is required.';
        } elseif (!filter_var($post['pages'], FILTER_VALIDATE_INT) || $post['pages'] < 1) {
            $this->errors['pages'] = 'Pages must be a positive integer.';
        }

        if ($requireImage) {
            if (empty($files['image']['name'])) {
                $this->errors['image'] = 'Image is required.';
            }
        }

        if (!empty($files['image']['name'])) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            $maxSize = 2 * 1024 * 1024;

            if (!in_array($files['image']['type'], $allowedTypes)) {
                $this->errors['image'] = 'Image must be JPG, PNG, or WEBP.';
            } elseif ($files['image']['size'] > $maxSize) {
                $this->errors['image'] = 'Image must be under 2MB.';
            }
        }

        if (empty($this->errors)) {
            $this->data = [
                'title'        => trim($post['title']),
                'author'       => trim($post['author']),
                'price'        => (float) $post['price'],
                'discount'     => isset($post['discount']) && $post['discount'] !== '' ? (float) $post['discount'] : 0.00,
                'description'  => trim($post['description']),
                'isbn'         => trim($post['isbn']),
                'published_on' => $post['published_on'],
                'published_by' => trim($post['published_by']),
                'pages'        => (int) $post['pages'],
            ];
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function validated(): array
    {
        return $this->data;
    }
}
