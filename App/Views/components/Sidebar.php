<aside id="sidebar" class="fixed md:sticky top-0 left-0 h-screen w-80 bg-white border-r border-zinc-300 flex flex-col z-50 -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out shrink-0">
    <div class="px-5 py-5">
        <a href="/admin" class="font-serif text-3xl font-bold text-zinc-900">Bookstore</a>
    </div>

    <nav class="flex-1 flex flex-col p-4 gap-1 overflow-y-auto">
        <?php
        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $navItems = [
            ['href' => '/admin',        'icon' => 'fa-solid fa-gauge-high', 'label' => 'Dashboard'],
            ['href' => '/admin/users',  'icon' => 'fa-solid fa-users',      'label' => 'Users'],
            ['href' => '/admin/books',  'icon' => 'fa-solid fa-book',       'label' => 'Books'],
            ['href' => '/admin/orders', 'icon' => 'fa-solid fa-box-open',   'label' => 'Orders'],
        ];
        foreach ($navItems as $item):
            $isActive = $currentPath === $item['href'] || ($item['href'] !== '/admin' && str_starts_with($currentPath, $item['href']));
        ?>
            <a href="<?= $item['href'] ?>"
                class="flex items-center gap-2 px-2.5 py-1.5 rounded-[10px] text-base font-medium duration-200 ease-in-out
                            <?= $isActive ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-500 hover:bg-zinc-50 hover:text-zinc-800' ?>">
                <i class="<?= $item['icon'] ?>"></i>
                <?= $item['label'] ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <div class="p-4 relative" id="profileBtn">
        <button class="flex mb-2 items-center justify-between px-3 py-2.5 hover:bg-zinc-100 rounded-[10px] text-sm font-medium text-zinc-900 duration-200 ease-in-out cursor-pointer border-0 bg-transparent w-full text-left">
            <div class="flex items-center gap-3">
                <?php if (!empty($_SESSION['user']['profile'])): ?>
                    <img src="<?= asset($_SESSION['user']['profile']) ?>" alt="avatar" class="w-10 h-10 rounded-full object-cover shrink-0">
                <?php else: ?>
                    <div class="w-9.75 h-9.75 rounded-full bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-500 text-base shrink-0 font-medium">
                        <?= strtoupper(substr($_SESSION['user']['name'], 0, 1)) ?>
                    </div>
                <?php endif; ?>
                <div class="overflow-hidden text-left leading-tight">
                    <p class="text-base font-medium text-zinc-900 truncate"><?= htmlspecialchars($_SESSION['user']['name'] ?? '') ?></p>
                    <p class="text-sm text-zinc-500 truncate"><?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?></p>
                </div>
            </div>

            <i class="fa-solid fa-ellipsis-vertical"></i>
        </button>

        <div class="hidden absolute md:bottom-6 bottom-24 md:-right-54 right-8 bg-white shadow rounded-[10px] border border-zinc-200 w-56 cursor-default" id="profileMenu">
            <div class="flex items-center gap-2 px-2 py-2.5 border-b border-zinc-200">
                <?php if (isset($_SESSION['user']['profile'])): ?>
                    <img class="w-10 h-10 rounded-full object-cover" src="<?= asset($_SESSION['user']['profile']) ?>" alt="<?= htmlspecialchars($_SESSION['user']['name']) ?>">
                <?php else: ?>
                    <div class="w-10 h-10 rounded-full bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-500 text-base shrink-0 font-medium">
                        <?= strtoupper(substr($_SESSION['user']['name'], 0, 1)) ?>
                    </div>
                <?php endif; ?>

                <div class="text-base leading-tight w-full overflow-hidden">
                    <p class="w-40 overflow-hidden text-ellipsis"><?= htmlspecialchars($_SESSION['user']['name']) ?></p>
                    <p class="w-40 overflow-hidden text-ellipsis text-zinc-500 text-sm"><?= htmlspecialchars($_SESSION['user']['email']) ?></p>
                </div>
            </div>

            <div class="flex flex-col p-1 text-base">
                <a class="px-3 py-1.5 rounded-[10px] hover:bg-zinc-200 duration-200 ease-in-out flex items-center gap-2" href="/">
                    <i class="fa-regular fa-house"></i>
                    Home
                </a>
                <a class="px-3 py-1.5 rounded-[10px] hover:bg-zinc-200 duration-200 ease-in-out flex items-center gap-2" href="/profile">
                    <i class="fa-regular fa-circle-user"></i>
                    Account
                </a>
                <form action="/logout" method="post">
                    <button type="submit" class="px-3.25 py-1.5 rounded-[10px] hover:bg-red-100 w-full text-left cursor-pointer duration-200 ease-in-out flex items-center gap-2 text-red-600">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>