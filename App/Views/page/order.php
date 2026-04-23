<?= start_layout(); ?>

<div class="bg-zinc-50 min-h-screen">
    <div class="max-w-300 mx-auto px-6 py-10 md:py-16">

        <div class="mb-8">
            <a href="/orders" class="text-sm text-zinc-500 hover:text-zinc-900 duration-200 ease-in-out flex items-center gap-1.5 w-min whitespace-nowrap">
                <i class="fa-solid fa-arrow-left-long text-xs"></i>
                Back to orders
            </a>
        </div>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="mb-6 px-4 py-3 bg-zinc-100 border border-zinc-300 rounded-[10px] text-sm text-zinc-700 flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-green-600"></i>
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 rounded-[10px] text-sm text-red-600 flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
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
        $style = $statusStyles[$order['status']] ?? 'bg-zinc-100 text-zinc-600 border-zinc-300';
        $dot   = $dotStyles[$order['status']]   ?? 'bg-zinc-400';
        ?>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-3 flex-wrap">
                    <h1 class="text-3xl font-bold font-serif">Order #<?= $order['id'] ?></h1>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-medium <?= $style ?>">
                        <span class="w-1.5 h-1.5 rounded-full <?= $dot ?>"></span>
                        <?= ucfirst($order['status']) ?>
                    </span>
                </div>
                <p class="text-sm text-zinc-500 mt-1">Placed on <?= date('M d, Y', strtotime($order['created_at'])) ?></p>
            </div>

            <?php if ($order['status'] === 'pending'): ?>
                <form action="/orders/<?= $order['id'] ?>/cancel" method="POST"
                    onsubmit="return confirm('Are you sure you want to cancel this order?')">
                    <button type="submit"
                        class="py-1.25 px-2.5 border text-base border-zinc-300 hover:bg-red-100 hover:border-red-200 hover:text-red-600 text-zinc-600 rounded-[10px] duration-200 ease-in-out cursor-pointer flex items-center gap-2">
                        <i class="fa-solid fa-xmark text-sm"></i>
                        Cancel Order
                    </button>
                </form>
            <?php endif; ?>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <div class="flex-1 w-full flex flex-col gap-3">
                <h2 class="text-sm font-semibold uppercase text-zinc-500 mb-1">Items Ordered</h2>

                <div class="hidden md:grid grid-cols-12 gap-4 px-4 py-2 text-xs uppercase font-semibold text-zinc-500">
                    <div class="col-span-6">Book</div>
                    <div class="col-span-2 text-center">Qty</div>
                    <div class="col-span-2 text-right">Price</div>
                    <div class="col-span-2 text-right">Subtotal</div>
                </div>

                <?php foreach ($order['items'] as $item):
                    $discounted = $item['price'] - ($item['price'] * $item['discount'] / 100);
                ?>

                    <div class="hidden md:grid grid-cols-12 gap-4 bg-white border border-zinc-300 rounded-[10px] px-4 py-4 items-center">
                        <div class="col-span-6 flex items-center gap-3">
                            <img src="/<?= htmlspecialchars($item['image']) ?>"
                                alt="<?= htmlspecialchars($item['title']) ?>"
                                class="w-12 h-16 object-cover rounded-lg border border-zinc-200 shrink-0">
                            <div>
                                <p class="font-medium text-base text-zinc-900 leading-tight"><?= htmlspecialchars($item['title']) ?></p>
                                <p class="text-sm text-zinc-500"><?= htmlspecialchars($item['author']) ?></p>
                            </div>
                        </div>
                        <div class="col-span-2 text-center">
                            <span class="text-sm text-zinc-700"><?= $item['quantity'] ?></span>
                        </div>
                        <div class="col-span-2 text-right">
                            <span class="text-sm text-zinc-700">Rs. <?= number_format($discounted, 2) ?></span>
                        </div>
                        <div class="col-span-2 text-right">
                            <span class="text-sm font-semibold text-zinc-900">Rs. <?= number_format($discounted * $item['quantity'], 2) ?></span>
                        </div>
                    </div>

                    <div class="md:hidden bg-white border border-zinc-300 rounded-[10px] p-4 flex items-center gap-3">
                        <img src="/<?= htmlspecialchars($item['image']) ?>"
                            alt="<?= htmlspecialchars($item['title']) ?>"
                            class="w-14 h-20 object-cover rounded-lg border border-zinc-200 shrink-0">
                        <div class="flex-1 flex flex-col gap-1">
                            <p class="font-medium text-base text-zinc-900 leading-tight"><?= htmlspecialchars($item['title']) ?></p>
                            <p class="text-sm text-zinc-500"><?= htmlspecialchars($item['author']) ?></p>
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-xs text-zinc-500">Qty: <?= $item['quantity'] ?> × Rs. <?= number_format($discounted, 2) ?></span>
                                <span class="text-sm font-semibold text-zinc-900">Rs. <?= number_format($discounted * $item['quantity'], 2) ?></span>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>

            <div class="w-full lg:w-80 shrink-0 flex flex-col gap-4">

                <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-3">
                    <h2 class="text-base font-semibold text-zinc-900 pb-3 border-b border-zinc-200">Order Summary</h2>
                    <div class="flex items-center justify-between text-sm text-zinc-600">
                        <span>Subtotal</span>
                        <span>Rs. <?= number_format($order['total'], 2) ?></span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-zinc-600">
                        <span>Shipping</span>
                        <span class="text-green-600 font-medium">Free</span>
                    </div>
                    <div class="flex items-center justify-between text-base font-semibold text-zinc-900 pt-3 border-t border-zinc-200">
                        <span>Total</span>
                        <span>Rs. <?= number_format($order['total'], 2) ?></span>
                    </div>
                </div>

                <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-3">
                    <h2 class="text-base font-semibold text-zinc-900 pb-3 border-b border-zinc-200 flex items-center gap-2">
                        <i class="fa-solid fa-truck text-zinc-400"></i>
                        Delivery Details
                    </h2>
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

                <div class="flex items-start gap-2.5 bg-white border border-zinc-200 rounded-[10px] px-4 py-3">
                    <i class="fa-solid fa-money-bill-wave text-zinc-400 mt-0.5 text-sm shrink-0"></i>
                    <p class="text-xs text-zinc-500 leading-relaxed">Payment is collected at the time of delivery. Please have the exact amount ready.</p>
                </div>

            </div>
        </div>
    </div>
</div>

<?= end_layout('app'); ?>