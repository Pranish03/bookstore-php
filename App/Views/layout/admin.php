<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <aside>
        <nav>
            <ul>
                <li><a href="/admin">Dashboard</a></li>
                <li><a href="/admin/users">Users</a></li>
                <li><a href="/admin/books">Books</a></li>
                <li><a href="/admin/orders">Orders</a></li>
            </ul>
        </nav>
    </aside>

    <main>
        <?= $content ?>
    </main>
</body>

</html>