<?php
require __DIR__ . '/../../layout_helper.php';
start_layout();
?>

<div>
    <h1>Orders</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color:green"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div>
        <form action="/admin/orders" method="GET">
            <input type="text" name="q" placeholder="Search by customer name, email or status"
                value="<?= htmlspecialchars($query) ?>">
            <button type="submit">Search</button>
            <?php if ($query): ?>
                <a href="/admin/orders">Clear</a>
            <?php endif; ?>
        </form>
    </div>

    <?php if ($query): ?>
        <p><?= count($orders) ?> result(s) for "<?= htmlspecialchars($query) ?>"</p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($orders)): ?>
                <tr>
                    <td colspan="6">No orders found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?= $order['id'] ?></td>
                        <td>
                            <?= htmlspecialchars($order['customer_name']) ?><br>
                            <small><?= htmlspecialchars($order['customer_email']) ?></small>
                        </td>
                        <td>Rs. <?= number_format($order['total'], 2) ?></td>
                        <td><?= ucfirst($order['status']) ?></td>
                        <td><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                        <td><a href="/admin/orders/<?= $order['id'] ?>">View</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php end_layout('admin'); ?>