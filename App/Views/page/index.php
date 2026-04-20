<?php
require __DIR__ . '/../layout_helper.php';
start_layout();
?>

<main>
    <h1>Books</h1>
    <ul>
        <?php foreach ($books as $book): ?>
            <li><strong><?= htmlspecialchars($book['title']) ?></strong> by <?= htmlspecialchars($book['author']) ?></li>
        <?php endforeach; ?>
    </ul>

</main>

<?php end_layout('app'); ?>