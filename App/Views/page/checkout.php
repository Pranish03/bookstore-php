<?= start_layout(); ?>

<?php
$errors = $_SESSION['errors']    ?? [];
$old    = $_SESSION['old_input'] ?? [];
unset($_SESSION['errors'], $_SESSION['old_input']);
?>

<div class="bg-zinc-50 min-h-screen">
    <div class="max-w-300 mx-auto px-6 py-10 md:py-16">

        <div class="mb-8">
            <a href="/cart" class="text-sm text-zinc-500 hover:text-zinc-900 duration-200 ease-in-out flex items-center gap-1.5 w-min whitespace-nowrap">
                <i class="fa-solid fa-arrow-left-long text-xs"></i>
                Back to cart
            </a>
        </div>

        <h1 class="text-3xl font-bold font-serif mb-8">Checkout</h1>

        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <div class="flex-1 w-full">
                <div class="bg-white border border-zinc-300 rounded-[10px] p-6">
                    <h2 class="text-base font-semibold text-zinc-900 pb-4 mb-5 border-b border-zinc-200 flex items-center gap-2">
                        <i class="fa-solid fa-truck text-zinc-400"></i>
                        Delivery Details
                    </h2>

                    <form action="/checkout" method="POST" class="flex flex-col gap-5">

                        <div class="flex flex-col gap-1.5">
                            <label for="name" class="text-sm font-medium text-zinc-700">Full Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="<?= htmlspecialchars($old['name'] ?? $_SESSION['user']['name']) ?>"
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
                            <label for="phone" class="text-sm font-medium text-zinc-700">Phone Number</label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="<?= htmlspecialchars($old['phone'] ?? '') ?>"
                                placeholder="e.g. 98XXXXXXXX"
                                class="py-1.25 px-2.5 border <?= !empty($errors['phone']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-base outline-none focus:ring-3 duration-200">
                            <?php if (!empty($errors['phone'])): ?>
                                <span class="text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                    <?= htmlspecialchars($errors['phone']) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="address" class="text-sm font-medium text-zinc-700">Delivery Address</label>
                            <textarea
                                id="address"
                                name="address"
                                rows="3"
                                placeholder="Street, City, District..."
                                class="py-1.25 px-2.5 border <?= !empty($errors['address']) ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-300' ?> rounded-[10px] text-base outline-none focus:ring-3 duration-200 resize-none"><?= htmlspecialchars($old['address'] ?? '') ?></textarea>
                            <?php if (!empty($errors['address'])): ?>
                                <span class="text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                    <?= htmlspecialchars($errors['address']) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="note" class="text-sm font-medium text-zinc-700">
                                Order Note
                                <span class="text-zinc-400 font-normal">(optional)</span>
                            </label>
                            <textarea
                                id="note"
                                name="note"
                                rows="2"
                                placeholder="Any special instructions for your order..."
                                class="py-1.25 px-2.5 border border-zinc-300 rounded-[10px] text-base outline-none focus:border-zinc-900 focus:ring-3 focus:ring-zinc-300 duration-200 resize-none"><?= htmlspecialchars($old['note'] ?? '') ?></textarea>
                        </div>

                        <div class="lg:hidden pt-2">
                            <button type="submit" class="w-full py-2.5 px-5 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out flex items-center justify-center gap-2 cursor-pointer">
                                <i class="fa-solid fa-money-bill-wave"></i>
                                Place Order (Cash on Delivery)
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="w-full lg:w-96 shrink-0">
                <div class="bg-white border border-zinc-300 rounded-[10px] p-5 flex flex-col gap-4 sticky top-24">
                    <h2 class="text-base font-semibold text-zinc-900 pb-4 border-b border-zinc-200 flex items-center gap-2">
                        <i class="fa-solid fa-bag-shopping text-zinc-400"></i>
                        Order Summary
                    </h2>

                    <div class="flex flex-col gap-3">
                        <?php foreach ($items as $item):
                            $discounted = $item['price'] - ($item['price'] * $item['discount'] / 100);
                        ?>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-zinc-100 border border-zinc-200 flex items-center justify-center shrink-0">
                                    <span class="text-xs font-semibold text-zinc-600"><?= $item['quantity'] ?>×</span>
                                </div>
                                <p class="flex-1 text-sm text-zinc-700 leading-tight"><?= htmlspecialchars($item['title']) ?></p>
                                <p class="text-sm font-medium shrink-0">Rs. <?= number_format($discounted * $item['quantity'], 2) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="flex flex-col gap-2 pt-4 border-t border-zinc-200">
                        <div class="flex items-center justify-between text-sm text-zinc-600">
                            <span>Subtotal</span>
                            <span>Rs. <?= number_format($total, 2) ?></span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-zinc-600">
                            <span>Shipping</span>
                            <span class="text-green-600 font-medium">Free</span>
                        </div>
                        <div class="flex items-center justify-between text-base font-semibold text-zinc-900 pt-3 border-t border-zinc-200">
                            <span>Total</span>
                            <span>Rs. <?= number_format($total, 2) ?></span>
                        </div>
                    </div>

                    <div class="flex items-start gap-2.5 bg-zinc-50 border border-zinc-200 rounded-[10px] px-3 py-2.5">
                        <i class="fa-solid fa-money-bill-wave text-zinc-400 mt-0.5 text-sm"></i>
                        <p class="text-xs text-zinc-500 leading-relaxed">Payment is collected at the time of delivery. Please have the exact amount ready.</p>
                    </div>

                    <button id="desktopCheckoutBtn" type="button"
                        class="hidden lg:flex w-full py-1.5 px-3 border text-base border-zinc-900 bg-zinc-900 text-white rounded-[10px] hover:bg-zinc-700 hover:border-zinc-700 duration-200 ease-in-out items-center justify-center gap-1 cursor-pointer">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        Place Order (Cash on Delivery)
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const desktopBtn = document.getElementById('desktopCheckoutBtn');
        const checkoutForm = document.querySelector('form[action="/checkout"]');
        if (desktopBtn && checkoutForm) {
            desktopBtn.addEventListener('click', function() {
                checkoutForm.submit();
            });
        }
    });
</script>

<?= end_layout('app'); ?>