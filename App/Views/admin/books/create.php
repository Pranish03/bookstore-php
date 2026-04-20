<?php
require __DIR__ . '/../../layout_helper.php';
start_layout();

$errors   = $_SESSION['errors']    ?? [];
$old      = $_SESSION['old_input'] ?? [];

unset($_SESSION['errors'], $_SESSION['old_input']);
?>

<div>
    <h1>Add Book</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color:green"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form action="/admin/books" method="POST" enctype="multipart/form-data">
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title"
                value="<?= htmlspecialchars($old['title'] ?? '') ?>" required>
            <?php if (!empty($errors['title'])): ?>
                <span class="error"><?= htmlspecialchars($errors['title']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author"
                value="<?= htmlspecialchars($old['author'] ?? '') ?>" required>
            <?php if (!empty($errors['author'])): ?>
                <span class="error"><?= htmlspecialchars($errors['author']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required>
            <?php if (!empty($errors['image'])): ?>
                <span class="error"><?= htmlspecialchars($errors['image']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01"
                value="<?= htmlspecialchars($old['price'] ?? '') ?>" required>
            <?php if (!empty($errors['price'])): ?>
                <span class="error"><?= htmlspecialchars($errors['price']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required>
                <?= htmlspecialchars($old['description'] ?? '') ?>
            </textarea>
            <?php if (!empty($errors['description'])): ?>
                <span class="error"><?= htmlspecialchars($errors['description']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn"
                value="<?= htmlspecialchars($old['isbn'] ?? '') ?>" required>
            <?php if (!empty($errors['isbn'])): ?>
                <span class="error"><?= htmlspecialchars($errors['isbn']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="published_on">Published on:</label>
            <input type="date" id="published_on" name="published_on"
                value="<?= htmlspecialchars($old['published_on'] ?? '') ?>" required>
            <?php if (!empty($errors['published_on'])): ?>
                <span class="error"><?= htmlspecialchars($errors['published_on']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="published_by">Published by:</label>
            <input type="text" id="published_by" name="published_by"
                value="<?= htmlspecialchars($old['published_by'] ?? '') ?>" required>
            <?php if (!empty($errors['published_by'])): ?>
                <span class="error"><?= htmlspecialchars($errors['published_by']) ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="pages">Pages:</label>
            <input type="number" id="pages" name="pages"
                value="<?= htmlspecialchars($old['pages'] ?? '') ?>" required>
            <?php if (!empty($errors['pages'])): ?>
                <span class="error"><?= htmlspecialchars($errors['pages']) ?></span>
            <?php endif; ?>
        </div>

        <button type="submit">Add Book</button>
    </form>
</div>

<?php end_layout('admin'); ?>