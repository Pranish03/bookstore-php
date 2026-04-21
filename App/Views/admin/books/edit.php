<?php
require __DIR__ . '/../../layout_helper.php';
start_layout();

$errors = $_SESSION['errors']    ?? [];
$old    = $_SESSION['old_input'] ?? [];

unset($_SESSION['errors'], $_SESSION['old_input']);
?>

<div>
    <h1>Edit Book</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color:green"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form action="/admin/books/<?= (int) $book['id'] ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">

        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title"
                value="<?= htmlspecialchars($old['title'] ?? $book['title']) ?>" required>
            <?php if (!empty($errors['title'])): ?>
                <span class="error"><?= htmlspecialchars($errors['title']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author"
                value="<?= htmlspecialchars($old['author'] ?? $book['author']) ?>" required>
            <?php if (!empty($errors['author'])): ?>
                <span class="error"><?= htmlspecialchars($errors['author']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="image">Image:</label>
            <?php if (!empty($book['image'])): ?>
                <div>
                    <img src="/<?= htmlspecialchars($book['image']) ?>" alt="Current cover" width="100">
                    <small>Leave blank to keep the current image.</small>
                </div>
            <?php endif; ?>
            <input type="file" id="image" name="image">
            <?php if (!empty($errors['image'])): ?>
                <span class="error"><?= htmlspecialchars($errors['image']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01"
                value="<?= htmlspecialchars($old['price'] ?? $book['price']) ?>" required>
            <?php if (!empty($errors['price'])): ?>
                <span class="error"><?= htmlspecialchars($errors['price']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="discount">Discount:</label>
            <input type="number" id="discount" name="discount" step="0.01"
                value="<?= htmlspecialchars($old['discount'] ?? $book['discount']) ?>" required>
            <?php if (!empty($errors['discount'])): ?>
                <span class="error"><?= htmlspecialchars($errors['discount']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?= htmlspecialchars($old['description'] ?? $book['description']) ?></textarea>
            <?php if (!empty($errors['description'])): ?>
                <span class="error"><?= htmlspecialchars($errors['description']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn"
                value="<?= htmlspecialchars($old['isbn'] ?? $book['isbn']) ?>" required>
            <?php if (!empty($errors['isbn'])): ?>
                <span class="error"><?= htmlspecialchars($errors['isbn']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="published_on">Published on:</label>
            <input type="date" id="published_on" name="published_on"
                value="<?= htmlspecialchars($old['published_on'] ?? $book['published_on']) ?>" required>
            <?php if (!empty($errors['published_on'])): ?>
                <span class="error"><?= htmlspecialchars($errors['published_on']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="published_by">Published by:</label>
            <input type="text" id="published_by" name="published_by"
                value="<?= htmlspecialchars($old['published_by'] ?? $book['published_by']) ?>" required>
            <?php if (!empty($errors['published_by'])): ?>
                <span class="error"><?= htmlspecialchars($errors['published_by']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="pages">Pages:</label>
            <input type="number" id="pages" name="pages"
                value="<?= htmlspecialchars($old['pages'] ?? $book['pages']) ?>" required>
            <?php if (!empty($errors['pages'])): ?>
                <span class="error"><?= htmlspecialchars($errors['pages']) ?></span>
            <?php endif; ?>
        </div>

        <button type="submit">Update Book</button>
    </form>
</div>

<?php end_layout('admin'); ?>