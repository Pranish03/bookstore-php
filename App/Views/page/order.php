<?php
require __DIR__ . '/../layout_helper.php';
start_layout();
?>

<div>
    <h1>Order Confirmed!</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color:green"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <p>Order #<?= $order['id'] ?> — Status: <strong><?= ucfirst($order['status']) ?></strong></p>
    <?php if ($order['status'] === 'pending'): ?>
        <form action="/orders/<?= $order['id'] ?>/cancel" method="POST"
            onsubmit="return confirm('Are you sure you want to cancel this order?')">
            <button type="submit">Cancel Order</button>
        </form>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <p style="color:red"><?= htmlspecialchars($_SESSION['error']) ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <p>Delivering to: <?= htmlspecialchars($order['address']) ?></p>

    <table>
        <thead>
            <tr>
                <th>Book</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order['items'] as $item):
                $discounted = $item['price'] - ($item['price'] * $item['discount'] / 100);
            ?>
                <tr>
                    <td><?= htmlspecialchars($item['title']) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>Rs. <?= number_format($discounted, 2) ?></td>
                    <td>Rs. <?= number_format($discounted * $item['quantity'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>Rs. <?= number_format($order['total'], 2) ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <a href="/orders">View all orders</a>
</div>

<?php end_layout('app'); ?>