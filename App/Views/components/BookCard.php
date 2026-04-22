<article class="book-card">
    <div class="book-card-cover">
        <img
            src="/<?= htmlspecialchars($book['image']) ?>"
            alt="<?= htmlspecialchars($book['title']) ?>"
            loading="lazy">
        <?php if ($book['discount'] > 0): ?>
            <span class="book-card-badge">-<?= (int)$book['discount'] ?>%</span>
        <?php endif; ?>
    </div>

    <div class="book-card-body">
        <p class="book-card-author"><?= htmlspecialchars($book['author']) ?></p>
        <h3 class="book-card-title"><?= htmlspecialchars($book['title']) ?></h3>

        <div class="book-card-pricing">
            <?php if ($book['discount'] > 0):
                $discounted = $book['price'] - ($book['price'] * $book['discount'] / 100);
            ?>
                <span class="book-card-price">Rs. <?= number_format($discounted, 2) ?></span>
                <span class="book-card-original">Rs. <?= number_format($book['price'], 2) ?></span>
            <?php else: ?>
                <span class="book-card-price">Rs. <?= number_format($book['price'], 2) ?></span>
            <?php endif; ?>
        </div>
    </div>
</article>