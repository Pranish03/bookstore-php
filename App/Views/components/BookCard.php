<article>
    <div>
        <img
            src="/<?= htmlspecialchars($book['image']) ?>"
            alt="<?= htmlspecialchars($book['title']) ?>"
            loading="lazy">
        <?php if ($book['discount'] > 0): ?>
            <span>-<?= (int)$book['discount'] ?>%</span>
        <?php endif; ?>
        </div=>

        <div>
            <p><?= htmlspecialchars($book['author']) ?></p>
            <h3><?= htmlspecialchars($book['title']) ?></h3>

            <div
                <?php if ($book['discount'] > 0):
                    $discounted = $book['price'] - ($book['price'] * $book['discount'] / 100);
                ?>
                <span>Rs. <?= number_format($discounted, 2) ?></span>
                <span>Rs. <?= number_format($book['price'], 2) ?></span>
            <?php else: ?>
                <span>Rs. <?= number_format($book['price'], 2) ?></span>
            <?php endif; ?>
            </div>
        </div>
</article>