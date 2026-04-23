<?= start_layout(); ?>

<div class="flex flex-col gap-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold font-serif text-zinc-900">Books</h1>
            <p class="text-sm text-zinc-500 mt-1">Manage your book catalogue</p>
        </div>
    </div>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="px-4 py-3 bg-zinc-100 border border-zinc-300 rounded-[10px] text-sm text-zinc-700 flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-green-600"></i>
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3 w-full">
            <form action="/admin/books" method="GET" class="flex items-center gap-2 flex-1 max-w-xs">
                <div class="relative flex-1">
                    <span class="absolute left-2.5 top-1/2 -translate-y-1/2 text-zinc-400 text-sm">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input
                        type="text"
                        name="q"
                        placeholder="Search by title, author or ISBN"
                        value="<?= htmlspecialchars($query) ?>"
                        class="w-full py-1.25 pl-8 pr-2.5 border bg-white border-zinc-300 rounded-[10px] text-sm outline-none focus:border-zinc-900 focus:ring-3 focus:ring-zinc-300 duration-200">
                </div>
                <button type="submit" hidden></button>
            </form>
            <?php if ($query): ?>
                <a href="/admin/books" class="py-1.25 px-2.5 border text-sm border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out text-zinc-600 flex items-center gap-1 shrink-0">
                    <i class="fa-solid fa-xmark"></i>
                    Clear
                </a>
            <?php endif; ?>
        </div>

        <a href="/admin/books/create" class="py-1.25 px-2.5 border text-sm border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out flex items-center gap-1 cursor-pointer shrink-0 w-min whitespace-nowrap float-right">
            <i class="fa-solid fa-circle-plus"></i>
            Add New Book
        </a>
    </div>

    <?php if ($query): ?>
        <p class="text-sm text-zinc-500 -mt-3">
            <?= count($books) ?> result<?= count($books) !== 1 ? 's' : '' ?> for "<span class="text-zinc-700 font-medium"><?= htmlspecialchars($query) ?></span>"
        </p>
    <?php endif; ?>

    <div class="bg-white border border-zinc-300 rounded-[10px] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-200">
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">SN</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Title</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Author</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Original Price</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Discount Price</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($books)): ?>
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-sm text-zinc-400">
                                <i class="fa-solid fa-book text-3xl mb-3 block"></i>
                                <p>No books found.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($books as $index => $book):
                            $discounted = $book['price'] - ($book['price'] * $book['discount'] / 100);
                        ?>
                            <tr class="border-b border-zinc-100 last:border-b-0 hover:bg-zinc-50 duration-200">
                                <td class="px-5 py-3.5 text-zinc-500"><?= ++$index ?></td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <img src="/<?= htmlspecialchars($book['image']) ?>"
                                            alt="<?= htmlspecialchars($book['title']) ?>"
                                            class="w-8.25 h-10.25 object-cover rounded-[10px] shrink-0">
                                        <a href="/admin/books/<?= $book['id'] ?>" class="font-medium text-zinc-900 hover:underline">
                                            <?= htmlspecialchars($book['title']) ?>
                                        </a>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-zinc-500"><?= htmlspecialchars($book['author']) ?></td>
                                <td class="px-5 py-3.5 text-zinc-500 whitespace-nowrap">
                                    <?php if ($book['discount'] > 0): ?>
                                        <span class="line-through">Rs. <?= number_format($book['price'], 2) ?></span>
                                    <?php else: ?>
                                        Rs. <?= number_format($book['price'], 2) ?>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-3.5 font-medium text-zinc-900 whitespace-nowrap">
                                    Rs. <?= number_format($discounted, 2) ?>
                                    <?php if ($book['discount'] > 0): ?>
                                        <span class="ml-1 text-xs text-green-600 font-medium">-<?= (int)$book['discount'] ?>%</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-2">
                                        <a href="/admin/books/<?= $book['id'] ?>" class="py-1.25 px-2.5 border text-sm border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out text-zinc-600 whitespace-nowrap">
                                            <i class="fa-solid fa-eye"></i>
                                            View
                                        </a>
                                        <a href="/admin/books/<?= $book['id'] ?>/edit" class="py-1.25 px-2.5 border text-sm border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out text-zinc-600 flex items-center gap-1 whitespace-nowrap">
                                            <i class="fa-solid fa-pen-nib"></i>
                                            Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= end_layout('admin'); ?>