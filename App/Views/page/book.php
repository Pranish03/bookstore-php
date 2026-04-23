<?= start_layout(); ?>

<div class="bg-zinc-50 min-h-screen">
    <div class="max-w-300 mx-auto px-6 py-10 md:py-16">

        <div class="mb-8">
            <a href="/" class="text-sm text-zinc-500 hover:text-zinc-900 duration-200 ease-in-out flex items-center gap-1.5 w-min whitespace-nowrap">
                <i class="fa-solid fa-arrow-left-long text-xs"></i>
                Back to books
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-10 lg:gap-16">

            <div class="w-full lg:w-80 shrink-0">
                <div class="relative rounded-[10px] overflow-hidden border border-zinc-300 bg-white">
                    <img
                        src="/<?= htmlspecialchars($book['image']) ?>"
                        alt="<?= htmlspecialchars($book['title']) ?>"
                        class="w-full object-cover aspect-4/6">
                    <?php if ($book['discount'] > 0): ?>
                        <span class="absolute top-3 left-3 bg-zinc-900 text-white font-medium text-xs rounded-lg py-1 px-2">
                            -<?= (int) $book['discount'] ?>%
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex-1 flex flex-col gap-6">

                <div class="pb-6 border-b border-zinc-300">
                    <p class="text-sm uppercase font-medium text-zinc-500 mb-2"><?= htmlspecialchars($book['author']) ?></p>
                    <h1 class="text-3xl sm:text-4xl font-bold font-serif leading-tight mb-4"><?= htmlspecialchars($book['title']) ?></h1>

                    <?php if ($book['discount'] > 0):
                        $discounted = $book['price'] - ($book['price'] * $book['discount'] / 100);
                    ?>
                        <div class="flex items-center gap-3">
                            <span class="text-2xl font-semibold">Rs. <?= number_format($discounted, 2) ?></span>
                            <span class="text-base text-zinc-500 line-through">Rs. <?= number_format($book['price'], 2) ?></span>
                            <span class="px-2 py-0.5 bg-zinc-100 border border-zinc-300 text-zinc-600 text-xs font-medium rounded-lg">
                                Save <?= (int) $book['discount'] ?>%
                            </span>
                        </div>
                    <?php else: ?>
                        <span class="text-2xl font-semibold">Rs. <?= number_format($book['price'], 2) ?></span>
                    <?php endif; ?>
                </div>

                <form action="/cart/add" method="POST">
                    <input type="hidden" name="book_id" value="<?= (int) $book['id'] ?>">
                    <button type="submit" class="py-2.5 px-5 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-bag-shopping"></i>
                        Add to Cart
                    </button>
                </form>

                <div class="pb-6 border-b border-zinc-300">
                    <h2 class="text-sm font-semibold uppercase text-zinc-500 mb-3">About this book</h2>
                    <p class="text-base text-zinc-700 leading-relaxed"><?= htmlspecialchars($book['description']) ?></p>
                </div>

                <div>
                    <h2 class="text-sm font-semibold uppercase text-zinc-500 mb-4">Book Details</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="flex items-start gap-3 bg-white border border-zinc-300 rounded-[10px] px-4 py-3">
                            <i class="fa-solid fa-barcode text-zinc-400 mt-0.5"></i>
                            <div>
                                <p class="text-xs text-zinc-500 uppercase font-medium">ISBN</p>
                                <p class="text-sm text-zinc-900 font-medium"><?= htmlspecialchars($book['isbn']) ?></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 bg-white border border-zinc-300 rounded-[10px] px-4 py-3">
                            <i class="fa-regular fa-calendar text-zinc-400 mt-0.5"></i>
                            <div>
                                <p class="text-xs text-zinc-500 uppercase font-medium">Published</p>
                                <p class="text-sm text-zinc-900 font-medium"><?= htmlspecialchars($book['published_on']) ?></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 bg-white border border-zinc-300 rounded-[10px] px-4 py-3">
                            <i class="fa-solid fa-building-columns text-zinc-400 mt-0.5"></i>
                            <div>
                                <p class="text-xs text-zinc-500 uppercase font-medium">Publisher</p>
                                <p class="text-sm text-zinc-900 font-medium"><?= htmlspecialchars($book['published_by']) ?></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 bg-white border border-zinc-300 rounded-[10px] px-4 py-3">
                            <i class="fa-regular fa-file-lines text-zinc-400 mt-0.5"></i>
                            <div>
                                <p class="text-xs text-zinc-500 uppercase font-medium">Pages</p>
                                <p class="text-sm text-zinc-900 font-medium"><?= htmlspecialchars($book['pages']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?= end_layout('app'); ?>