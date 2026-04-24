<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore | Page Not Found</title>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-zinc-50 min-h-screen flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-sm text-center flex flex-col items-center gap-6">
        <a href="/" class="font-serif text-3xl font-bold text-zinc-900">Bookstore</a>
        <span class="text-7xl font-bold font-serif text-zinc-200">404</span>

        <div class="flex flex-col gap-2">
            <h1 class="text-xl font-semibold text-zinc-900">Page Not Found</h1>
            <p class="text-sm text-zinc-500">The page you are looking for doesn't exist or has been moved.</p>
        </div>

        <a href="javascript:history.back()"
            class="max-w-min text-nowrap py-1.25 px-2.5 border text-base border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out flex items-center justify-center gap-2 text-zinc-700">
            <i class="fa-solid fa-arrow-left-long"></i>
            Go Back
        </a>
    </div>
</body>

</html>