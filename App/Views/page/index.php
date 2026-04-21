<?php
require __DIR__ . '/../layout_helper.php';
start_layout();
?>

<main>
    <h1>Books</h1>
    <ul>
        <?php foreach ($books as $book): ?>
            <a href="/book/<?= $book['id'] ?>">
                <?php include __DIR__ . '/../components/BookCard.php'; ?>
            </a>
        <?php endforeach; ?>
    </ul>

</main>

<?php end_layout('app'); ?>