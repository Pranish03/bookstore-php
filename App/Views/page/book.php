<?= start_layout(); ?>

<div>
    <img src="/<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>">

    <h2><?= htmlspecialchars($book['title']) ?></h2>

    <?php if ($book['discount'] > 0): ?>
        <del>
            <p>Rs. <?= number_format($book['price'], 2) ?></p>
        </del>
        <p>Rs. <?= number_format($book['price'] - ($book['price'] * $book['discount'] / 100), 2) ?></p>
    <?php else: ?>
        <p>Rs. <?= number_format($book['price'], 2) ?></p>
    <?php endif; ?>

    <p><?= htmlspecialchars($book['author']) ?></p>

    <form action="/cart/add" method="POST">
        <input type="hidden" name="book_id" value="<?= (int) $book['id'] ?>">
        <button type="submit">Add to Cart</button>
    </form>

    <p><?= htmlspecialchars($book['description']) ?></p>

    <div>
        <p><?= htmlspecialchars($book['isbn']) ?></p>
        <p><?= htmlspecialchars($book['published_on']) ?></p>
        <p><?= htmlspecialchars($book['published_by']) ?></p>
        <p><?= htmlspecialchars($book['pages']) ?></p>
    </div>
</div>

<?= end_layout('app'); ?>