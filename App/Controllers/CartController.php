<?php

namespace App\Controllers;

use App\Middlewares\AuthMiddleware;
use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends BaseController
{
    private Cart $cart;
    private CartItem $cartItem;
    private Book $book;

    public function __construct()
    {
        $this->cart     = new Cart();
        $this->cartItem = new CartItem();
        $this->book     = new Book();
    }

    private function resolveCart(): array
    {
        (new AuthMiddleware())->handle();

        if (isset($_SESSION['user'])) {
            return $this->cart->getOrCreateForUser($_SESSION['user']['id']);
        }

        return $this->cart->getOrCreateForSession(session_id());
    }

    public function index()
    {
        (new AuthMiddleware())->handle();

        $cart  = $this->resolveCart();
        $items = $this->cartItem->getByCart($cart['id']);
        $total = $this->cartItem->getTotal($cart['id']);

        $this->view('page.cart', compact('items', 'total'));
    }

    public function add()
    {
        (new AuthMiddleware())->handle();

        $bookId = (int) ($_POST['book_id'] ?? 0);
        $book   = $this->book->find($bookId);

        if (! $book) {
            $_SESSION['error'] = 'Book not found.';
            $this->redirect('/');
        }

        $cart = $this->resolveCart();
        $this->cartItem->addItem($cart['id'], $bookId);

        $_SESSION['success'] = "'{$book['title']}' added to cart.";
        $this->redirect('/cart');
    }

    public function update()
    {
        (new AuthMiddleware())->handle();

        $cart     = $this->resolveCart();
        $id       = (int) ($_POST['cart_item_id'] ?? 0);
        $quantity = (int) ($_POST['quantity'] ?? 1);

        if ($quantity < 1) {
            $this->cartItem->removeItem($id, $cart['id']);
        } else {
            $this->cartItem->updateQuantity($id, $quantity);
        }

        $this->redirect('/cart');
    }

    public function remove()
    {
        (new AuthMiddleware())->handle();

        $cart = $this->resolveCart();
        $id   = (int) ($_POST['cart_item_id'] ?? 0);

        $this->cartItem->removeItem($id, $cart['id']);

        $_SESSION['success'] = 'Item removed from cart.';
        $this->redirect('/cart');
    }
}
