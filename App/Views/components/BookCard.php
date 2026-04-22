<article class="border border-zinc-300 rounded-[10px] overflow-hidden hover:shadow-lg transition-shadow">
    <div class="relative">
        <img
            class="w-full h-70 object-cover"
            src="/<?= htmlspecialchars($book['image']) ?>"
            alt="<?= htmlspecialchars($book['title']) ?>"
            loading="lazy">
        <?php if ($book['discount'] > 0): ?>
            <span class="absolute top-2 left-2 bg-zinc-900 text-white font-medium text-xs rounded-lg py-1 px-2">
                -<?= (int)$book['discount'] ?>%
            </span>
        <?php endif; ?>
    </div>

    <div class="bg-white p-3">
        <p class="text-sm uppercase font-medium text-zinc-500 mb-1"><?= htmlspecialchars($book['author']) ?></p>
        <h3 class="font-semibold text-base mb-1"><?= htmlspecialchars($book['title']) ?></h3>

        <div class="flex items-center gap-2">
            <?php if ($book['discount'] > 0): ?>
                <?php
                $discounted = $book['price'] - ($book['price'] * $book['discount'] / 100);
                ?>

                <span class="font-medium">Rs. <?= number_format($discounted, 2) ?></span>
                <span class="text-sm text-zinc-600 line-through">Rs. <?= number_format($book['price'], 2) ?></span>
            <?php else: ?>
                <span class="font-medium">Rs. <?= number_format($book['price'], 2) ?></span>
            <?php endif; ?>
        </div>
    </div>
</article>