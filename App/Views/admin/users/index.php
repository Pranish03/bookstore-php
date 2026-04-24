<?= start_layout(); ?>

<div class="flex flex-col gap-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold font-serif text-zinc-900">Users</h1>
            <p class="text-sm text-zinc-500 mt-1">Manage your registered users</p>
        </div>
    </div>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="px-4 py-3 bg-zinc-100 border border-zinc-300 rounded-[10px] text-sm text-zinc-700 flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-green-600"></i>
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div class="flex items-center gap-3">
        <form action="/admin/users" method="GET" class="flex items-center gap-2 flex-1 max-w-xs">
            <div class="relative flex-1">
                <span class="absolute left-2.5 top-1/2 -translate-y-1/2 text-zinc-400 text-sm">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input
                    type="text"
                    name="q"
                    placeholder="Search by name or email"
                    value="<?= htmlspecialchars($query) ?>"
                    class="w-full py-1.25 pl-8 pr-2.5 border bg-white border-zinc-300 rounded-[10px] text-sm outline-none focus:border-zinc-900 focus:ring-3 focus:ring-zinc-300 duration-200">
            </div>
            <button type="submit" hidden>
            </button>
        </form>
        <?php if ($query): ?>
            <a href="/admin/users" class="py-1.25 px-2.5 border text-sm border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out text-zinc-600 flex items-center gap-1 shrink-0">
                <i class="fa-solid fa-xmark"></i>
                Clear
            </a>
        <?php endif; ?>
    </div>

    <?php if ($query): ?>
        <p class="text-sm text-zinc-500 -mt-3">
            <?= count($users) ?> result<?= count($users) !== 1 ? 's' : '' ?> for "<span class="text-zinc-700 font-medium"><?= htmlspecialchars($query) ?></span>"
        </p>
    <?php endif; ?>

    <div class="bg-white border border-zinc-300 rounded-[10px] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-200">
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">SN</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">User</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Name</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Email</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Role</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Joined</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-sm text-zinc-400">
                                <i class="fa-solid fa-users text-3xl mb-3 block"></i>
                                <p>No users found.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $i => $user): ?>
                            <tr class="border-b border-zinc-100 last:border-b-0 hover:bg-zinc-50 duration-200">
                                <td class="px-5 py-3.5 font-medium text-zinc-900"><?= $i + 1 ?></td>
                                <td class="px-5 py-3.5 font-medium text-zinc-900">#<?= $user['id'] ?></td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-2.5">
                                        <?php if ($user['profile']): ?>
                                            <img src="<?= asset($user['profile']) ?>" alt="<?= htmlspecialchars($user['name']) ?>" class="w-8.25 h-8.25 rounded-full object-cover">
                                        <?php else: ?>
                                            <div class="w-8 h-8 rounded-full bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-500 text-sm shrink-0 font-medium">
                                                <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                            </div>
                                        <?php endif; ?>
                                        <span class="text-zinc-900 font-medium"><?= htmlspecialchars($user['name']) ?></span>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-zinc-500"><?= htmlspecialchars($user['email']) ?></td>
                                <td class="px-5 py-3.5">
                                    <?php if ($user['is_admin']): ?>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-medium bg-zinc-900 text-white border-zinc-900">
                                            <i class="fa-solid fa-shield-halved text-xs"></i>
                                            Admin
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-medium bg-zinc-100 text-zinc-600 border-zinc-300">
                                            <i class="fa-regular fa-user text-xs"></i>
                                            Customer
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-3.5 text-zinc-500 whitespace-nowrap"><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                                <td class="px-5 py-3.5">
                                    <a href="/admin/users/<?= $user['id'] ?>" class="py-1.25 px-2.5 border text-sm border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out text-zinc-600 whitespace-nowrap">
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= end_layout('admin'); ?>