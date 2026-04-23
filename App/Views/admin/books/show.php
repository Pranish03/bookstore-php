<?= start_layout(); ?>

<div>
    <div>
        <a href="/admin/books">Go back</a>
    </div>

    <form method="POST" action="/admin/books/<?= $book['id'] ?>">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit"
            onclick="return confirm('Are you sure you want to delete this book?')"
            class="py-1.25 px-2.5 border text-sm border-red-200 bg-red-50 text-red-600 hover:bg-red-100 rounded-[10px] duration-200 ease-in-out flex items-center gap-1 cursor-pointer">
            <i class="fa-solid fa-trash-can"></i>
            Delete
        </button>
    </form>

    <img src="/<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>">

    <h2><?= htmlspecialchars($book['title']) ?></h2>

    <?php if ($book['discount'] > 0): ?>
        <del>
            <p>Rs. <?= number_format($book['price'], 2) ?></p>
        </del>
        <p>Rs. <?= number_format($book['price'] - ($book['price'] * $book['discount'] / 100), 2) ?></p>
    <?php else: ?>
        <p>Rs. <?= number_format($book['price'], 2) ?></p>
    <?php endif; ?>

    <p><?= htmlspecialchars($book['author']) ?></p>
    <p><?= htmlspecialchars($book['description']) ?></p>

    <div>
        <p><?= htmlspecialchars($book['isbn']) ?></p>
        <p><?= htmlspecialchars($book['published_on']) ?></p>
        <p><?= htmlspecialchars($book['published_by']) ?></p>
        <p><?= htmlspecialchars($book['pages']) ?></p>
    </div>
</div>

<?= end_layout('admin'); ?>