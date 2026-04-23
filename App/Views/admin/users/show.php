<?= start_layout(); ?>

<div class="flex flex-col gap-6">

    <div>
        <a href="/admin/users" class="text-sm text-zinc-500 hover:text-zinc-900 duration-200 ease-in-out flex items-center gap-1.5 w-min whitespace-nowrap mb-4">
            <i class="fa-solid fa-arrow-left-long text-xs"></i>
            Back to users
        </a>
        <h1 class="text-2xl font-bold font-serif text-zinc-900"><?= htmlspecialchars($user['name']) ?></h1>
    </div>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="px-4 py-3 bg-zinc-100 border border-zinc-300 rounded-[10px] text-sm text-zinc-700 flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-green-600"></i>
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="px-4 py-3 bg-red-50 border border-red-200 rounded-[10px] text-sm text-red-600 flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation"></i>
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="flex flex-col lg:flex-row gap-6 items-start">

        <!-- User info card -->
        <div class="bg-white border border-zinc-300 rounded-[10px] p-6 flex flex-col gap-5 w-full lg:w-80 shrink-0">

            <!-- Avatar + name -->
            <div class="flex flex-col items-center gap-3 pb-5 border-b border-zinc-200">
                <div class="w-16 h-16 rounded-full bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-500 text-2xl font-semibold">
                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                </div>
                <div class="text-center">
                    <p class="font-semibold text-zinc-900"><?= htmlspecialchars($user['name']) ?></p>
                    <?php if ($user['is_admin']): ?>
                        <span class="inline-flex items-center gap-1.5 mt-1 px-2.5 py-1 rounded-lg border text-xs font-medium bg-zinc-900 text-white border-zinc-900">
                            <i class="fa-solid fa-shield-halved text-xs"></i>
                            Admin
                        </span>
                    <?php else: ?>
                        <span class="inline-flex items-center gap-1.5 mt-1 px-2.5 py-1 rounded-lg border text-xs font-medium bg-zinc-100 text-zinc-600 border-zinc-300">
                            <i class="fa-regular fa-user text-xs"></i>
                            Customer
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Details -->
            <div class="flex flex-col gap-3 text-sm">
                <div class="flex items-start gap-2.5">
                    <i class="fa-regular fa-envelope text-zinc-400 mt-0.5 w-4 shrink-0"></i>
                    <span class="text-zinc-700 break-all"><?= htmlspecialchars($user['email']) ?></span>
                </div>
                <div class="flex items-start gap-2.5">
                    <i class="fa-regular fa-calendar text-zinc-400 mt-0.5 w-4 shrink-0"></i>
                    <span class="text-zinc-700">Joined <?= date('M d, Y', strtotime($user['created_at'])) ?></span>
                </div>
            </div>

        </div>

        <!-- Actions card -->
        <div class="bg-white border border-zinc-300 rounded-[10px] p-6 flex flex-col gap-5 flex-1 w-full">
            <h2 class="text-sm font-semibold uppercase text-zinc-500 pb-4 border-b border-zinc-200">Actions</h2>

            <?php if ((int) $user['id'] !== (int) $_SESSION['user']['id']): ?>

                <div class="flex flex-col gap-2">
                    <p class="text-sm font-medium text-zinc-700">Admin Access</p>
                    <p class="text-sm text-zinc-500">
                        <?= $user['is_admin']
                            ? 'This user currently has admin privileges. Revoking will remove their access to the admin panel.'
                            : 'This user is a regular customer. Granting admin access will allow them to manage the store.' ?>
                    </p>
                    <form action="/admin/users/<?= $user['id'] ?>/toggle-admin" method="POST" class="mt-1">
                        <button type="submit" class="py-1.25 px-2.5 border text-sm rounded-[10px] duration-200 ease-in-out flex items-center gap-1 cursor-pointer
                            <?= $user['is_admin']
                                ? 'border-zinc-300 text-zinc-700 hover:bg-zinc-100'
                                : 'border-zinc-900 bg-zinc-900 text-white hover:bg-zinc-700 hover:border-zinc-700' ?>">
                            <?php if ($user['is_admin']): ?>
                                <i class="fa-solid fa-shield-halved"></i>
                                Revoke Admin
                            <?php else: ?>
                                <i class="fa-solid fa-shield-halved"></i>
                                Make Admin
                            <?php endif; ?>
                        </button>
                    </form>
                </div>

                <div class="flex flex-col gap-2 pt-5 border-t border-zinc-200">
                    <p class="text-sm font-medium text-zinc-700">Danger Zone</p>
                    <p class="text-sm text-zinc-500">Permanently delete this user account. This action cannot be undone.</p>
                    <form action="/admin/users/<?= $user['id'] ?>" method="POST"
                        onsubmit="return confirm('Delete this user? This cannot be undone.')" class="mt-1">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="py-1.25 px-2.5 border text-sm border-red-200 bg-red-50 text-red-600 hover:bg-red-100 rounded-[10px] duration-200 ease-in-out flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-trash-can"></i>
                            Delete User
                        </button>
                    </form>
                </div>

            <?php else: ?>
                <div class="flex items-center gap-2.5 px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-[10px] text-sm text-zinc-500">
                    <i class="fa-regular fa-circle-user text-zinc-400"></i>
                    <em>This is your own account. You cannot modify it from here.</em>
                </div>
            <?php endif; ?>

        </div>

    </div>

</div>

<?= end_layout('admin'); ?>