<?= start_layout(); ?>

<div class="bg-zinc-50 min-h-screen">
    <div class="max-w-300 mx-auto px-6 py-10 md:py-16">

        <div class="mb-8">
            <a href="/" class="text-sm text-zinc-500 hover:text-zinc-900 duration-200 ease-in-out flex items-center gap-1.5 w-min whitespace-nowrap">
                <i class="fa-solid fa-arrow-left-long text-xs"></i>
                Back to books
            </a>
        </div>

        <h1 class="text-3xl font-bold font-serif mb-8">Your Cart</h1>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="mb-6 px-4 py-3 bg-zinc-100 border border-zinc-300 rounded-[10px] text-sm text-zinc-700 flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-green-600"></i>
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (empty($items)): ?>
            <div class="bg-white border border-zinc-300 rounded-[10px] flex flex-col items-center justify-center py-24 gap-4 text-zinc-400">
                <i class="fa-solid fa-bag-shopping text-5xl"></i>
                <p class="text-base text-zinc-500">Your cart is empty.</p>
                <a href="/" class="py-1.25 px-2.5 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out">
                    Browse Books
                </a>
            </div>

        <?php else: ?>
            <div class="flex flex-col lg:flex-row gap-8 items-start">

                <div class="flex-1 w-full flex flex-col gap-3">

                    <div class="hidden md:grid grid-cols-12 gap-4 px-4 py-2 text-xs uppercase font-semibold text-zinc-500">
                        <div class="col-span-4">Book</div>
                        <div class="col-span-2 text-right">Price</div>
                        <div class="col-span-3 text-center">Quantity</div>
                        <div class="col-span-2 text-right">Subtotal</div>
                        <div class="col-span-1"></div>
                    </div>

                    <?php foreach ($items as $item):
                        $discounted = $item['price'] - ($item['price'] * $item['discount'] / 100);
                        $subtotal   = $discounted * $item['quantity'];
                    ?>
                        <div class="bg-white border border-zinc-300 rounded-[10px] px-4 py-4">
                            <div class="flex gap-4 md:hidden">
                                <img src="/<?= htmlspecialchars($item['image']) ?>"
                                    alt="<?= htmlspecialchars($item['title']) ?>"
                                    class="w-16 h-20 object-cover rounded-lg border border-zinc-200 shrink-0">
                                <div class="flex-1 flex flex-col gap-2">
                                    <p class="font-medium text-base text-zinc-900 leading-tight"><?= htmlspecialchars($item['title']) ?></p>
                                    <p class="text-sm text-zinc-500"><?= htmlspecialchars($item['author']) ?></p>
                                    <p class="text-sm font-semibold">Rs. <?= number_format($discounted, 2) ?></p>
                                    <div class="flex items-center justify-between gap-3 mt-1">
                                        <form action="/cart/update" method="POST" class="flex items-center gap-2">
                                            <input type="hidden" name="cart_item_id" value="<?= $item['id'] ?>">
                                            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1"
                                                class="w-16 py-1 px-2 border border-zinc-300 rounded-[10px] text-sm text-center outline-none focus:border-zinc-900 focus:ring-3 focus:ring-zinc-300">
                                            <button type="submit" class="py-1 px-2.5 border border-zinc-300 hover:bg-zinc-100 rounded-[10px] text-sm duration-200 ease-in-out cursor-pointer">
                                                Update
                                            </button>
                                        </form>
                                        <form action="/cart/remove" method="POST">
                                            <input type="hidden" name="cart_item_id" value="<?= $item['id'] ?>">
                                            <button type="submit" class="py-1 px-2.5 border border-zinc-300 hover:bg-red-100 hover:border-red-200 text-zinc-500 hover:text-red-600 rounded-[10px] text-sm duration-200 ease-in-out cursor-pointer">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="hidden md:grid grid-cols-12 gap-4 items-center">
                                <div class="col-span-4 flex items-center gap-3">
                                    <img src="/<?= htmlspecialchars($item['image']) ?>"
                                        alt="<?= htmlspecialchars($item['title']) ?>"
                                        class="w-12 h-16 object-cover rounded-lg border border-zinc-200 shrink-0">
                                    <div>
                                        <p class="font-medium text-base text-zinc-900 leading-tight max-w-36 overflow-hidden text-ellipsis whitespace-nowrap"><?= htmlspecialchars($item['title']) ?></p>
                                        <p class="text-sm text-zinc-500"><?= htmlspecialchars($item['author']) ?></p>
                                    </div>
                                </div>
                                <div class="col-span-2 text-right text-sm font-medium">
                                    Rs. <?= number_format($discounted, 2) ?>
                                </div>
                                <div class="col-span-3 flex items-center justify-center">
                                    <form action="/cart/update" method="POST" class="flex items-center gap-2">
                                        <input type="hidden" name="cart_item_id" value="<?= $item['id'] ?>">
                                        <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1"
                                            class="w-16 py-1 px-2 border border-zinc-300 rounded-[10px] text-sm text-center outline-none focus:border-zinc-900 focus:ring-3 focus:ring-zinc-300">
                                        <button type="submit" class="py-1 px-2.5 border border-zinc-300 hover:bg-zinc-100 rounded-[10px] text-sm duration-200 ease-in-out cursor-pointer">
                                            Update
                                        </button>
                                    </form>
                                </div>
                                <div class="col-span-2 text-right text-sm font-semibold whitespace-nowrap">
                                    Rs. <?= number_format($subtotal, 2) ?>
                                </div>
                                <div class="col-span-1 flex justify-end">
                                    <form action="/cart/remove" method="POST">
                                        <input type="hidden" name="cart_item_id" value="<?= $item['id'] ?>">
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center border border-zinc-300 hover:bg-red-100 hover:border-red-200 text-zinc-400 hover:text-red-600 rounded-[10px] text-sm duration-200 ease-in-out cursor-pointer">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="w-full lg:w-80 shrink-0">
                    <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-4 sticky top-24">
                        <h2 class="text-base font-semibold text-zinc-900 pb-4 border-b border-zinc-200">Order Summary</h2>

                        <div class="flex items-center justify-between text-sm text-zinc-600">
                            <span>Subtotal</span>
                            <span>Rs. <?= number_format($total, 2) ?></span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-zinc-600">
                            <span>Shipping</span>
                            <span class="text-green-600 font-medium">Free</span>
                        </div>

                        <div class="flex items-center justify-between text-base font-semibold text-zinc-900 pt-4 border-t border-zinc-200">
                            <span>Total</span>
                            <span>Rs. <?= number_format($total, 2) ?></span>
                        </div>

                        <a href="/checkout" class="py-1.25 px-2.5 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out text-center flex items-center justify-center gap-1">
                            Proceed to Checkout
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </a>

                        <a href="/" class="text-sm text-zinc-500 hover:text-zinc-900 duration-200 ease-in-out text-center">
                            Continue Shopping
                        </a>
                    </div>
                </div>

            </div>
        <?php endif; ?>
    </div>
</div>

<?= end_layout('app'); ?>