<?php

use App\Models\Cart;
use App\Models\CartItem;

function asset(string $path): string
{
    return '/' . ltrim($path, '/');
}

function component(string $name, array $data = []): void
{
    extract($data);
    $path = __DIR__ . '/../Views/components/' . $name . '.php';
    if (!file_exists($path)) {
        throw new \Exception("Component {$name} not found at: {$path}");
    }
    require $path;
}

function cartCount(): int
{
    $cartCount = 0;

    if (isset($_SESSION['user'])) {
        $cart      = (new Cart())->getOrCreateForUser($_SESSION['user']['id']);
        $cartCount = (new CartItem())->getItemCount($cart['id']);
    }
    return $cartCount;
}

function start_layout(): void
{
    ob_start();
}

function end_layout(string $layout, array $data = []): void
{
    $content = ob_get_clean();
    extract($data);

    $layoutPath = __DIR__ . '/../Views/layout/' . $layout . '.php';

    if (!file_exists($layoutPath)) {
        throw new \Exception("Layout {$layout} not found at: {$layoutPath}");
    }

    require $layoutPath;
}
