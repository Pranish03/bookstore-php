<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
</head>

<body>
    <header>
        <h1>Bookstore</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/admin">Admin</a></li>

                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="/cart">Cart (<?= $cartCount ?>)</a></li>
                    <li>
                        <form action="/logout" method="post">
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                <?php else: ?>
                    <li><a href="/register">Register</a></li>
                    <li><a href="/login">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer>
        <p>&copy; 2026 Bookstore</p>
    </footer>
</body>

</html>