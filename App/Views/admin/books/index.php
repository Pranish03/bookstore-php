<?php
require __DIR__ . '/../../layout_helper.php';
start_layout();
?>

<div>
    <h1>Books</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color:green"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div>
        <form action="/admin/books" method="GET">
            <input type="text" name="q" placeholder="Search by title, author or ISBN"
                value="<?= htmlspecialchars($query) ?>">
            <button type="submit">Search</button>
            <?php if ($query): ?>
                <a href="/admin/books">Clear</a>
            <?php endif; ?>
        </form>
        <a href="/admin/books/create">Add New Book</a>
    </div>

    <?php if ($query): ?>
        <p><?= count($books) ?> result(s) for "<?= htmlspecialchars($query) ?>"</p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Author</th>
                <th>Original Price</th>
                <th>Discount Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($books)): ?>
                <tr>
                    <td colspan="6">No books found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($books as $index => $book): ?>
                    <tr>
                        <td><?= ++$index ?></td>
                        <td>
                            <a href="/admin/books/<?= $book['id'] ?>">
                                <?= htmlspecialchars($book['title']) ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($book['author']) ?></td>
                        <td>Rs. <?= number_format($book['price'], 2) ?></td>
                        <td>Rs. <?= number_format($book['price'] - ($book['price'] * $book['discount'] / 100), 2) ?></td>
                        <td>
                            <a href="/admin/books/<?= $book['id'] ?>/edit">Edit</a>
                            <form method="POST" action="/admin/books/<?= $book['id'] ?>" style="display:inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this book?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php end_layout('admin'); ?>