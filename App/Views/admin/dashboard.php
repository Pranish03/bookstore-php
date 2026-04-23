<?= start_layout(); ?>

<div class="flex flex-col gap-6">

    <div>
        <h1 class="text-2xl font-bold font-serif text-zinc-900">Dashboard</h1>
        <p class="text-sm text-zinc-500 mt-1">Welcome back, <?= htmlspecialchars($_SESSION['user']['name'] ?? 'Admin') ?></p>
    </div>

    <!-- Summary cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-white border border-zinc-300 rounded-[10px] px-5 py-4 flex flex-col gap-2">
            <div class="flex items-center justify-between">
                <p class="text-xs uppercase font-semibold text-zinc-500">Total Books</p>
                <span class="w-8 h-8 rounded-[10px] bg-zinc-100 flex items-center justify-center text-zinc-500 text-sm shrink-0">
                    <i class="fa-solid fa-book"></i>
                </span>
            </div>
            <p class="text-2xl font-bold font-serif text-zinc-900"><?= $totalBooks ?></p>
        </div>

        <div class="bg-white border border-zinc-300 rounded-[10px] px-5 py-4 flex flex-col gap-2">
            <div class="flex items-center justify-between">
                <p class="text-xs uppercase font-semibold text-zinc-500">Total Users</p>
                <span class="w-8 h-8 rounded-[10px] bg-zinc-100 flex items-center justify-center text-zinc-500 text-sm shrink-0">
                    <i class="fa-solid fa-users"></i>
                </span>
            </div>
            <p class="text-2xl font-bold font-serif text-zinc-900"><?= $totalUsers ?></p>
        </div>

        <div class="bg-white border border-zinc-300 rounded-[10px] px-5 py-4 flex flex-col gap-2">
            <div class="flex items-center justify-between">
                <p class="text-xs uppercase font-semibold text-zinc-500">Total Orders</p>
                <span class="w-8 h-8 rounded-[10px] bg-zinc-100 flex items-center justify-center text-zinc-500 text-sm shrink-0">
                    <i class="fa-solid fa-box-open"></i>
                </span>
            </div>
            <p class="text-2xl font-bold font-serif text-zinc-900"><?= $totalOrders ?></p>
        </div>

        <div class="bg-white border border-zinc-300 rounded-[10px] px-5 py-4 flex flex-col gap-2">
            <div class="flex items-center justify-between">
                <p class="text-xs uppercase font-semibold text-zinc-500">Total Revenue</p>
                <span class="w-8 h-8 rounded-[10px] bg-zinc-100 flex items-center justify-center text-zinc-500 text-sm shrink-0">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </span>
            </div>
            <p class="text-2xl font-bold font-serif text-zinc-900">Rs. <?= number_format($totalRevenue, 2) ?></p>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Orders by Status -->
        <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-4">
            <h2 class="text-sm font-semibold uppercase text-zinc-500">Orders by Status</h2>
            <?php
            $statusStyles = [
                'pending'    => 'bg-zinc-100 text-zinc-600 border-zinc-300',
                'processing' => 'bg-blue-50 text-blue-600 border-blue-200',
                'shipped'    => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                'delivered'  => 'bg-green-50 text-green-700 border-green-200',
                'cancelled'  => 'bg-red-50 text-red-600 border-red-200',
            ];
            $dotStyles = [
                'pending'    => 'bg-zinc-400',
                'processing' => 'bg-blue-500',
                'shipped'    => 'bg-yellow-500',
                'delivered'  => 'bg-green-500',
                'cancelled'  => 'bg-red-400',
            ];
            ?>
            <?php if (empty($ordersByStatus)): ?>
                <p class="text-sm text-zinc-400">No orders yet.</p>
            <?php else: ?>
                <div class="flex flex-col gap-2">
                    <?php foreach ($ordersByStatus as $row):
                        $style = $statusStyles[$row['status']] ?? 'bg-zinc-100 text-zinc-600 border-zinc-300';
                        $dot   = $dotStyles[$row['status']]   ?? 'bg-zinc-400';
                    ?>
                        <div class="flex items-center justify-between py-2 border-b border-zinc-100 last:border-b-0">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-medium <?= $style ?>">
                                <span class="w-1.5 h-1.5 rounded-full <?= $dot ?>"></span>
                                <?= ucfirst($row['status']) ?>
                            </span>
                            <span class="text-sm font-semibold text-zinc-900"><?= $row['count'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-4 lg:col-span-2">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold uppercase text-zinc-500">Recent Orders</h2>
                <a href="/admin/orders" class="py-1.25 px-2.5 border text-sm border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out text-zinc-600">
                    View all
                </a>
            </div>

            <?php if (empty($recentOrders)): ?>
                <p class="text-sm text-zinc-400">No orders yet.</p>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-zinc-200">
                                <th class="text-left text-xs font-semibold uppercase text-zinc-500 pb-3 pr-4">#</th>
                                <th class="text-left text-xs font-semibold uppercase text-zinc-500 pb-3 pr-4">Customer</th>
                                <th class="text-left text-xs font-semibold uppercase text-zinc-500 pb-3 pr-4">Total</th>
                                <th class="text-left text-xs font-semibold uppercase text-zinc-500 pb-3 pr-4">Status</th>
                                <th class="text-left text-xs font-semibold uppercase text-zinc-500 pb-3 pr-4">Date</th>
                                <th class="pb-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentOrders as $order):
                                $style = $statusStyles[$order['status']] ?? 'bg-zinc-100 text-zinc-600 border-zinc-300';
                                $dot   = $dotStyles[$order['status']]   ?? 'bg-zinc-400';
                            ?>
                                <tr class="border-b border-zinc-100 last:border-b-0">
                                    <td class="py-3 pr-4 font-medium text-zinc-900">#<?= $order['id'] ?></td>
                                    <td class="py-3 pr-4 text-zinc-700 max-w-32 truncate"><?= htmlspecialchars($order['customer_name']) ?></td>
                                    <td class="py-3 pr-4 text-zinc-700 whitespace-nowrap">Rs. <?= number_format($order['total'], 2) ?></td>
                                    <td class="py-3 pr-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-medium <?= $style ?>">
                                            <span class="w-1.5 h-1.5 rounded-full <?= $dot ?>"></span>
                                            <?= ucfirst($order['status']) ?>
                                        </span>
                                    </td>
                                    <td class="py-3 pr-4 text-zinc-500 whitespace-nowrap"><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                                    <td class="py-3">
                                        <a href="/admin/orders/<?= $order['id'] ?>" class="py-1.25 px-2.5 border text-sm border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out text-zinc-600 whitespace-nowrap">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Recent Users -->
    <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-semibold uppercase text-zinc-500">Recent Users</h2>
            <a href="/admin/users" class="py-1.25 px-2.5 border text-sm border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out text-zinc-600">
                View all
            </a>
        </div>

        <?php if (empty($recentUsers)): ?>
            <p class="text-sm text-zinc-400">No users yet.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-zinc-200">
                            <th class="text-left text-xs font-semibold uppercase text-zinc-500 pb-3 pr-4">#</th>
                            <th class="text-left text-xs font-semibold uppercase text-zinc-500 pb-3 pr-4">Name</th>
                            <th class="text-left text-xs font-semibold uppercase text-zinc-500 pb-3 pr-4">Email</th>
                            <th class="text-left text-xs font-semibold uppercase text-zinc-500 pb-3 pr-4">Joined</th>
                            <th class="pb-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentUsers as $user): ?>
                            <tr class="border-b border-zinc-100 last:border-b-0">
                                <td class="py-3 pr-4 font-medium text-zinc-900"><?= $user['id'] ?></td>
                                <td class="py-3 pr-4 text-zinc-700"><?= htmlspecialchars($user['name']) ?></td>
                                <td class="py-3 pr-4 text-zinc-500"><?= htmlspecialchars($user['email']) ?></td>
                                <td class="py-3 pr-4 text-zinc-500 whitespace-nowrap"><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                                <td class="py-3">
                                    <a href="/admin/users/<?= $user['id'] ?>" class="py-1.25 px-2.5 border text-sm border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out text-zinc-600 whitespace-nowrap">
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</div>

<?= end_layout('admin'); ?>