<header>
    <div class="max-w-300 mx-auto flex items-center justify-between py-4 px-6">
        <h1 class="font-serif text-3xl font-bold">
            <a href=" /">Bookstore</a>
        </h1>

        <form class="flex items-center relative" action="/search" method="get">
            <span class="absolute left-2.5 text-zinc-500">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input class="py-1.25 pr-2.5 pl-9 border border-zinc-400 rounded-[10px] text-base w-90 outline-none focus:border-zinc-900 focus:ring-3 focus:ring-zinc-300" type="text" name="q" placeholder="Search books by title, author, ISBN..." required />
            <button type="submit" hidden></button>
        </form>

        <nav class="flex items-center gap-4">
            <?php if (isset($_SESSION['user'])): ?>
                <a class="w-10 h-10 flex items-center justify-center text-xl bg-zinc-200 hover:bg-zinc-300 duration-200 ease-in rounded-full"
                    href="/orders">
                    <i class="fa-solid fa-box-open"></i>
                </a>

                <a class="w-10 h-10 flex items-center justify-center text-xl bg-zinc-200 hover:bg-zinc-300 duration-200 ease-in rounded-full relative"
                    href="/cart">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white font-medium text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        <?= cartCount() ?>
                    </span>
                </a>

                <span class="cursor-pointer w-10 h-10 flex items-center justify-center text-xl bg-zinc-200 hover:bg-zinc-300 duration-200 ease-in rounded-full relative" id="profileBtn">
                    <?php if (isset($_SESSION['user']['profile'])): ?>
                        <img class="w-10 h-10 rounded-full" src="<?= asset($_SESSION['user']['profile']) ?>" alt="<?= $_SESSION['user']['name'] ?>">
                    <?php else: ?>
                        <i class="fa-regular fa-user"></i>
                    <?php endif; ?>

                    <div class="hidden absolute top-14 right-0 bg-white shadow rounded-[10px] border border-zinc-200 w-56 cursor-default" id="profileMenu">
                        <div class="flex items-center gap-2 px-2 py-2.5 border-b border-zinc-200">
                            <?php if (isset($_SESSION['user']['profile'])): ?>
                                <img class="w-10 h-10 rounded-full" src="<?= asset($_SESSION['user']['profile']) ?>" alt="<?= $_SESSION['user']['name'] ?>">
                            <?php else: ?>
                                <div class="w-10 h-10 flex items-center justify-center text-xl bg-zinc-200 rounded-full shrink-0">
                                    <i class="fa-regular fa-user"></i>
                                </div>
                            <?php endif; ?>

                            <div class="text-base leading-tight w-full">
                                <p class="w-40 overflow-hidden text-ellipsis"><?= $_SESSION['user']['name'] ?></p>
                                <p class="w-40 overflow-hidden text-ellipsis"><?= $_SESSION['user']['email'] ?></p>
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
                </span>

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
    </div>

</header>