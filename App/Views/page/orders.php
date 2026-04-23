<?= start_layout(); ?>

<div class="bg-zinc-50 min-h-screen">
    <div class="max-w-300 mx-auto px-6 py-10 md:py-16">
        <div class="mb-8">
            <a href="/" class="text-sm text-zinc-500 hover:text-zinc-900 duration-200 ease-in-out flex items-center gap-1.5 w-min whitespace-nowrap">
                <i class="fa-solid fa-arrow-left-long text-xs"></i>
                Back to books
            </a>
        </div>

        <h1 class="text-3xl font-bold font-serif mb-8">My Orders</h1>

        <?php if (empty($orders)): ?>
            <div class="bg-white border border-zinc-300 rounded-[10px] flex flex-col items-center justify-center py-24 gap-4 text-zinc-400">
                <i class="fa-solid fa-box-open text-5xl"></i>
                <p class="text-base text-zinc-500">You have no orders yet.</p>
                <a href="/" class="py-1.25 px-2.5 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out">
                    Browse Books
                </a>
            </div>

        <?php else: ?>
            <div class="hidden md:block bg-white border border-zinc-300 rounded-[10px] overflow-hidden">
                <div class="grid grid-cols-12 gap-4 px-6 py-3 border-b border-zinc-200 text-xs uppercase font-semibold text-zinc-500">
                    <div class="col-span-2">Order #</div>
                    <div class="col-span-3">Total</div>
                    <div class="col-span-3">Status</div>
                    <div class="col-span-2">Date</div>
                    <div class="col-span-2"></div>
                </div>

                <?php foreach ($orders as $order): ?>
                    <div class="grid grid-cols-12 gap-4 px-6 py-4 border-b border-zinc-100 last:border-b-0 items-center hover:bg-zinc-50 duration-200">
                        <div class="col-span-2">
                            <span class="text-sm font-semibold text-zinc-900">#<?= $order['id'] ?></span>
                        </div>
                        <div class="col-span-3">
                            <span class="text-sm font-medium text-zinc-900">Rs. <?= number_format($order['total'], 2) ?></span>
                        </div>
                        <div class="col-span-3">
                            <?php
                            $statusStyles = [
                                'pending'    => 'bg-zinc-100 text-zinc-600 border-zinc-300',
                                'processing' => 'bg-blue-50 text-blue-600 border-blue-200',
                                'shipped'    => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                'delivered'  => 'bg-green-50 text-green-700 border-green-200',
                                'cancelled'  => 'bg-red-50 text-red-600 border-red-200',
                            ];
                            $style = $statusStyles[$order['status']] ?? 'bg-zinc-100 text-zinc-600 border-zinc-300';
                            ?>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-medium <?= $style ?>">
                                <span class="w-1.5 h-1.5 rounded-full
                                    <?= $order['status'] === 'delivered' ? 'bg-green-500' : '' ?>
                                    <?= $order['status'] === 'shipped' ? 'bg-yellow-500' : '' ?>
                                    <?= $order['status'] === 'processing' ? 'bg-blue-500' : '' ?>
                                    <?= $order['status'] === 'pending' ? 'bg-zinc-400' : '' ?>
                                    <?= $order['status'] === 'cancelled' ? 'bg-red-400' : '' ?>
                                "></span>
                                <?= ucfirst($order['status']) ?>
                            </span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-sm text-zinc-500"><?= date('M d, Y', strtotime($order['created_at'])) ?></span>
                        </div>
                        <div class="col-span-2 flex items-center justify-end gap-2">
                            <a href="/orders/<?= $order['id'] ?>"
                                class="py-1 px-2.5 border border-zinc-300 hover:bg-zinc-100 rounded-[10px] text-sm duration-200 ease-in-out">
                                View
                            </a>
                            <?php if ($order['status'] === 'pending'): ?>
                                <form action="/orders/<?= $order['id'] ?>/cancel" method="POST"
                                    onsubmit="return confirm('Cancel this order?')">
                                    <button type="submit"
                                        class="py-1 px-2.5 border border-zinc-300 hover:bg-red-100 hover:border-red-200 hover:text-red-600 text-zinc-500 rounded-[10px] text-sm duration-200 ease-in-out cursor-pointer">
                                        Cancel
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="flex md:hidden flex-col gap-3">
                <?php foreach ($orders as $order):
                    $statusStyles = [
                        'pending'    => 'bg-zinc-100 text-zinc-600 border-zinc-300',
                        'processing' => 'bg-blue-50 text-blue-600 border-blue-200',
                        'shipped'    => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                        'delivered'  => 'bg-green-50 text-green-700 border-green-200',
                        'cancelled'  => 'bg-red-50 text-red-600 border-red-200',
                    ];
                    $style = $statusStyles[$order['status']] ?? 'bg-zinc-100 text-zinc-600 border-zinc-300';
                ?>
                    <div class="bg-white border border-zinc-300 rounded-[10px] p-4 flex flex-col gap-3">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-sm font-semibold text-zinc-900">#<?= $order['id'] ?></p>
                                <p class="text-xs text-zinc-500 mt-0.5"><?= date('M d, Y', strtotime($order['created_at'])) ?></p>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-medium <?= $style ?>">
                                <span class="w-1.5 h-1.5 rounded-full
                                    <?= $order['status'] === 'delivered' ? 'bg-green-500' : '' ?>
                                    <?= $order['status'] === 'shipped' ? 'bg-yellow-500' : '' ?>
                                    <?= $order['status'] === 'processing' ? 'bg-blue-500' : '' ?>
                                    <?= $order['status'] === 'pending' ? 'bg-zinc-400' : '' ?>
                                    <?= $order['status'] === 'cancelled' ? 'bg-red-400' : '' ?>
                                "></span>
                                <?= ucfirst($order['status']) ?>
                            </span>
                        </div>

                        <div class="flex items-center justify-between pt-3 border-t border-zinc-100">
                            <span class="text-base font-semibold text-zinc-900">Rs. <?= number_format($order['total'], 2) ?></span>
                            <div class="flex items-center gap-2">
                                <a href="/orders/<?= $order['id'] ?>"
                                    class="py-1 px-2.5 border border-zinc-300 hover:bg-zinc-100 rounded-[10px] text-sm duration-200 ease-in-out">
                                    View
                                </a>
                                <?php if ($order['status'] === 'pending'): ?>
                                    <form action="/orders/<?= $order['id'] ?>/cancel" method="POST"
                                        onsubmit="return confirm('Cancel this order?')">
                                        <button type="submit"
                                            class="py-1 px-2.5 border border-zinc-300 hover:bg-red-100 hover:border-red-200 hover:text-red-600 text-zinc-500 rounded-[10px] text-sm duration-200 ease-in-out cursor-pointer">
                                            Cancel
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>
    </div>
</div>

<?= end_layout('app'); ?>