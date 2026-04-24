<?= start_layout(); ?>

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
$style = $statusStyles[$order['status']] ?? 'bg-zinc-100 text-zinc-600 border-zinc-300';
$dot   = $dotStyles[$order['status']]   ?? 'bg-zinc-400';
?>

<div class="flex flex-col gap-6">

    <div>
        <a href="/admin/orders" class="text-sm text-zinc-500 hover:text-zinc-900 duration-200 ease-in-out flex items-center gap-1.5 w-min whitespace-nowrap mb-4">
            <i class="fa-solid fa-arrow-left-long text-xs"></i>
            Back to orders
        </a>
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
            <h1 class="text-2xl font-bold font-serif text-zinc-900">Order #<?= $order['id'] ?></h1>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-medium w-min whitespace-nowrap <?= $style ?>">
                <span class="w-1.5 h-1.5 rounded-full <?= $dot ?>"></span>
                <?= ucfirst($order['status']) ?>
            </span>
        </div>
        <p class="text-sm text-zinc-500 mt-1">Placed on <?= date('M d, Y', strtotime($order['created_at'])) ?></p>
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

        <div class="flex-1 w-full flex flex-col gap-4">

            <div class="bg-white border border-zinc-300 rounded-[10px] overflow-hidden">
                <div class="px-5 py-4 border-b border-zinc-200">
                    <h2 class="text-sm font-semibold uppercase text-zinc-500">Items Ordered</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-zinc-200">
                                <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Book</th>
                                <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Unit Price</th>
                                <th class="text-left text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Qty</th>
                                <th class="text-right text-xs font-semibold uppercase text-zinc-500 px-5 py-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order['items'] as $item):
                                $discounted = $item['price'] - ($item['price'] * $item['discount'] / 100);
                            ?>
                                <tr class="border-b border-zinc-100 last:border-b-0">
                                    <td class="px-5 py-3.5">
                                        <div class="flex items-center gap-3">
                                            <img src="/<?= htmlspecialchars($item['image']) ?>"
                                                alt="<?= htmlspecialchars($item['title']) ?>"
                                                class="w-8.25 h-10.25 object-cover rounded-[10px] border border-zinc-200 shrink-0">
                                            <div>
                                                <p class="font-medium text-zinc-900"><?= htmlspecialchars($item['title']) ?></p>
                                                <p class="text-xs text-zinc-500"><?= htmlspecialchars($item['author']) ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-3.5 text-zinc-700 whitespace-nowrap">
                                        Rs. <?= number_format($discounted, 2) ?>
                                    </td>
                                    <td class="px-5 py-3.5 text-zinc-700">
                                        <?= $item['quantity'] ?>
                                    </td>
                                    <td class="px-5 py-3.5 text-right font-semibold text-zinc-900 whitespace-nowrap">
                                        Rs. <?= number_format($discounted * $item['quantity'], 2) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="border-t border-zinc-200 bg-zinc-50">
                                <td colspan="3" class="px-5 py-3.5 text-sm font-semibold text-zinc-700">Total</td>
                                <td class="px-5 py-3.5 text-right font-bold text-zinc-900 whitespace-nowrap">
                                    Rs. <?= number_format($order['total'], 2) ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

        <div class="w-full lg:w-80 shrink-0 flex flex-col gap-4">
            <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-4">
                <h2 class="text-sm font-semibold uppercase text-zinc-500 pb-4 border-b border-zinc-200">Customer</h2>
                <div class="flex flex-col gap-2.5 text-sm">
                    <div class="flex items-start gap-2.5">
                        <i class="fa-regular fa-user text-zinc-400 mt-0.5 w-4 shrink-0"></i>
                        <span class="text-zinc-900 font-medium"><?= htmlspecialchars($order['customer_name']) ?></span>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <i class="fa-regular fa-envelope text-zinc-400 mt-0.5 w-4 shrink-0"></i>
                        <span class="text-zinc-600 break-all"><?= htmlspecialchars($order['customer_email']) ?></span>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-4">
                <h2 class="text-sm font-semibold uppercase text-zinc-500 pb-4 border-b border-zinc-200">Delivery Details</h2>
                <div class="flex flex-col gap-2.5 text-sm">
                    <div class="flex items-start gap-2.5">
                        <i class="fa-regular fa-user text-zinc-400 mt-0.5 w-4 shrink-0"></i>
                        <span class="text-zinc-700"><?= htmlspecialchars($order['name']) ?></span>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <i class="fa-solid fa-phone text-zinc-400 mt-0.5 w-4 shrink-0"></i>
                        <span class="text-zinc-700"><?= htmlspecialchars($order['phone']) ?></span>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <i class="fa-solid fa-location-dot text-zinc-400 mt-0.5 w-4 shrink-0"></i>
                        <span class="text-zinc-700"><?= htmlspecialchars($order['address']) ?></span>
                    </div>
                    <?php if (!empty($order['note'])): ?>
                        <div class="flex items-start gap-2.5">
                            <i class="fa-regular fa-note-sticky text-zinc-400 mt-0.5 w-4 shrink-0"></i>
                            <span class="text-zinc-500 italic"><?= htmlspecialchars($order['note']) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-4">
                <h2 class="text-sm font-semibold uppercase text-zinc-500 pb-4 border-b border-zinc-200">Update Status</h2>
                <form action="/admin/orders/<?= $order['id'] ?>/status" method="POST" class="flex flex-col gap-3">
                    <div class="relative flex items-center">

                        <select name="status" class="py-1.25 px-2.5 z-10 appearance-none border border-zinc-300 rounded-[10px] text-sm text-zinc-700 outline-none focus:border-zinc-900 focus:ring-3 focus:ring-zinc-300 duration-200 bg-transparent w-full">
                            <?php foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status): ?>
                                <option value="<?= $status ?>" <?= $order['status'] === $status ? 'selected' : '' ?>>
                                    <?= ucfirst($status) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <span class="absolute right-3 text-xs">
                            <i class="fa-solid fa-chevron-down"></i>
                        </span>
                    </div>
                    <button type="submit" class="py-1.25 px-2.5 border text-sm border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out flex items-center justify-center gap-1 cursor-pointer w-full">
                        <i class="fa-solid fa-arrow-rotate-right"></i>
                        Update Status
                    </button>
                </form>
            </div>

        </div>
    </div>

</div>

<?= end_layout('admin'); ?>