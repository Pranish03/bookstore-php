<?php
require __DIR__ . '/../layout_helper.php';
start_layout();
?>

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

<style>
    .home-page {
        --radius: 8px;
        --border: #e4e4e7;
        --muted: #71717a;
        --muted-bg: #f4f4f5;
        --foreground: #09090b;
        --card-bg: #ffffff;
        --accent: #18181b;
        --accent-hover: #3f3f46;
        --primary-fg: #fafafa;
        background: #fafafa;
        min-height: 100vh;
    }

    .hero {
        padding: 72px 0 48px;
        background: #ffffff;
        border-bottom: 1px solid var(--border);
    }

    .hero-inner {
        padding: 0 24px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 500;
        color: var(--muted);
        background: var(--muted-bg);
        border: 1px solid var(--border);
        border-radius: 9999px;
        padding: 4px 12px;
        margin-bottom: 24px;
        letter-spacing: 0.01em;
    }

    .badge-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #22c55e;
        flex-shrink: 0;
        box-shadow: 0 0 0 2px #dcfce7;
    }

    .hero-title {
        font-family: 'Georgia', 'Times New Roman', serif;
        font-size: clamp(36px, 5vw, 60px);
        font-weight: 700;
        line-height: 1.12;
        letter-spacing: -0.03em;
        color: var(--foreground);
        margin: 0 0 16px;
    }

    .hero-accent {
        color: var(--muted);
    }

    .hero-sub {
        font-size: 16px;
        color: var(--muted);
        line-height: 1.65;
        max-width: 520px;
        margin: 0 0 32px;
    }

    .hero-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        font-weight: 500;
        border-radius: var(--radius);
        padding: 9px 18px;
        text-decoration: none;
        transition: all 0.15s ease;
        cursor: pointer;
        white-space: nowrap;
        font-family: inherit;
    }

    .btn-primary {
        background: var(--accent);
        color: var(--primary-fg);
        border: 1px solid var(--accent);
    }

    .btn-primary:hover {
        background: var(--accent-hover);
        border-color: var(--accent-hover);
    }

    .btn-ghost {
        background: transparent;
        color: var(--foreground);
        border: 1px solid var(--border);
    }

    .btn-ghost:hover {
        background: var(--muted-bg);
    }

    .btn-arrow {
        transition: transform 0.15s ease;
    }

    .btn-ghost:hover .btn-arrow {
        transform: translateX(3px);
    }

    .stats-bar {
        display: flex;
        align-items: center;
        gap: 0;
        padding: 20px 24px;
        background: #ffffff;
        border-bottom: 1px solid var(--border);
    }

    .stat-item {
        display: flex;
        flex-direction: column;
        gap: 2px;
        padding: 0 32px;
    }

    .stat-item:first-child {
        padding-left: 0;
    }

    .stat-number {
        font-size: 18px;
        font-weight: 700;
        color: var(--foreground);
        letter-spacing: -0.02em;
        font-family: 'Georgia', serif;
    }

    .stat-label {
        font-size: 12px;
        color: var(--muted);
        font-weight: 400;
    }

    .stat-divider {
        width: 1px;
        height: 36px;
        background: var(--border);
    }

    .books-section {
        padding: 48px 24px 80px;
    }

    .section-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 32px;
        flex-wrap: wrap;
    }

    .section-title {
        font-size: 22px;
        font-weight: 600;
        color: var(--foreground);
        letter-spacing: -0.02em;
        margin: 0 0 4px;
    }

    .section-desc {
        font-size: 14px;
        color: var(--muted);
        margin: 0;
    }

    .inline-search {
        position: relative;
        display: flex;
        align-items: center;
    }

    .inline-search-icon {
        position: absolute;
        left: 10px;
        color: var(--muted);
        pointer-events: none;
    }

    .inline-search input {
        font-family: inherit;
        font-size: 13px;
        padding: 8px 12px 8px 34px;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        background: #ffffff;
        color: var(--foreground);
        outline: none;
        width: 240px;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }

    .inline-search input::placeholder {
        color: #a1a1aa;
    }

    .inline-search input:focus {
        border-color: #a1a1aa;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
    }

    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
    }

    .book-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .empty-state {
        text-align: center;
        padding: 80px 24px;
        color: var(--muted);
    }

    .empty-icon {
        margin-bottom: 16px;
        opacity: 0.35;
    }

    .empty-state p {
        font-size: 15px;
        margin: 0;
    }

    @media (max-width: 640px) {
        .hero {
            padding: 48px 0 32px;
        }

        .stats-bar {
            gap: 0;
            overflow-x: auto;
        }

        .stat-item {
            padding: 0 20px;
            min-width: fit-content;
        }

        .books-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .inline-search input {
            width: 100%;
        }

        .inline-search {
            width: 100%;
        }
    }

    @media (max-width: 400px) {
        .books-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<?php end_layout('app'); ?>