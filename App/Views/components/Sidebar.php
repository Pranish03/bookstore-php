<aside id="sidebar" class="fixed md:sticky top-0 left-0 h-screen w-64 bg-white border-r border-zinc-300 flex flex-col z-50 -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out shrink-0">
    <div class="px-5 py-5 border-b border-zinc-200">
        <a href="/admin" class="font-serif text-2xl font-bold text-zinc-900">Bookstore</a>
        <p class="text-xs text-zinc-500 mt-0.5">Admin Panel</p>
    </div>

    <nav class="flex-1 flex flex-col p-3 gap-1 overflow-y-auto">
        <?php
        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $navItems = [
            ['href' => '/admin',        'icon' => 'fa-solid fa-gauge-high',   'label' => 'Dashboard'],
            ['href' => '/admin/users',   'icon' => 'fa-solid fa-users',        'label' => 'Users'],
            ['href' => '/admin/books',   'icon' => 'fa-solid fa-book',         'label' => 'Books'],
            ['href' => '/admin/orders',  'icon' => 'fa-solid fa-box-open',     'label' => 'Orders'],
        ];
        foreach ($navItems as $item):
            $isActive = $currentPath === $item['href'] || ($item['href'] !== '/admin' && str_starts_with($currentPath, $item['href']));
        ?>
            <a href="<?= $item['href'] ?>"
                class="flex items-center gap-3 px-3 py-2.5 rounded-[10px] text-sm font-medium duration-200 ease-in-out
                            <?= $isActive ? 'bg-zinc-900 text-white' : 'text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900' ?>">
                <i class="<?= $item['icon'] ?> w-4 text-center"></i>
                <?= $item['label'] ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <div class="p-3 border-t border-zinc-200">
        <div class="flex items-center gap-3 px-3 py-2.5 mb-1">
            <?php if (!empty($_SESSION['user']['profile'])): ?>
                <img src="<?= asset($_SESSION['user']['profile']) ?>" alt="avatar" class="w-8 h-8 rounded-full object-cover shrink-0">
            <?php else: ?>
                <div class="w-8 h-8 rounded-full bg-zinc-100 border border-zinc-300 flex items-center justify-center text-zinc-400 text-sm shrink-0">
                    <i class="fa-regular fa-user"></i>
                </div>
            <?php endif; ?>
            <div class="overflow-hidden">
                <p class="text-sm font-medium text-zinc-900 truncate"><?= htmlspecialchars($_SESSION['user']['name'] ?? '') ?></p>
                <p class="text-xs text-zinc-500 truncate"><?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?></p>
            </div>
        </div>
        <form action="/logout" method="post">
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-[10px] text-sm font-medium text-red-600 hover:bg-red-50 duration-200 ease-in-out cursor-pointer border-0 bg-transparent text-left">
                <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i>
                Logout
            </button>
        </form>
    </div>
</aside>