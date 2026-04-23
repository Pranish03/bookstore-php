<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore | Register</title>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-zinc-50 min-h-screen flex items-center justify-center px-6 py-12">
    <?php
    $errors   = $_SESSION['errors'] ?? [];
    $oldInput = $_SESSION['old_input'] ?? [];
    unset($_SESSION['errors'], $_SESSION['old_input']);
    ?>

    <div class="w-full max-w-sm">
        <div class="text-center mb-8">
            <a href="/" class="font-serif text-3xl font-bold text-zinc-900">Bookstore</a>
            <p class="text-sm text-zinc-500 mt-2">Create an account to get started</p>
        </div>

        <div class="bg-white border border-zinc-300 rounded-[10px] p-6">
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="mb-5 px-4 py-3 bg-zinc-100 border border-zinc-300 rounded-[10px] text-sm text-zinc-700 flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-green-600"></i>
                    <?= htmlspecialchars($_SESSION['success']) ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (!empty($errors['general'])): ?>
                <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 rounded-[10px] text-sm text-red-600 flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= htmlspecialchars($errors['general']) ?>
                </div>
            <?php endif; ?>

            <form action="/register" method="POST" class="flex flex-col gap-5">
                <div class="flex flex-col gap-1.5">
                    <label for="name" class="text-sm font-medium text-zinc-700">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?= htmlspecialchars($oldInput['name'] ?? '') ?>"
                        placeholder="Enter your full name"
                        class="py-1.25 px-2.5 border <?= !empty($errors['name']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-base outline-none focus:ring-3 duration-200">
                    <?php if (!empty($errors['name'])): ?>
                        <span class="text-sm text-red-600 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-xs"></i>
                            <?= htmlspecialchars($errors['name']) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="email" class="text-sm font-medium text-zinc-700">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= htmlspecialchars($oldInput['email'] ?? '') ?>"
                        placeholder="you@example.com"
                        class="py-1.25 px-2.5 border <?= !empty($errors['email']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-base outline-none focus:ring-3 duration-200">
                    <?php if (!empty($errors['email'])): ?>
                        <span class="text-sm text-red-600 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-xs"></i>
                            <?= htmlspecialchars($errors['email']) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="password" class="text-sm font-medium text-zinc-700">Password</label>
                    <div class="flex items-center relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="At least 8 characters"
                            class="py-1.25 px-2.5 border w-full <?= !empty($errors['password']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-base outline-none focus:ring-3 duration-200">
                        <button type="button" id="togglePassword" class="absolute right-2.5 text-zinc-500 hover:text-zinc-700 duration-200 cursor-pointer">
                            <i id="toggleIcon" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    <?php if (!empty($errors['password'])): ?>
                        <span class="text-sm text-red-600 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-xs"></i>
                            <?= htmlspecialchars($errors['password']) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="confirm_password" class="text-sm font-medium text-zinc-700">Confirm Password</label>
                    <div class="flex items-center relative">
                        <input
                            type="password"
                            id="confirm_password"
                            name="confirm_password"
                            placeholder="Repeat your password"
                            class="py-1.25 px-2.5 border w-full <?= !empty($errors['confirm_password']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-base outline-none focus:ring-3 duration-200">
                        <button type="button" id="toggleConfirmPassword" class="absolute right-2.5 text-zinc-500 hover:text-zinc-700 duration-200 cursor-pointer">
                            <i id="toggleConfirmIcon" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    <?php if (!empty($errors['confirm_password'])): ?>
                        <span class="text-sm text-red-600 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-xs"></i>
                            <?= htmlspecialchars($errors['confirm_password']) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <button type="submit" class="w-full py-1.25 px-2.5 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out flex items-center justify-center gap-2 cursor-pointer mt-1">
                    Register
                </button>
            </form>
        </div>

        <p class="text-center text-sm text-zinc-500 mt-6">
            Already have an account?
            <a href="/login" class="text-zinc-900 font-medium hover:underline duration-200">Login</a>
        </p>
    </div>

    <script src="<?= asset('assets/js/auth.js') ?>"></script>
</body>

</html>