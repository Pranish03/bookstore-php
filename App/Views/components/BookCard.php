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

<style>
    .book-card {
        --radius: 8px;
        --border: #e4e4e7;
        --muted: #71717a;
        --foreground: #09090b;
        --card-bg: #ffffff;

        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.2s ease, transform 0.2s ease, border-color 0.2s ease;
        height: 100%;
    }

    .book-card-link:hover .book-card {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border-color: #d4d4d8;
        transform: translateY(-2px);
    }

    .book-card-cover {
        position: relative;
        aspect-ratio: 3 / 4;
        background: #f4f4f5;
        overflow: hidden;
    }

    .book-card-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }

    .book-card-link:hover .book-card-cover img {
        transform: scale(1.04);
    }

    .book-card-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.02em;
        background: #09090b;
        color: #fafafa;
        border-radius: 4px;
        padding: 3px 7px;
        pointer-events: none;
    }

    .book-card-body {
        padding: 14px 14px 16px;
        display: flex;
        flex-direction: column;
        gap: 4px;
        flex: 1;
        border-top: 1px solid var(--border);
    }

    .book-card-author {
        font-size: 11px;
        font-weight: 500;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .book-card-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--foreground);
        margin: 0;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        letter-spacing: -0.01em;
    }

    .book-card-pricing {
        display: flex;
        align-items: baseline;
        gap: 7px;
        margin-top: 6px;
    }

    .book-card-price {
        font-size: 14px;
        font-weight: 700;
        color: var(--foreground);
        letter-spacing: -0.01em;
    }

    .book-card-original {
        font-size: 12px;
        color: var(--muted);
        text-decoration: line-through;
    }
</style>