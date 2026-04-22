<?= start_layout(); ?>

<?php
$errors   = $_SESSION['errors']    ?? [];
$old      = $_SESSION['old_input'] ?? [];
unset($_SESSION['errors'], $_SESSION['old_input']);
?>

<div>
    <h1>Checkout</h1>

    <h2>Order Summary</h2>
    <table>
        <thead>
            <tr>
                <th>Book</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item):
                $discounted = $item['price'] - ($item['price'] * $item['discount'] / 100);
            ?>
                <tr>
                    <td><?= htmlspecialchars($item['title']) ?></td>
                    <td>Rs. <?= number_format($discounted, 2) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>Rs. <?= number_format($discounted * $item['quantity'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>Rs. <?= number_format($total, 2) ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <h2>Delivery Details</h2>
    <form action="/checkout" method="POST">
        <div>
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name"
                value="<?= htmlspecialchars($old['name'] ?? $_SESSION['user']['name']) ?>">
            <?php if (!empty($errors['name'])): ?>
                <span style="color:red"><?= htmlspecialchars($errors['name']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone"
                value="<?= htmlspecialchars($old['phone'] ?? '') ?>">
            <?php if (!empty($errors['phone'])): ?>
                <span style="color:red"><?= htmlspecialchars($errors['phone']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="address">Delivery Address:</label>
            <textarea id="address" name="address"><?= htmlspecialchars($old['address'] ?? '') ?></textarea>
            <?php if (!empty($errors['address'])): ?>
                <span style="color:red"><?= htmlspecialchars($errors['address']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="note">Note (optional):</label>
            <textarea id="note" name="note"><?= htmlspecialchars($old['note'] ?? '') ?></textarea>
        </div>

        <button type="submit">Place Order (Cash on Delivery)</button>
    </form>
</div>

<?= end_layout('app'); ?>