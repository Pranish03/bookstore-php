<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Middlewares\AdminMiddleware;
use App\Models\Order;

class OrdersController extends BaseController
{
    private Order $order;

    private const VALID_STATUSES = [
        'pending',
        'processing',
        'shipped',
        'delivered',
        'cancelled'
    ];

    public function __construct()
    {
        $this->order = new Order();
    }

    public function index()
    {
        (new AdminMiddleware())->handle();

        $query  = trim($_GET['q'] ?? '');
        $orders = $query ? $this->order->search($query) : $this->order->allWithUsers();

        $this->view('admin.orders.index', compact('orders', 'query'));
    }

    public function show($id)
    {
        (new AdminMiddleware())->handle();

        $order = $this->order->getWithItems($id);

        if (! $order) {
            $_SESSION['error'] = 'Order not found.';
            $this->redirect('/admin/orders');
        }

        $this->view('admin.orders.show', compact('order'));
    }

    public function updateStatus($id)
    {
        (new AdminMiddleware())->handle();

        $order = $this->order->find($id);

        if (! $order) {
            $_SESSION['error'] = 'Order not found.';
            $this->redirect('/admin/orders');
        }

        $status = $_POST['status'] ?? '';

        if (! in_array($status, self::VALID_STATUSES)) {
            $_SESSION['error'] = 'Invalid status.';
            $this->redirect("/admin/orders/{$id}");
        }

        $this->order->update($id, ['status' => $status]);

        $_SESSION['success'] = 'Order status updated.';
        $this->redirect("/admin/orders/{$id}");
    }
}
