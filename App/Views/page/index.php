<?= start_layout(); ?>

<div class="home-page">
    <section class="hero">
        <div class="hero-inner container">
            <div class="hero-badge">
                <span class="badge-dot"></span>
                New arrivals every week
            </div>
            <h1 class="hero-title">Your next great<br><span class="hero-accent">read awaits.</span></h1>
            <p class="hero-sub">Discover handpicked books across every genre. From timeless classics to contemporary fiction — curated for curious minds.</p>
            <div class="hero-actions">
                <a href="/search?q=" class="btn btn-primary">Browse Collection</a>
                <a href="#books" class="btn btn-ghost">View all books <span class="btn-arrow">→</span></a>
            </div>
        </div>
        <div class="hero-rule"></div>
    </section>

    <div class="stats-bar container">
        <div class="stat-item">
            <span class="stat-number"><?= count($books) ?>+</span>
            <span class="stat-label">Books in stock</span>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <span class="stat-number">100%</span>
            <span class="stat-label">Authentic titles</span>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <span class="stat-number">Fast</span>
            <span class="stat-label">Cash on delivery</span>
        </div>
    </div>

    <section class="books-section container" id="books">
        <div class="section-header">
            <div>
                <h2 class="section-title">All Books</h2>
                <p class="section-desc">Browse our complete collection</p>
            </div>
            <form class="inline-search" action="/search" method="get">
                <svg class="inline-search-icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
                <input type="text" name="q" placeholder="Search titles, authors, ISBN…" required />
            </form>
        </div>

        <?php if (empty($books)): ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
                    </svg>
                </div>
                <p>No books available yet. Check back soon.</p>
            </div>
        <?php else: ?>
            <div class="books-grid">
                <?php foreach ($books as $book): ?>
                    <a href="/book/<?= $book['id'] ?>" class="book-card-link">
                        <?php include __DIR__ . '/../components/BookCard.php'; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</div>

<?= end_layout('app'); ?>