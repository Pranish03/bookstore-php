<?php
require __DIR__ . '/../layout_helper.php';
start_layout();
?>

<div>
    <img src="/<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>">

    <h2><?= htmlspecialchars($book['title']) ?></h2>
    <p><?= $book['price'] ?></p>
    <p><?= htmlspecialchars($book['author']) ?></p>

    <button>Add to Cart</button>

    <p><?= htmlspecialchars($book['description']) ?></p>

    <div>
        <p><?= htmlspecialchars($book['isbn']) ?></p>
        <p><?= htmlspecialchars($book['published_on']) ?></p>
        <p><?= htmlspecialchars($book['published_by']) ?></p>
        <p><?= htmlspecialchars($book['pages']) ?></p>
    </div>
</div>

<?php end_layout('app'); ?>