<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
</head>

<body>
    <header class="header">
        <div class="container">
            <h1>
                <a href="/">Bookstore</a>
            </h1>

            <form action="/search" method="get">
                <input type="text" name="q" placeholder="Search books by title, author or isbn" required />
                <button type="submit">Search</button>
            </form>

            <nav>
                <ul>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li><a href="/orders">Orders</a></li>
                        <li><a href="/cart">Cart (<?= $cartCount ?>)</a></li>
                        <li><a href="/profile">Profile</a></li>
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
        </div>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer>
        <p>&copy; 2026 Bookstore</p>
    </footer>
</body>

</html>