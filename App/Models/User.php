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
}
