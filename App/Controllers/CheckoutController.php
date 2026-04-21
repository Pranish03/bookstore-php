<?php

namespace App\Controllers;

use App\Middlewares\AuthMiddleware;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends BaseController
{
    private Cart $cart;
    private CartItem $cartItem;
    private Order $order;
    private OrderItem $orderItem;

    public function __construct()
    {
        $this->cart      = new Cart();
        $this->cartItem  = new CartItem();
        $this->order     = new Order();
        $this->orderItem = new OrderItem();
    }

    public function index()
    {
        (new AuthMiddleware())->handle();

        $cart  = $this->cart->getOrCreateForUser($_SESSION['user']['id']);
        $items = $this->cartItem->getByCart($cart['id']);

        if (empty($items)) {
            $_SESSION['error'] = 'Your cart is empty.';
            $this->redirect('/cart');
        }

        $total = $this->cartItem->getTotal($cart['id']);

        $this->view('page.checkout', compact('items', 'total'));
    }

    public function store()
    {
        (new AuthMiddleware())->handle();

        $userId = $_SESSION['user']['id'];
        $cart   = $this->cart->getOrCreateForUser($userId);
        $items  = $this->cartItem->getByCart($cart['id']);

        if (empty($items)) {
            $_SESSION['error'] = 'Your cart is empty.';
            $this->redirect('/cart');
        }

        $name    = trim($_POST['name'] ?? '');
        $phone   = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $note    = trim($_POST['note'] ?? '');

        $errors = [];
        if (empty($name))    $errors['name']    = 'Name is required.';
        if (empty($phone))   $errors['phone']   = 'Phone number is required.';
        if (empty($address)) $errors['address'] = 'Address is required.';

        if (! empty($errors)) {
            $_SESSION['errors']    = $errors;
            $_SESSION['old_input'] = $_POST;
            $this->redirect('/checkout');
        }

        $total = $this->cartItem->getTotal($cart['id']);

        $orderId = $this->order->create([
            'user_id' => $userId,
            'total'   => $total,
            'name'    => $name,
            'phone'   => $phone,
            'address' => $address,
            'note'    => $note ?: null,
        ]);

        foreach ($items as $item) {
            $this->orderItem->create([
                'order_id' => $orderId,
                'book_id'  => $item['book_id'],
                'quantity' => $item['quantity'],
                'price'    => $item['price'],
                'discount' => $item['discount'],
            ]);
        }

        $this->cartItem->clearCart($cart['id']);

        $_SESSION['success'] = 'Order placed successfully!';
        $this->redirect("/orders/{$orderId}");
    }

    public function show($id)
    {
        (new AuthMiddleware())->handle();

        $order = $this->order->getWithItems($id);

        if (! $order || $order['user_id'] !== $_SESSION['user']['id']) {
            $this->view('errors.404');
            return;
        }

        $this->view('page.order', compact('order'));
    }

    public function history()
    {
        (new AuthMiddleware())->handle();

        $orders = $this->order->getByUser($_SESSION['user']['id']);
        $this->view('page.orders', compact('orders'));
    }

    public function cancel($id)
    {
        (new AuthMiddleware())->handle();

        $order = $this->order->find($id);
        if (! $order || $order['user_id'] !== $_SESSION['user']['id']) {
            $this->view('errors.404');
            return;
        }

        if ($order['status'] !== 'pending') {
            $_SESSION['error'] = 'Only pending orders can be cancelled.';
            $this->redirect("/orders/{$id}");
        }

        $this->order->update($id, ['status' => 'cancelled']);

        $_SESSION['success'] = 'Order cancelled successfully.';
        $this->redirect("/orders/{$id}");
    }
}
