<?php
require __DIR__ . '/../../layout_helper.php';
start_layout();
?>

<div>
    <h1>Books</h1>

    <div>
        <input type="text" placeholder="Search by book title and name">
        <a href="/admin/books/create">Add New Book</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($books as $index => $book): ?>
                <tr>
                    <td><?= ++$index ?></td>
                    <td>
                        <a href="/admin/books/<?= $book['id'] ?>">
                            <?= $book['title'] ?>
                        </a>
                    </td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['price'] ?></td>
                    <td>
                        <a href="/admin/books/<?= $book['id'] ?>/edit">Edit</a>
                        <form method="POST" action="/admin/books/<?= $book['id'] ?>" style="display: inline;">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" onclick="return confirm('Are you dure You want to delete this book?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php end_layout('admin'); ?>