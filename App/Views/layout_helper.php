<?php

use App\Models\Cart;
use App\Models\CartItem;

function start_layout()
{
    ob_start();
}

function end_layout($layout, $data = [])
{
    $content = ob_get_clean();
    extract($data);

    $cartCount = 0;
    if (isset($_SESSION['user'])) {
        $cart = (new Cart())->getOrCreateForUser($_SESSION['user']['id']);
        $cartCount = (new CartItem())->getItemCount($cart['id']);
    }

    $layoutPath = __DIR__ . '/layout/' . $layout . '.php';
    require $layoutPath;
}
