<?php

namespace App\Models;

class Cart extends Model
{
    protected string $table = 'carts';

    public function getOrCreateForUser(int $userId): array
    {
        $stmt = self::getConnection()->prepare(
            "SELECT * FROM {$this->table} WHERE user_id = ? LIMIT 1"
        );
        $stmt->execute([$userId]);
        $cart = $stmt->fetch();

        if (! $cart) {
            $stmt = self::getConnection()->prepare(
                "INSERT INTO {$this->table} (user_id) VALUES (?)"
            );
            $stmt->execute([$userId]);
            return $this->find((int) self::getConnection()->lastInsertId());
        }

        return $cart;
    }

    public function getOrCreateForSession(string $sessionId): array
    {
        $stmt = self::getConnection()->prepare(
            "SELECT * FROM {$this->table} WHERE session_id = ? AND user_id IS NULL LIMIT 1"
        );
        $stmt->execute([$sessionId]);
        $cart = $stmt->fetch();

        if (! $cart) {
            $stmt = self::getConnection()->prepare(
                "INSERT INTO {$this->table} (session_id) VALUES (?)"
            );
            $stmt->execute([$sessionId]);
            return $this->find((int) self::getConnection()->lastInsertId());
        }

        return $cart;
    }

    public function mergeSessionCartIntoUser(string $sessionId, int $userId): void
    {
        $sessionCart = $this->getBySession($sessionId);
        if (! $sessionCart) return;

        $userCart = $this->getOrCreateForUser($userId);

        $stmt = self::getConnection()->prepare("
            INSERT INTO cart_items (cart_id, book_id, quantity)
            SELECT ?, book_id, quantity FROM cart_items WHERE cart_id = ?
            ON DUPLICATE KEY UPDATE quantity = cart_items.quantity + VALUES(quantity)
        ");
        $stmt->execute([$userCart['id'], $sessionCart['id']]);

        $this->delete($sessionCart['id']);
    }

    public function getBySession(string $sessionId): array|false
    {
        $stmt = self::getConnection()->prepare(
            "SELECT * FROM {$this->table} WHERE session_id = ? AND user_id IS NULL LIMIT 1"
        );
        $stmt->execute([$sessionId]);
        return $stmt->fetch();
    }
}
