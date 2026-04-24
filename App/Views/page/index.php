<?php start_layout(); ?>

<div class="bg-zinc-50">
    <section class="border-b border-zinc-300 bg-white">
        <div class="max-w-300 mx-auto space-y-6 py-10 md:py-16 px-6">
            <div class="px-2.5 py-1.25 border border-zinc-300 text-zinc-500 bg-zinc-100 rounded-[10px] mb-4 text-sm font-medium inline-flex items-center gap-2">
                <span class="inline-block h-2 w-2 rounded-full bg-green-600"></span>
                New arrivals every week
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-bold font-serif leading-20">
                Your next great<br>
                <span class="text-zinc-500">read awaits.</span>
            </h1>

            <p class="max-w-150 text-base text-zinc-600">Discover handpicked books across every genre. From timeless classics to contemporary fiction — curated for curious minds.</p>
            <div class="flex flex-wrap items-center gap-4">
                <a class="py-1.25 px-2.5 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out" href="/search?q=">Browse Collection</a>
                <a class="py-1.25 px-2.5 border text-base border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out" href="#books">
                    View all books
                    <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>
        </div>
    </section>

    <div class="max-w-300 mx-auto bg-white border-b border-zinc-300">
        <div class="grid grid-cols-3 sm:flex divide-y-0 divide-zinc-300 sm:divide-x py-0 sm:py-5">
            <div class="px-6 py-4 sm:py-0 shrink-0">
                <span class="font-serif block font-semibold text-2xl"><?= count($books) ?>+</span>
                <span class="text-sm text-zinc-600">Books in stock</span>
            </div>
            <div class="px-6 py-4 sm:py-0 shrink-0">
                <span class="font-serif block font-semibold text-2xl">100%</span>
                <span class="text-sm text-zinc-600">Authentic titles</span>
            </div>
            <div class="px-6 py-4 sm:py-0 shrink-0">
                <span class="font-serif block font-semibold text-2xl">Fast</span>
                <span class="text-sm text-zinc-600">Cash on delivery</span>
            </div>
        </div>
    </div>

    <section class="max-w-300 mx-auto py-10 md:py-16 px-6" id="books">
        <div class="mb-10">
            <h2 class="text-3xl font-semibold mb-3 font-serif">All Books</h2>
            <p class="text-base text-zinc-600">Browse our complete collection</p>
        </div>

        <?php if (empty($books)): ?>
            <div class="flex flex-col items-center justify-center py-20 gap-4 text-zinc-400">
                <i class="fa-solid fa-book text-5xl"></i>
                <p class="text-base">No books available yet. Check back soon.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                <?php foreach ($books as $book): ?>
                    <a href="/book/<?= $book['id'] ?>">
                        <?php component('BookCard', compact('book')); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</div>

<?php end_layout('app'); ?>