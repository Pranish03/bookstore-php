<?= start_layout(); ?>

<?php
$discounted = $book['price'] - ($book['price'] * $book['discount'] / 100);
?>

<div class="flex flex-col gap-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <a href="/admin/books" class="text-sm text-zinc-500 hover:text-zinc-900 duration-200 ease-in-out flex items-center gap-1.5 w-min whitespace-nowrap mb-4">
                <i class="fa-solid fa-arrow-left-long text-xs"></i>
                Back to books
            </a>
            <h1 class="text-2xl font-bold font-serif text-zinc-900"><?= htmlspecialchars($book['title']) ?></h1>
            <p class="text-sm text-zinc-500 mt-1"><?= htmlspecialchars($book['author']) ?></p>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <a href="/admin/books/<?= (int) $book['id'] ?>/edit"
                class="py-1.25 px-2.5 border text-sm border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out text-zinc-600 flex items-center gap-1">
                <i class="fa-solid fa-pen-nib"></i>
                Edit
            </a>
            <form method="POST" action="/admin/books/<?= $book['id'] ?>">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit"
                    onclick="return confirm('Are you sure you want to delete this book?')"
                    class="py-1.25 px-2.5 border text-sm border-red-200 bg-red-50 text-red-600 hover:bg-red-100 rounded-[10px] duration-200 ease-in-out flex items-center gap-1 cursor-pointer">
                    <i class="fa-solid fa-trash-can"></i>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="px-4 py-3 bg-zinc-100 border border-zinc-300 rounded-[10px] text-sm text-zinc-700 flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-green-600"></i>
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div class="flex flex-col lg:flex-row gap-6 items-start">

        <div class="w-full lg:w-64 shrink-0">
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

        <div class="flex-1 flex flex-col gap-4 w-full">
            <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-4">
                <h2 class="text-sm font-semibold uppercase text-zinc-500 pb-4 border-b border-zinc-200">Pricing</h2>
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex flex-col gap-1.5">
                        <p class="text-xs text-zinc-500 uppercase font-medium">Original Price</p>
                        <?php if ($book['discount'] > 0): ?>
                            <p class="text-base font-medium text-zinc-500 line-through">Rs. <?= number_format($book['price'], 2) ?></p>
                        <?php else: ?>
                            <p class="text-base font-medium text-zinc-900">Rs. <?= number_format($book['price'], 2) ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ($book['discount'] > 0): ?>
                        <div class="flex flex-col gap-1">
                            <p class="text-xs text-zinc-500 uppercase font-medium">Discount</p>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-medium bg-green-50 text-green-700 border-green-200 w-min whitespace-nowrap">
                                -<?= (int) $book['discount'] ?>% off
                            </span>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <p class="text-xs text-zinc-500 uppercase font-medium">Sale Price</p>
                            <p class="text-base font-bold text-zinc-900">Rs. <?= number_format($discounted, 2) ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-4">
                <h2 class="text-sm font-semibold uppercase text-zinc-500 pb-4 border-b border-zinc-200">Description</h2>
                <p class="text-sm text-zinc-700 leading-relaxed"><?= htmlspecialchars($book['description']) ?></p>
            </div>

            <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-4">
                <h2 class="text-sm font-semibold uppercase text-zinc-500 pb-4 border-b border-zinc-200">Book Details</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="flex items-start gap-2.5">
                        <i class="fa-solid fa-barcode text-zinc-400 mt-0.5 w-4 shrink-0 text-sm"></i>
                        <div>
                            <p class="text-xs text-zinc-500 uppercase font-medium">ISBN</p>
                            <p class="text-sm text-zinc-900 font-medium"><?= htmlspecialchars($book['isbn']) ?></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <i class="fa-regular fa-calendar text-zinc-400 mt-0.5 w-4 shrink-0 text-sm"></i>
                        <div>
                            <p class="text-xs text-zinc-500 uppercase font-medium">Published On</p>
                            <p class="text-sm text-zinc-900 font-medium"><?= htmlspecialchars($book['published_on']) ?></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <i class="fa-solid fa-building-columns text-zinc-400 mt-0.5 w-4 shrink-0 text-sm"></i>
                        <div>
                            <p class="text-xs text-zinc-500 uppercase font-medium">Publisher</p>
                            <p class="text-sm text-zinc-900 font-medium"><?= htmlspecialchars($book['published_by']) ?></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <i class="fa-regular fa-file-lines text-zinc-400 mt-0.5 w-4 shrink-0 text-sm"></i>
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

<?= end_layout('admin'); ?>