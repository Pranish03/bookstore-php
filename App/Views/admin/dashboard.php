<?php
require __DIR__ . '/../layout_helper.php';
start_layout();
?>

<h1>Dashboard</h1>

<section>
    <h2>Summary</h2>
    <ul>
        <li>Total Books: <?= $totalBooks ?></li>
        <li>Total Users: <?= $totalUsers ?></li>
        <li>Total Orders: <?= $totalOrders ?></li>
        <li>Total Revenue: Rs. <?= number_format($totalRevenue, 2) ?></li>
    </ul>
</section>

<section>
    <h2>Orders by Status</h2>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ordersByStatus as $row): ?>
                <tr>
                    <td><?= ucfirst($row['status']) ?></td>
                    <td><?= $row['count'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<section>
    <h2>Recent Orders</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($recentOrders)): ?>
                <tr>
                    <td colspan="6">No orders yet.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($recentOrders as $order): ?>
                    <tr>
                        <td>#<?= $order['id'] ?></td>
                        <td><?= htmlspecialchars($order['customer_name']) ?></td>
                        <td>Rs. <?= number_format($order['total'], 2) ?></td>
                        <td><?= ucfirst($order['status']) ?></td>
                        <td><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                        <td><a href="/admin/orders/<?= $order['id'] ?>">View</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<section>
    <h2>Recent Users</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Joined</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($recentUsers)): ?>
                <tr>
                    <td colspan="5">No users yet.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($recentUsers as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                        <td><a href="/admin/users/<?= $user['id'] ?>">View</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php end_layout('admin'); ?>