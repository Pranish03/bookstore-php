<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link rel="stylesheet" href="<?= asset('assets/css/app.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/home.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header class="header container">
        <h1 class="logo">
            <a href="/">Bookstore</a>
        </h1>

        <form class="search" action="/search" method="get">
            <span class="search-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" name="q" placeholder="Search books by title, author or isbn" required />
            <button type="submit" hidden>
            </button>
        </form>

        <nav class="nav">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="/orders" class="orders">
                    <i class="fa-solid fa-box-open"></i>
                </a>
                <a href="/cart" class="cart">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="cart-count">
                        <?= $cartCount ?>
                    </span>
                </a>

                <span class="profile" id="profileBtn">
                    <?php if (isset($_SESSION['user']['profile'])): ?>
                        <img src="<?= asset($_SESSION['user']['profile']) ?>" alt="<?= $_SESSION['user']['name'] ?>">
                    <?php else: ?>
                        <span class="default-profile">
                            <i class="fa-regular fa-user"></i>
                        </span>
                    <?php endif; ?>

                    <div class="menu" id="profileMenu">
                        <div class="profile-info">
                            <?php if (isset($_SESSION['user']['profile'])): ?>
                                <img src="<?= asset($_SESSION['user']['profile']) ?>" alt="<?= $_SESSION['user']['name'] ?>">
                            <?php else: ?>
                                <div class="user">
                                    <i class="fa-regular fa-user"></i>
                                </div>
                            <?php endif; ?>
                            <div>
                                <span><?= $_SESSION['user']['name'] ?></span>
                                <span><?= $_SESSION['user']['email'] ?></span>
                            </div>
                        </div>

                        <div class="menus">
                            <a href="/profile">Account</a>
                            <?php if ($_SESSION['user']['is_admin']): ?>
                                <a href="/admin">Dashboard</a>
                            <?php endif; ?>
                            <form action="/logout" method="post">
                                <button type="submit">Logout</button>
                            </form>
                        </div>
                    </div>
                </span>
            <?php else: ?>
                <a href="/register">Register</a>
                <a href="/login">Login</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-brand">
                <a href="/" class="footer-logo">Bookstore</a>
                <p>Timeless stories, modern discoveries. Your next great read is just a page away. Browse our collection, discover new authors, and find your next favorite read.</p>
                <div class="social-links">
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Goodreads"><i class="fab fa-goodreads-g"></i></a>
                </div>
            </div>

            <div class="footer-links">
                <div class="link-column">
                    <h4>Explore</h4>
                    <ul>
                        <li><a href="#">New Releases</a></li>
                        <li><a href="#">Bestsellers</a></li>
                        <li><a href="#">Staff Picks</a></li>
                        <li><a href="#">Audiobooks</a></li>
                    </ul>
                </div>
                <div class="link-column">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Returns & Exchanges</a></li>
                        <li><a href="#">Gift Cards</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="link-column">
                    <h4>Community</h4>
                    <ul>
                        <li><a href="#">Book Club</a></li>
                        <li><a href="#">Reader Reviews</a></li>
                        <li><a href="#">Author Events</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="copyright">&copy; 2026 Bookstore. All rights reserved.</p>
            <div class="legal-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Accessibility</a>
            </div>
        </div>
    </footer>

    <script src="<?= asset('assets/js/app.js') ?>"></script>
</body>

</html>