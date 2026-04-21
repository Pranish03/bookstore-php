<?php

namespace App\Models;

class Order extends Model
{
    protected string $table = 'orders';

    public function getByUser(int $userId): array
    {
        $stmt = self::getConnection()->prepare(
            "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY created_at DESC"
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getWithItems(int $orderId): array|false
    {
        $order = $this->find($orderId);
        if (! $order) return false;

        $stmt = self::getConnection()->prepare("
            SELECT order_items.*, books.title, books.image, books.author
            FROM order_items
            JOIN books ON order_items.book_id = books.id
            WHERE order_items.order_id = ?
        ");
        $stmt->execute([$orderId]);
        $order['items'] = $stmt->fetchAll();

        return $order;
    }
}
