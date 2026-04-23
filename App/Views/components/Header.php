<header class="bg-white border-b border-zinc-300 sticky top-0 z-50">
    <div class="max-w-300 mx-auto flex items-center justify-between py-4 px-6">
        <h1 class="font-serif text-[32px] font-bold shrink-0">
            <a href="/">Bookstore</a>
        </h1>

        <form class="hidden md:flex items-center relative flex-1 max-w-120 mx-6" action="/search" method="get">
            <span class="absolute left-2.5 text-zinc-500">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input class="py-1.25 pr-2.5 pl-9 border border-zinc-300 rounded-[10px] text-base w-full outline-none focus:border-zinc-900 focus:ring-3 focus:ring-zinc-300" type="text" name="q" placeholder="Search books by title, author, ISBN..." required />
            <button type="submit" hidden></button>
        </form>

        <nav class="hidden md:flex items-center gap-4 shrink-0">
            <?php if (isset($_SESSION['user'])): ?>
                <a class="w-9.75 h-9.75 border border-zinc-200 flex items-center justify-center text-xl bg-zinc-100 rounded-full"
                    href="/orders">
                    <i class="fa-solid fa-box-open"></i>
                </a>

                <a class="w-9.75 h-9.75 border border-zinc-200 flex items-center justify-center text-xl bg-zinc-100 rounded-full relative"
                    href="/cart">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white font-medium text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        <?= cartCount() ?>
                    </span>
                </a>

                <div class="relative" id="profileBtn">
                    <?php if (isset($_SESSION['user']['profile'])): ?>
                        <img class="cursor-pointer w-10 h-10 rounded-full object-cover" src="<?= asset($_SESSION['user']['profile']) ?>" alt="<?= htmlspecialchars($_SESSION['user']['name']) ?>">
                    <?php else: ?>
                        <div class="cursor-pointer w-9.75 h-9.75 border border-zinc-200 rounded-full flex items-center justify-center text-xl text-zinc-500 bg-zinc-100">
                            <?= strtoupper(substr($_SESSION['user']['name'], 0, 1)) ?>
                        </div>
                    <?php endif; ?>

                    <div class="hidden absolute top-14 right-0 bg-white shadow rounded-[10px] border border-zinc-200 w-56 cursor-default" id="profileMenu">
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
                            <a class="px-3 py-1.5 rounded-[10px] hover:bg-zinc-200 duration-200 ease-in-out flex items-center gap-2" href="/profile">
                                <i class="fa-regular fa-circle-user"></i>
                                Account
                            </a>
                            <?php if ($_SESSION['user']['is_admin']): ?>
                                <a class="px-3 py-1.5 rounded-[10px] hover:bg-zinc-200 duration-200 ease-in-out flex items-center gap-2" href="/admin">
                                    <i class="fa-solid fa-gauge-high"></i>
                                    Dashboard
                                </a>
                            <?php endif; ?>
                            <form action="/logout" method="post">
                                <button type="submit" class="px-3.25 py-1.5 rounded-[10px] hover:bg-red-100 w-full text-left cursor-pointer duration-200 ease-in-out flex items-center gap-2 text-red-600">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <a class="py-1.25 px-2.5 border text-base border-zinc-300 hover:bg-zinc-100 duration-200 ease-in-out rounded-[10px]" href="/login">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Login
                </a>
                <a class="py-1.25 px-2.5 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out" href="/register">
                    <i class="fa-solid fa-circle-plus"></i>
                    Register
                </a>
            <?php endif; ?>
        </nav>

        <div class="flex md:hidden items-center gap-3">
            <?php if (isset($_SESSION['user'])): ?>
                <a class="w-9.75 h-9.75 border border-zinc-200 flex items-center justify-center text-xl bg-zinc-200 rounded-full relative" href="/cart">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white font-medium text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        <?= cartCount() ?>
                    </span>
                </a>
            <?php endif; ?>
            <button id="mobileMenuBtn" aria-label="Toggle menu" aria-expanded="false"
                class="w-9.75 h-9.75 border border-zinc-200 flex items-center justify-center text-xl bg-zinc-200 rounded-full cursor-pointer">
                <i id="mobileMenuIcon" class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>

    <div class="md:hidden px-6 pb-3 border-b border-zinc-200">
        <form class="flex items-center relative" action="/search" method="get">
            <span class="absolute left-2.5 text-zinc-500">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input class="py-1.25 pr-2.5 pl-9 border border-zinc-300 rounded-[10px] text-base w-full outline-none focus:border-zinc-900 focus:ring-3 focus:ring-zinc-300" type="text" name="q" placeholder="Search books..." required />
            <button type="submit" hidden></button>
        </form>
    </div>

    <div id="mobileNavDrawer" class="md:hidden hidden border-b border-zinc-200 bg-white">
        <?php if (isset($_SESSION['user'])): ?>
            <div class="flex items-center gap-3 px-6 py-4 border-b border-zinc-100">
                <?php if (isset($_SESSION['user']['profile'])): ?>
                    <img class="w-10 h-10 rounded-full object-cover shrink-0" src="<?= asset($_SESSION['user']['profile']) ?>" alt="<?= htmlspecialchars($_SESSION['user']['name']) ?>">
                <?php else: ?>
                    <div class="w-10 h-10 rounded-full bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-500 text-base shrink-0 font-medium">
                        <?= strtoupper(substr($_SESSION['user']['name'], 0, 1)) ?>
                    </div>
                <?php endif; ?>
                <div class="overflow-hidden">
                    <p class="font-medium text-base text-zinc-900 truncate"><?= htmlspecialchars($_SESSION['user']['name']) ?></p>
                    <p class="text-sm text-zinc-500 truncate"><?= htmlspecialchars($_SESSION['user']['email']) ?></p>
                </div>
            </div>
            <nav class="flex flex-col p-3">
                <a class="flex items-center gap-2.5 px-3 py-2.5 rounded-[10px] hover:bg-zinc-100 duration-200 ease-in-out text-base" href="/orders">
                    <i class="fa-solid fa-box-open"></i> My Orders
                </a>
                <a class="flex items-center gap-2.5 px-3 py-2.5 rounded-[10px] hover:bg-zinc-100 duration-200 ease-in-out text-base" href="/profile">
                    <i class="fa-regular fa-circle-user"></i> Account
                </a>
                <?php if ($_SESSION['user']['is_admin']): ?>
                    <a class="flex items-center gap-2.5 px-3 py-2.5 rounded-[10px] hover:bg-zinc-100 duration-200 ease-in-out text-base" href="/admin">
                        <i class="fa-solid fa-gauge-high"></i> Dashboard
                    </a>
                <?php endif; ?>
                <form action="/logout" method="post">
                    <button type="submit" class="flex items-center gap-2.5 px-3 py-2.5 rounded-[10px] hover:bg-red-100 duration-200 ease-in-out text-base text-red-600 w-full text-left cursor-pointer bg-transparent border-0">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                    </button>
                </form>
            </nav>
        <?php else: ?>
            <nav class="flex flex-col p-3">
                <a class="flex items-center gap-2.5 px-3 py-2.5 rounded-[10px] hover:bg-zinc-100 duration-200 ease-in-out text-base" href="/login">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                </a>
                <a class="flex items-center gap-2.5 px-3 py-2.5 rounded-[10px] hover:bg-zinc-100 duration-200 ease-in-out text-base" href="/register">
                    <i class="fa-solid fa-circle-plus"></i> Register
                </a>
            </nav>
        <?php endif; ?>
    </div>
</header>