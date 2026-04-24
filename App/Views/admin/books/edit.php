<?= start_layout(); ?>

<?php
$errors = $_SESSION['errors']    ?? [];
$old    = $_SESSION['old_input'] ?? [];

unset($_SESSION['errors'], $_SESSION['old_input']);
?>

<div class="flex flex-col gap-6">
    <div>
        <a href="/admin/books" class="text-sm text-zinc-500 hover:text-zinc-900 duration-200 ease-in-out flex items-center gap-1.5 w-min whitespace-nowrap mb-4">
            <i class="fa-solid fa-arrow-left-long text-xs"></i>
            Back to books
        </a>
        <h1 class="text-2xl font-bold font-serif text-zinc-900">Edit Book</h1>
        <p class="text-sm text-zinc-500 mt-1">Update the details of this book</p>
    </div>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="px-4 py-3 bg-zinc-100 border border-zinc-300 rounded-[10px] text-sm text-zinc-700 flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-green-600"></i>
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form action="/admin/books/<?= (int) $book['id'] ?>" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
        <input type="hidden" name="_method" value="PUT">
        <div class="flex flex-col lg:flex-row gap-4 items-start">
            <div class="flex-1 w-full flex flex-col gap-4">
                <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-5">
                    <h2 class="text-sm font-semibold uppercase text-zinc-500 pb-4 border-b border-zinc-200">Basic Information</h2>

                    <div class="flex flex-col gap-1.5">
                        <label for="title" class="text-sm font-medium text-zinc-700">Title</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="<?= htmlspecialchars($old['title'] ?? $book['title']) ?>"
                            placeholder="Enter book title"
                            class="py-1.25 px-2.5 border <?= !empty($errors['title']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-sm outline-none focus:ring-3 duration-200">
                        <?php if (!empty($errors['title'])): ?>
                            <span class="text-sm text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                <?= htmlspecialchars($errors['title']) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="author" class="text-sm font-medium text-zinc-700">Author</label>
                        <input
                            type="text"
                            id="author"
                            name="author"
                            value="<?= htmlspecialchars($old['author'] ?? $book['author']) ?>"
                            placeholder="Enter author name"
                            class="py-1.25 px-2.5 border <?= !empty($errors['author']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-sm outline-none focus:ring-3 duration-200">
                        <?php if (!empty($errors['author'])): ?>
                            <span class="text-sm text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                <?= htmlspecialchars($errors['author']) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="description" class="text-sm font-medium text-zinc-700">Description</label>
                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            placeholder="Enter book description"
                            class="py-1.25 px-2.5 border <?= !empty($errors['description']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-sm outline-none focus:ring-3 duration-200 resize-none"><?= htmlspecialchars($old['description'] ?? $book['description']) ?></textarea>
                        <?php if (!empty($errors['description'])): ?>
                            <span class="text-sm text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                <?= htmlspecialchars($errors['description']) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-5">
                    <h2 class="text-sm font-semibold uppercase text-zinc-500 pb-4 border-b border-zinc-200">Publication Details</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1.5">
                            <label for="isbn" class="text-sm font-medium text-zinc-700">ISBN</label>
                            <input
                                type="text"
                                id="isbn"
                                name="isbn"
                                value="<?= htmlspecialchars($old['isbn'] ?? $book['isbn']) ?>"
                                placeholder="e.g. 978-3-16-148410-0"
                                class="py-1.25 px-2.5 border <?= !empty($errors['isbn']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-sm outline-none focus:ring-3 duration-200">
                            <?php if (!empty($errors['isbn'])): ?>
                                <span class="text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                    <?= htmlspecialchars($errors['isbn']) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="pages" class="text-sm font-medium text-zinc-700">Pages</label>
                            <input
                                type="number"
                                id="pages"
                                name="pages"
                                value="<?= htmlspecialchars($old['pages'] ?? $book['pages']) ?>"
                                placeholder="e.g. 320"
                                min="1"
                                class="py-1.25 px-2.5 border <?= !empty($errors['pages']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-sm outline-none focus:ring-3 duration-200">
                            <?php if (!empty($errors['pages'])): ?>
                                <span class="text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                    <?= htmlspecialchars($errors['pages']) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="published_on" class="text-sm font-medium text-zinc-700">Published On</label>
                            <input
                                type="date"
                                id="published_on"
                                name="published_on"
                                value="<?= htmlspecialchars($old['published_on'] ?? $book['published_on']) ?>"
                                class="py-1.25 px-2.5 border <?= !empty($errors['published_on']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-sm outline-none focus:ring-3 duration-200">
                            <?php if (!empty($errors['published_on'])): ?>
                                <span class="text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                    <?= htmlspecialchars($errors['published_on']) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="published_by" class="text-sm font-medium text-zinc-700">Publisher</label>
                            <input
                                type="text"
                                id="published_by"
                                name="published_by"
                                value="<?= htmlspecialchars($old['published_by'] ?? $book['published_by']) ?>"
                                placeholder="e.g. Penguin Books"
                                class="py-1.25 px-2.5 border <?= !empty($errors['published_by']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-sm outline-none focus:ring-3 duration-200">
                            <?php if (!empty($errors['published_by'])): ?>
                                <span class="text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                    <?= htmlspecialchars($errors['published_by']) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="w-full lg:w-72 shrink-0 flex flex-col gap-4">
                <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-5">
                    <h2 class="text-sm font-semibold uppercase text-zinc-500 pb-4 border-b border-zinc-200">Cover Image</h2>
                    <div class="flex flex-col gap-1.5">
                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                            class="py-1.25 px-2.5 border <?= !empty($errors['image']) ? 'border-red-400' : 'border-zinc-300' ?> rounded-[10px] text-sm text-zinc-700 outline-none duration-200 file:mr-3 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 file:cursor-pointer w-full">
                        <?php if (!empty($errors['image'])): ?>
                            <span class="text-sm text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                <?= htmlspecialchars($errors['image']) ?>
                            </span>
                        <?php endif; ?>
                        <p class="text-xs text-zinc-500">Leave blank to keep current image</p>
                    </div>
                </div>

                <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-5">
                    <h2 class="text-sm font-semibold uppercase text-zinc-500 pb-4 border-b border-zinc-200">Pricing</h2>

                    <div class="flex flex-col gap-1.5">
                        <label for="price" class="text-sm font-medium text-zinc-700">Price <span class="text-zinc-400 font-normal">(Rs.)</span></label>
                        <input
                            type="number"
                            id="price"
                            name="price"
                            step="0.01"
                            min="0"
                            value="<?= htmlspecialchars($old['price'] ?? $book['price']) ?>"
                            placeholder="0.00"
                            class="py-1.25 px-2.5 border <?= !empty($errors['price']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-sm outline-none focus:ring-3 duration-200">
                        <?php if (!empty($errors['price'])): ?>
                            <span class="text-sm text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                <?= htmlspecialchars($errors['price']) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="discount" class="text-sm font-medium text-zinc-700">Discount <span class="text-zinc-400 font-normal">(%)</span></label>
                        <input
                            type="number"
                            id="discount"
                            name="discount"
                            step="0.01"
                            min="0"
                            max="100"
                            value="<?= htmlspecialchars($old['discount'] ?? $book['discount']) ?>"
                            placeholder="0.00"
                            class="py-1.25 px-2.5 border <?= !empty($errors['discount']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-sm outline-none focus:ring-3 duration-200">
                        <?php if (!empty($errors['discount'])): ?>
                            <span class="text-sm text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                <?= htmlspecialchars($errors['discount']) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <button type="submit" class="py-1.25 px-2.5 border text-sm border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out flex items-center justify-center gap-1 cursor-pointer w-full">
                    <i class="fa-solid fa-pen-nib"></i>
                    Update Book
                </button>
            </div>
        </div>
    </form>
</div>

<?= end_layout('admin'); ?>