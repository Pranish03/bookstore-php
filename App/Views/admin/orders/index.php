<?= start_layout(); ?>

<div class="flex flex-col gap-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold font-serif text-zinc-900">Orders</h1>
            <p class="text-sm text-zinc-500 mt-1">Manage and track customer orders</p>
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
        <form action="/admin/orders" method="GET" class="flex items-center gap-2 flex-1 max-w-xs">
            <div class="relative flex-1">
                <span class="absolute left-2.5 top-1/2 -translate-y-1/2 text-zinc-400 text-sm">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input
                    type="text"
                    name="q"
                    placeholder="Search by customer, email or status"
                    value="<?= htmlspecialchars($query) ?>"
                    class="w-full py-1.25 pl-8 pr-2.5 border bg-white border-zinc-300 rounded-[10px] text-sm outline-none focus:border-zinc-900 focus:ring-3 focus:ring-zinc-300 duration-200">
            </div>
            <button type="submit" hidden></button>
        </form>
        <?php if ($query): ?>
            <a href="/admin/orders" class="py-1.25 px-2.5 border text-sm border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out text-zinc-600 flex items-center gap-1 shrink-0">
                <i class="fa-solid fa-xmark"></i>
                Clear
            </a>
        <?php endif; ?>
    </div>

    <?php if ($query): ?>
        <p class="text-sm text-zinc-500 -mt-3">
            <?= count($orders) ?> result<?= count($orders) !== 1 ? 's' : '' ?> for "<span class="text-zinc-700 font-medium"><?= htmlspecialchars($query) ?></span>"
        </p>
    <?php endif; ?>

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

    <div class="bg-white border border-zinc-300 rounded-[10px] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-200">
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">SN</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Order</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Customer</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Total</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Status</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Date</th>
                        <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-sm text-zinc-400">
                                <i class="fa-solid fa-box-open text-3xl mb-3 block"></i>
                                <p>No orders found.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $i => $order):
                            $style = $statusStyles[$order['status']] ?? 'bg-zinc-100 text-zinc-600 border-zinc-300';
                            $dot   = $dotStyles[$order['status']]   ?? 'bg-zinc-400';
                        ?>
                            <tr class="border-b border-zinc-100 last:border-b-0 hover:bg-zinc-50 duration-200">
                                <td class="px-5 py-3.5 font-medium text-zinc-900"><?= $i + 1 ?></td>
                                <td class="px-5 py-3.5 font-medium text-zinc-900">#<?= $order['id'] ?></td>
                                <td class="px-5 py-3.5">
                                    <p class="font-medium text-zinc-900"><?= htmlspecialchars($order['customer_name']) ?></p>
                                    <p class="text-xs text-zinc-500"><?= htmlspecialchars($order['customer_email']) ?></p>
                                </td>
                                <td class="px-5 py-3.5 font-medium text-zinc-900 whitespace-nowrap">
                                    Rs. <?= number_format($order['total'], 2) ?>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-medium <?= $style ?>">
                                        <span class="w-1.5 h-1.5 rounded-full <?= $dot ?>"></span>
                                        <?= ucfirst($order['status']) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-zinc-500 whitespace-nowrap">
                                    <?= date('M d, Y', strtotime($order['created_at'])) ?>
                                </td>
                                <td class="px-5 py-3.5">
                                    <a href="/admin/orders/<?= $order['id'] ?>" class="py-1.25 px-2.5 border text-sm border-zinc-300 hover:bg-zinc-100 rounded-[10px] duration-200 ease-in-out text-zinc-600 whitespace-nowrap">
                                        <i class="fa-solid fa-eye"></i>
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