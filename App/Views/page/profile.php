<?= start_layout(); ?>

<?php
$errors = $_SESSION['errors']    ?? [];
$old    = $_SESSION['old_input'] ?? [];

unset($_SESSION['errors'], $_SESSION['old_input']);
?>

<div class="bg-zinc-50 min-h-screen">
    <div class="max-w-300 mx-auto px-6 py-10 md:py-16">

        <div class="mb-8">
            <a href="/" class="text-sm text-zinc-500 hover:text-zinc-900 duration-200 ease-in-out flex items-center gap-1.5 w-min whitespace-nowrap">
                <i class="fa-solid fa-arrow-left-long text-xs"></i>
                Back to books
            </a>
        </div>

        <h1 class="text-3xl font-bold font-serif mb-8">My Account</h1>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="mb-6 px-4 py-3 bg-zinc-100 border border-zinc-300 rounded-[10px] text-sm text-zinc-700 flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-green-600"></i>
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <div class="flex flex-col gap-6">

            <div class="bg-white border border-zinc-300 rounded-[10px] p-6">
                <h2 class="text-base font-semibold text-zinc-900 pb-4 mb-5 border-b border-zinc-200 flex items-center gap-2">
                    <i class="fa-regular fa-image text-zinc-400"></i>
                    Profile Picture
                </h2>

                <?php if (!empty($errors['avatar'])): ?>
                    <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 rounded-[10px] text-sm text-red-600 flex items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <?= htmlspecialchars($errors['avatar']) ?>
                    </div>
                <?php endif; ?>

                <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                    <div class="shrink-0">
                        <?php if (!empty($user['profile'])): ?>
                            <img src="/<?= htmlspecialchars($user['profile']) ?>"
                                alt="<?= htmlspecialchars($user['name']) ?>"
                                class="w-20 h-20 rounded-full object-cover border border-zinc-300">
                        <?php else: ?>
                            <div class="w-20 h-20 rounded-full bg-zinc-100 border border-zinc-300 flex items-center justify-center text-zinc-400 text-2xl">
                                <i class="fa-regular fa-user"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex-1 flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <form action="/profile/upload-avatar" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row sm:items-center gap-3">
                                <input
                                    type="file"
                                    id="avatar"
                                    name="avatar"
                                    accept="image/jpeg,image/png,image/webp"
                                    class="py-1.25 px-2.5 border border-zinc-300 rounded-[10px] text-sm text-zinc-700 outline-none focus:border-zinc-900 focus:ring-3 focus:ring-zinc-300 duration-200 file:mr-3 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 file:cursor-pointer w-full sm:w-auto">
                                <button type="submit" class="py-1.25 px-2.5 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out flex items-center gap-2 cursor-pointer shrink-0">
                                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    Upload
                                </button>
                            </form>
                            <?php if (!empty($user['profile'])): ?>
                                <form action="/profile/remove-avatar" method="POST"
                                    onsubmit="return confirm('Remove your profile picture?')">
                                    <button type="submit" class="py-1.25 px-2.5 border text-base border-zinc-300 hover:bg-red-100 hover:border-red-200 hover:text-red-600 text-zinc-600 rounded-[10px] duration-200 ease-in-out cursor-pointer flex items-center gap-2">
                                        Remove picture
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                        <div class="flex items-center gap-3">
                            <p class="text-xs text-zinc-500">JPG, PNG, or WEBP — max 2MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-zinc-300 rounded-[10px] p-6">
                <h2 class="text-base font-semibold text-zinc-900 pb-4 mb-5 border-b border-zinc-200 flex items-center gap-2">
                    <i class="fa-regular fa-circle-user text-zinc-400"></i>
                    Account Info
                </h2>

                <form action="/profile/update-info" method="POST" class="flex flex-col gap-5">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1.5">
                            <label for="name" class="text-sm font-medium text-zinc-700">Full Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="<?= htmlspecialchars($old['name'] ?? $user['name']) ?>"
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
                                value="<?= htmlspecialchars($old['email'] ?? $user['email']) ?>"
                                placeholder="Enter your email"
                                class="py-1.25 px-2.5 border <?= !empty($errors['email']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-base outline-none focus:ring-3 duration-200">
                            <?php if (!empty($errors['email'])): ?>
                                <span class="text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                    <?= htmlspecialchars($errors['email']) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="py-1.25 px-2.5 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out flex items-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>

            <div class="bg-white border border-zinc-300 rounded-[10px] p-6">
                <h2 class="text-base font-semibold text-zinc-900 pb-4 mb-5 border-b border-zinc-200 flex items-center gap-2">
                    <i class="fa-solid fa-lock text-zinc-400"></i>
                    Change Password
                </h2>

                <form action="/profile/change-password" method="POST" class="flex flex-col gap-5">

                    <div class="flex flex-col gap-1.5">
                        <label for="current_password" class="text-sm font-medium text-zinc-700">Current Password</label>
                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            placeholder="Enter your current password"
                            class="py-1.25 px-2.5 border <?= !empty($errors['current_password']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-base outline-none focus:ring-3 duration-200 max-w-sm">
                        <?php if (!empty($errors['current_password'])): ?>
                            <span class="text-sm text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                <?= htmlspecialchars($errors['current_password']) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1.5">
                            <label for="new_password" class="text-sm font-medium text-zinc-700">New Password</label>
                            <input
                                type="password"
                                id="new_password"
                                name="new_password"
                                placeholder="At least 8 characters"
                                class="py-1.25 px-2.5 border <?= !empty($errors['new_password']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-base outline-none focus:ring-3 duration-200">
                            <?php if (!empty($errors['new_password'])): ?>
                                <span class="text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                    <?= htmlspecialchars($errors['new_password']) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="confirm_password" class="text-sm font-medium text-zinc-700">Confirm New Password</label>
                            <input
                                type="password"
                                id="confirm_password"
                                name="confirm_password"
                                placeholder="Repeat your new password"
                                class="py-1.25 px-2.5 border <?= !empty($errors['confirm_password']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-base outline-none focus:ring-3 duration-200">
                            <?php if (!empty($errors['confirm_password'])): ?>
                                <span class="text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                    <?= htmlspecialchars($errors['confirm_password']) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="py-1.25 px-2.5 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out flex items-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-key"></i>
                            Update Password
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<?= end_layout('app'); ?>