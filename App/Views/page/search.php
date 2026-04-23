<?= start_layout(); ?>

<div class="bg-zinc-50 min-h-screen">
    <div class="max-w-300 mx-auto px-6 py-10 md:py-16">

        <div class="mb-8">
            <a href="/" class="text-sm text-zinc-500 hover:text-zinc-900 duration-200 ease-in-out flex items-center gap-1.5 w-min whitespace-nowrap">
                <i class="fa-solid fa-arrow-left-long text-xs"></i>
                Back to books
            </a>
        </div>

        <div class="mb-8">
            <h1 class="text-3xl font-bold font-serif mb-1">Search Results</h1>
            <p class="text-sm text-zinc-500">
                <?php if (empty($books)): ?>
                    No results for "<span class="text-zinc-700 font-medium"><?= htmlspecialchars($query) ?></span>"
                <?php else: ?>
                    <?= count($books) ?> result<?= count($books) !== 1 ? 's' : '' ?> for "<span class="text-zinc-700 font-medium"><?= htmlspecialchars($query) ?></span>"
                <?php endif; ?>
            </p>
        </div>

        <?php if (empty($books)): ?>
            <div class="bg-white border border-zinc-300 rounded-[10px] flex flex-col items-center justify-center py-24 gap-4 text-zinc-400">
                <i class="fa-solid fa-magnifying-glass text-5xl"></i>
                <p class="text-base text-zinc-500">No books found matching "<?= htmlspecialchars($query) ?>"</p>
                <a href="/" class="py-1.25 px-2.5 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out">
                    Browse All Books
                </a>
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

    </div>
</div>

<?= end_layout('app'); ?>