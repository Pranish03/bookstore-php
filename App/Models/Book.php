<?php

namespace App\Models;

class Book extends Model
{
    protected string $table = 'books';

    public function search(string $query): array
    {
        $like = '%' . $query . '%';

        $stmt = self::getConnection()->prepare("
        SELECT * FROM {$this->table}
        WHERE title LIKE ?
           OR author LIKE ?
           OR isbn LIKE ?
        ORDER BY title ASC
    ");
        $stmt->execute([$like, $like, $like]);
        return $stmt->fetchAll();
    }
}
