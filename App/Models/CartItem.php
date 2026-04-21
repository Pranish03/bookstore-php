<?php

namespace App\Models;

class CartItem extends Model
{
    protected string $table = 'cart_items';

    public function getByCart(int $cartId): array
    {
        $stmt = self::getConnection()->prepare("
            SELECT cart_items.*, books.title, books.author,
                   books.image, books.price, books.discount
            FROM cart_items
            JOIN books ON cart_items.book_id = books.id
            WHERE cart_items.cart_id = ?
        ");
        $stmt->execute([$cartId]);
        return $stmt->fetchAll();
    }

    public function findItem(int $cartId, int $bookId): array|false
    {
        $stmt = self::getConnection()->prepare(
            "SELECT * FROM {$this->table} WHERE cart_id = ? AND book_id = ?"
        );
        $stmt->execute([$cartId, $bookId]);
        return $stmt->fetch();
    }

    public function addItem(int $cartId, int $bookId): bool
    {
        $existing = $this->findItem($cartId, $bookId);

        if ($existing) {
            return $this->updateQuantity($existing['id'], $existing['quantity'] + 1);
        }

        $stmt = self::getConnection()->prepare(
            "INSERT INTO {$this->table} (cart_id, book_id, quantity) VALUES (?, ?, 1)"
        );
        return $stmt->execute([$cartId, $bookId]);
    }

    public function updateQuantity(int $id, int $quantity): bool
    {
        $stmt = self::getConnection()->prepare(
            "UPDATE {$this->table} SET quantity = ? WHERE id = ?"
        );
        return $stmt->execute([$quantity, $id]);
    }

    public function removeItem(int $id, int $cartId): bool
    {
        $stmt = self::getConnection()->prepare(
            "DELETE FROM {$this->table} WHERE id = ? AND cart_id = ?"
        );
        return $stmt->execute([$id, $cartId]);
    }

    public function getTotal(int $cartId): float
    {
        $items = $this->getByCart($cartId);
        return array_reduce($items, function ($carry, $item) {
            $discounted = $item['price'] - ($item['price'] * $item['discount'] / 100);
            return $carry + ($discounted * $item['quantity']);
        }, 0.0);
    }

    public function getItemCount(int $cartId): int
    {
        $stmt = self::getConnection()->prepare(
            "SELECT SUM(quantity) FROM {$this->table} WHERE cart_id = ?"
        );
        $stmt->execute([$cartId]);
        return (int) $stmt->fetchColumn();
    }
}
