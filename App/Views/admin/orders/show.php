<?php
require __DIR__ . '/../../layout_helper.php';
start_layout();
?>

<div>
    <a href="/admin/orders">← Back to orders</a>

    <h1>Order #<?= $order['id'] ?></h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color:green"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <p style="color:red"><?= htmlspecialchars($_SESSION['error']) ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div>
        <h2>Customer</h2>
        <p><?= htmlspecialchars($order['customer_name']) ?></p>
        <p><?= htmlspecialchars($order['customer_email']) ?></p>

        <h2>Delivery Details</h2>
        <p><?= htmlspecialchars($order['name']) ?></p>
        <p><?= htmlspecialchars($order['phone']) ?></p>
        <p><?= htmlspecialchars($order['address']) ?></p>
        <?php if ($order['note']): ?>
            <p>Note: <?= htmlspecialchars($order['note']) ?></p>
        <?php endif; ?>
    </div>

    <h2>Items</h2>
    <table>
        <thead>
            <tr>
                <th>Book</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order['items'] as $item):
                $discounted = $item['price'] - ($item['price'] * $item['discount'] / 100);
            ?>
                <tr>
                    <td>
                        <img src="/<?= htmlspecialchars($item['image']) ?>" width="40">
                        <?= htmlspecialchars($item['title']) ?>
                    </td>
                    <td>Rs. <?= number_format($discounted, 2) ?></td>
                    <td><?= $item['quantity'] ?></td>
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

    <h2>Update Status</h2>
    <form action="/admin/orders/<?= $order['id'] ?>/status" method="POST">
        <select name="status">
            <?php foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status): ?>
                <option value="<?= $status ?>" <?= $order['status'] === $status ? 'selected' : '' ?>>
                    <?= ucfirst($status) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Update Status</button>
    </form>
</div>

<?php end_layout('admin'); ?>