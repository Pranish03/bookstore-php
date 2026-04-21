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
        $stmt = self::getConnection()->prepare("
        SELECT orders.*, users.name AS customer_name, users.email AS customer_email
        FROM orders
        JOIN users ON orders.user_id = users.id
        WHERE orders.id = ?
    ");
        $stmt->execute([$orderId]);
        $order = $stmt->fetch();

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

    public function allWithUsers(): array
    {
        $stmt = self::getConnection()->query("
        SELECT orders.*, users.name AS customer_name, users.email AS customer_email
        FROM orders
        JOIN users ON orders.user_id = users.id
        ORDER BY orders.created_at DESC
    ");
        return $stmt->fetchAll();
    }

    public function search(string $query): array
    {
        $like = '%' . $query . '%';

        $stmt = self::getConnection()->prepare("
        SELECT orders.*, users.name AS customer_name, users.email AS customer_email
        FROM orders
        JOIN users ON orders.user_id = users.id
        WHERE users.name LIKE ?
           OR users.email LIKE ?
           OR orders.status LIKE ?
           OR orders.id LIKE ?
        ORDER BY orders.created_at DESC
    ");
        $stmt->execute([$like, $like, $like, $like]);
        return $stmt->fetchAll();
    }

    public function getTotalRevenue(): float
    {
        $stmt = self::getConnection()->query(
            "SELECT SUM(total) FROM {$this->table} WHERE status = 'delivered'"
        );
        return (float) $stmt->fetchColumn();
    }

    public function getRecent(int $limit = 5): array
    {
        $stmt = self::getConnection()->prepare("
        SELECT orders.*, users.name AS customer_name
        FROM orders
        JOIN users ON orders.user_id = users.id
        ORDER BY orders.created_at DESC
        LIMIT ?
    ");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }

    public function getCountByStatus(): array
    {
        $stmt = self::getConnection()->query("
        SELECT status, COUNT(*) as count
        FROM {$this->table}
        GROUP BY status
    ");
        return $stmt->fetchAll();
    }
}
