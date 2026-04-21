<?php
require __DIR__ . '/../layout_helper.php';
start_layout();
?>

<div>
    <h1>Search Results for "<?= htmlspecialchars($query) ?>"</h1>

    <?php if (empty($books)): ?>
        <p>No books found matching "<?= htmlspecialchars($query) ?>". <a href="/">Browse all books</a></p>
    <?php else: ?>
        <p><?= count($books) ?> book(s) found.</p>
        <ul>
            <?php foreach ($books as $book): ?>
                <a href="/book/<?= $book['id'] ?>">
                    <?php include __DIR__ . '/../components/BookCard.php'; ?>
                </a>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?php end_layout('app'); ?>