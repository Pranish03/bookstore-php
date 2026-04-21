<?php

namespace App\Models;

class User extends Model
{
    protected string $table = 'users';

    public function findByEmail(string $email): ?array
    {
        $stmt = self::getConnection()->prepare(
            "SELECT * FROM {$this->table} WHERE email = ?"
        );
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    }

    public function emailExists(string $email): bool
    {
        $stmt = self::getConnection()->prepare(
            "SELECT COUNT(*) FROM {$this->table} WHERE email = ?"
        );
        $stmt->execute([$email]);
        return (int) $stmt->fetchColumn() > 0;
    }

    public function search(string $query): array
    {
        $like = '%' . $query . '%';
        $stmt = self::getConnection()->prepare("
        SELECT * FROM {$this->table}
        WHERE name LIKE ? OR email LIKE ?
        ORDER BY created_at DESC
    ");
        $stmt->execute([$like, $like]);
        return $stmt->fetchAll();
    }

    public function allOrdered(): array
    {
        $stmt = self::getConnection()->query(
            "SELECT * FROM {$this->table} ORDER BY created_at DESC"
        );
        return $stmt->fetchAll();
    }
}
