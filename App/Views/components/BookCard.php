<article>
    <img src="<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>">
    <h2><?= htmlspecialchars($book['title']) ?></h2>

    <?php if ($book['discount'] > 0): ?>
        <del>
            <p>Rs. <?= number_format($book['price'], 2) ?></p>
        </del>
        <p>Rs. <?= number_format($book['price'] - ($book['price'] * $book['discount'] / 100), 2) ?></p>
    <?php else: ?>
        <p>Rs. <?= number_format($book['price'], 2) ?></p>
    <?php endif; ?>

</article>