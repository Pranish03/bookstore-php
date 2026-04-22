<?php start_layout(); ?>

<div>
    <section>
        <div>
            <div>
                <span></span>
                New arrivals every week
            </div>
            <h1>Your next great<br><span>read awaits.</span></h1>
            <p>Discover handpicked books across every genre. From timeless classics to contemporary fiction — curated for curious minds.</p>
            <div>
                <a href="/search?q=">Browse Collection</a>
                <a href="#books">View all books <span>→</span></a>
            </div>
        </div>
        <hr>
    </section>

    <div>
        <div>
            <span><?= count($books) ?>+</span>
            <span>Books in stock</span>
        </div>
        <div></div>
        <div>
            <span>100%</span>
            <span>Authentic titles</span>
        </div>
        <div></div>
        <div>
            <span>Fast</span>
            <span>Cash on delivery</span>
        </div>
    </div>

    <section id="books">
        <div>
            <div>
                <h2>All Books</h2>
                <p>Browse our complete collection</p>
            </div>
            <form action="/search" method="get">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="q" placeholder="Search titles, authors, ISBN…" required />
            </form>
        </div>

        <?php if (empty($books)): ?>
            <div>
                <i class="fa-solid fa-book"></i>
                <p>No books available yet. Check back soon.</p>
            </div>
        <?php else: ?>
            <div>
                <?php foreach ($books as $book): ?>
                    <a href="/book/<?= $book['id'] ?>">
                        <?php component('BookCard', compact('book')); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</div>

<?php end_layout('app'); ?>