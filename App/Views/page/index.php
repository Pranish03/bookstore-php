<?php start_layout(); ?>

<div>
    <section class="border-b border-zinc-300">
        <div class="max-w-300 mx-auto space-y-6 py-16 px-6">
            <div class="px-2.5 py-1.25 border border-zinc-300 text-zinc-500 bg-zinc-100 rounded-[10px] mb-4 text-sm font-medium inline-flex items-center gap-2">
                <span class="inline-block h-2 w-2 rounded-full bg-green-600"></span>
                New arrivals every week
            </div>
            <h1 class="text-7xl font-bold font-serif">
                Your next great<br>
                <span class="text-zinc-500">read awaits.</span>
            </h1>

            <p class="max-w-150 text-base">Discover handpicked books across every genre. From timeless classics to contemporary fiction — curated for curious minds.</p>
            <div class="flex items-center gap-6">
                <a class="py-1.25 px-2.5 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out" href="/search?q=">Browse Collection</a>
                <a class="py-1.25 px-2.5 border text-base border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out" href="#books">
                    View all books
                    <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>
        </div>
    </section>

    <div>
        <div>
            <span><?= count($books) ?>+</span>
            <span>Books in stock</span>
        </div>
        <div></div>
        <div>
            <span>100%</span>
            <span>Authentic titles</span>
        </div>
        <div></div>
        <div>
            <span>Fast</span>
            <span>Cash on delivery</span>
        </div>
    </div>

    <section id="books">X
        <div>
            <div>
                <h2>All Books</h2>
                <p>Browse our complete collection</p>
            </div>
            <form action="/search" method="get">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="q" placeholder="Search titles, authors, ISBN…" required />
            </form>
        </div>

        <?php if (empty($books)): ?>
            <div>
                <i class="fa-solid fa-book"></i>
                <p>No books available yet. Check back soon.</p>
            </div>
        <?php else: ?>
            <div>
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