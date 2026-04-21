<?php
require __DIR__ . '/../layout_helper.php';
start_layout();
?>

<div>
    <h1>My Orders</h1>

    <?php if (empty($orders)): ?>
        <p>You have no orders yet. <a href="/">Browse books</a></p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?= $order['id'] ?></td>
                        <td>Rs. <?= number_format($order['total'], 2) ?></td>
                        <td><?= ucfirst($order['status']) ?></td>
                        <td><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                        <td><a href="/orders/<?= $order['id'] ?>">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php end_layout('app'); ?>