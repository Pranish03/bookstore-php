<?php

namespace App\Models;

class Book extends Model
{
    protected string $table = 'books';

    public function findByAuthor(string $author): array
    {
        $stmt = self::getConnection()->prepare(
            "SELECT * FROM {$this->table} WHERE author = ?"
        );
        $stmt->execute([$author]);
        return $stmt->fetchAll();
    }
}
