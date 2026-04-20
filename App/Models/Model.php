<?php

namespace App\Models;

use PDO;
use PDOException;

class Model
{
    protected static ?PDO $connection = null;
    protected string $table = '';

    protected static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $config = require __DIR__ . '/../../config/database.php';

            $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}";

            try {
                self::$connection = new PDO($dsn, $config['username'], $config['password'], $config['options']);
            } catch (PDOException $e) {
                throw new PDOException("Connection failed: " . $e->getMessage());
            }
        }

        return self::$connection;
    }

    public function all(): array
    {
        $stmt = self::getConnection()->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    public function find(int $id): array|false
    {
        $stmt = self::getConnection()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): string
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $stmt = self::getConnection()->prepare(
            "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})"
        );
        $stmt->execute(array_values($data));

        return self::getConnection()->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $fields = implode(', ', array_map(fn($col) => "{$col} = ?", array_keys($data)));

        $stmt = self::getConnection()->prepare(
            "UPDATE {$this->table} SET {$fields} WHERE id = ?"
        );

        return $stmt->execute([...array_values($data), $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = self::getConnection()->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
