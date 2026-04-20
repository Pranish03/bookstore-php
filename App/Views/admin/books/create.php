<?php
require __DIR__ . '/../../layout_helper.php';
start_layout();
?>

<div>
    <h1>Add Book</h1>

    <form action="/admin/books" method="POST">
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div>
            <label for="isbn">isbn:</label>
            <input type="text" id="isbn" name="isbn" required>
        </div>
        <div>
            <label for="published_on">Published on:</label>
            <input type="date" id="published_on" name="published_on" required>
        </div>
        <div>
            <label for="published_by">Published by:</label>
            <input type="text" id="published_by" name="published_by" required>
        </div>
        <div>
            <label for="pages">Pages:</label>
            <input type="number" id="pages" name="pages" required>
        </div>

        <button type="submit">Add Book</button>
    </form>
</div>

<?php end_layout('admin'); ?>