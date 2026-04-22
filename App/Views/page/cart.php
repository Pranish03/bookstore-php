<?= start_layout(); ?>

<div>
    <h1>Your Cart</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color:green"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (empty($items)): ?>
        <p>Your cart is empty. <a href="/">Browse books</a></p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item):
                    $discounted = $item['price'] - ($item['price'] * $item['discount'] / 100);
                    $subtotal   = $discounted * $item['quantity'];
                ?>
                    <tr>
                        <td>
                            <img src="/<?= htmlspecialchars($item['image']) ?>" width="50">
                            <?= htmlspecialchars($item['title']) ?>
                        </td>
                        <td>Rs. <?= number_format($discounted, 2) ?></td>
                        <td>
                            <form action="/cart/update" method="POST">
                                <input type="hidden" name="cart_item_id" value="<?= $item['id'] ?>">
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" style="width:60px">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>Rs. <?= number_format($subtotal, 2) ?></td>
                        <td>
                            <form action="/cart/remove" method="POST">
                                <input type="hidden" name="cart_item_id" value="<?= $item['id'] ?>">
                                <button type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td colspan="2"><strong>Rs. <?= number_format($total, 2) ?></strong></td>
                </tr>
            </tfoot>
        </table>

        <a href="/checkout">Proceed to Checkout</a>
    <?php endif; ?>
</div>

<?= end_layout('app'); ?>