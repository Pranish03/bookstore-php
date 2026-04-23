<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore | Admin</title>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-zinc-100 min-h-screen">
    <header class="md:hidden bg-white border-b border-zinc-300 flex items-center justify-between px-4 py-3 sticky top-0 z-50">
        <a href="/admin" class="font-serif text-xl font-bold text-zinc-900">Bookstore</a>
        <button id="sidebarToggle" class="w-9 h-9 flex items-center justify-center rounded-[10px] bg-zinc-100 hover:bg-zinc-200 duration-200 cursor-pointer border-0">
            <i id="sidebarToggleIcon" class="fa-solid fa-bars text-zinc-700"></i>
        </button>
    </header>

    <div id="sidebarOverlay" class="fixed inset-0 bg-zinc-900/40 z-40 hidden md:hidden"></div>
    <div class="flex min-h-screen">

        <?= component('Sidebar') ?>

        <main class="flex-1 min-w-0 p-6 md:p-8">
            <?= $content ?>
        </main>

    </div>

    <script>
        const toggle = document.getElementById('sidebarToggle');
        const icon = document.getElementById('sidebarToggleIcon');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            icon.className = 'fa-solid fa-xmark text-zinc-700';
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            icon.className = 'fa-solid fa-bars text-zinc-700';
        }

        toggle.addEventListener('click', function() {
            sidebar.classList.contains('-translate-x-full') ? openSidebar() : closeSidebar();
        });

        overlay.addEventListener('click', closeSidebar);
    </script>

</body>

</html>