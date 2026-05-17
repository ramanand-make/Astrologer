<?php
require_once __DIR__ . '/functions.php';
$conn = getSashDBConnection();
$navbarMenu = getNavbarMenu($conn);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<!-- TOP BAR -->
<div class="topbar">
  <div class="topbar-container">

    <!-- Left / spacer -->
    <div class="topbar-left"></div>

    <!-- Center message -->
    <div class="topbar-center">
      <span class="icon">⬡</span>
      <span class="text">
        Just Launched: New Essentials for Your Spiritual Journey
      </span>
      <a href="#" class="shop-link">
        Shop Now <span class="arrow">↗</span>
      </a>
    </div>

    <!-- Right icon -->
    <div class="topbar-right">
      <a href="#" class="insta-icon">  <i class="fa-brands fa-instagram"></i></a>
    </div>

  </div>
</div>
<header class="main-header">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between py-3">
            
            <!-- Logo -->
            <a href="/" class="text-decoration-none">
                <h1 class="h4 mb-0 fw-bold" style="font-family: 'Playfair Display', serif; color: #1a1a1a;">
                    <!-- <span style="color: #D4AF37;">Astro</span>Rajeev -->
                     <img src="../assets/images/logo/logo-new (1).png" alt="Astrologerrajeev Logo" >
                </h1>
            </a>

            <!-- Desktop Navigation -->
            <!-- Desktop Navigation -->
<nav class="nav-desktop d-none d-lg-flex align-items-center">

    <?php foreach ($navbarMenu as $item): ?>

        <?php if (!empty($item['children'])): ?>

            <div class="dropdown-custom">

                <a href="<?= htmlspecialchars($item['link']) ?>" class="nav-link-custom">
                    <?= htmlspecialchars($item['title']) ?>
                    <i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i>
                </a>

                <div class="dropdown-menu-custom">

                    <?php foreach ($item['children'] as $child): ?>

                        <?php
                            $childLink = '/collection/' . $child['slug'];

                            $childTitle = isset($child['title'])
                                ? $child['title']
                                : $child['name'];
                        ?>

                        <a href="<?= htmlspecialchars($childLink) ?>">
                            <?= htmlspecialchars($childTitle) ?>
                        </a>

                    <?php endforeach; ?>

                </div>

            </div>

        <?php else: ?>

            <!-- <a href="<?= htmlspecialchars($item['link']) ?>" class="nav-link-custom">
                <?= htmlspecialchars($item['title']) ?>
            </a> -->

        <?php endif; ?>

    <?php endforeach; ?>


    <!-- Static Links -->
    <a href="/collection/combo" class="nav-link-custom">Combo</a>

    <a href="/collection/gifting" class="nav-link-custom">Gifting</a>

    <a href="/collection/siddh-collections" class="nav-link-custom">
        Siddh Collections
    </a>

    <a href="/collection/pooja-need" class="nav-link-custom">
        Pooja Need
    </a>

    <a href="/collection/mala" class="nav-link-custom">
        Mala
    </a>

</nav>

            <!-- Header Icons -->
            <div class="d-flex align-items-center" style="gap: 20px;">
                <!-- <button class="btn p-0 border-0 bg-transparent" aria-label="Search">
                    <i class="fas fa-search" style="font-size: 18px; color: #333;"></i>
                </button> -->

                <!-- <button class="btn p-0 border-0 bg-transparent" aria-label="Account">
                    <i class="far fa-user" style="font-size: 18px; color: #333;"></i>
                </button> -->

                <button class="btn p-0 border-0 bg-transparent position-relative cart-drawer-trigger" aria-label="Cart">
                    <i class="fas fa-shopping-bag" style="font-size: 18px; color: #333;"></i>

                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cart-count"
                        style="background: #F5C518; color: #1a1a1a; font-size: 10px;">
                        <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                    </span>
                </button>

                <button class="mobile-menu-btn btn p-0 border-0 bg-transparent d-lg-none" aria-label="Menu">
                    <i class="fas fa-bars" style="font-size: 22px; color: #333;"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- CART DRAWER -->
<div class="cart-drawer-wrapper">
    <div class="cart-drawer">
        <div class="cart-drawer-header">
            <h5 class="mb-0 fw-bold">Your Cart (<span class="cart-count-text">0 items</span>)</h5>
            <button class="cart-drawer-close btn border-0 bg-transparent">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="cart-drawer-content">
            <!-- Rewards Progress -->
            <div class="rewards-section p-3">
                <p class="text-center mb-2 fw-bold" id="reward-message">You are ₹1,699 away from Free Key Chain!</p>
                <div class="progress-container">
                    <div class="progress-bar-custom" id="reward-progress" style="width: 0%"></div>
                    <div class="milestone milestone-1" style="left: 58%;">
                        <div class="milestone-icon"><i class="fas fa-truck"></i></div>
                        <span class="milestone-label">Free Shipping!</span>
                        <span class="milestone-value">₹999</span>
                    </div>
                    <div class="milestone milestone-2" style="left: 95%;">
                        <div class="milestone-icon"><i class="fas fa-key"></i></div>
                        <span class="milestone-label">Free Key Chain</span>
                        <span class="milestone-value">₹1,699</span>
                    </div>
                </div>
            </div>

            <!-- Cart Items List -->
            <div class="cart-items-list p-3">
                <!-- Items will be injected here via JS -->
            </div>
        </div>

        <div class="cart-drawer-footer p-3">
            <div class="savings-banner mb-3" id="savings-banner">
                <span id="total-savings-text">₹0.00 Saved so far!</span>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="estimated-total">
                    <i class="fas fa-receipt me-2"></i>
                    <span class="fw-bold">Estimated Total</span>
                </div>
                <div class="text-end">
                    <span class="text-muted text-decoration-line-through small me-2" id="cart-original-total">₹0.00</span>
                    <span class="h5 mb-0 fw-bold" id="cart-grand-total">₹0.00</span>
                    <div class="text-success small fw-bold" id="cart-discount-text">(0% OFF)</div>
                </div>
            </div>

            <button class="btn btn-warning w-100 fw-bold py-3 buy-now-btn" style="background: #F5C518; border: none; font-size: 18px;">
                Buy Now 
                <!-- <div class="payment-icons ms-2 d-inline-flex align-items-center gap-1 bg-white/80 px-2 py-1 rounded">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/Paytm_Logo_%28standalone%29.png" alt="Paytm" height="12">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/f2/PhonePe_Logo.png" alt="PhonePe" height="12">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/Google_Pay_%28GPay%29_Logo_%282020%29.svg" alt="GPay" height="12">
                </div> -->
            </button>
            
            <div class="text-center mt-2">
                <span class="text-muted small">Powered by Razorpay</span>
            </div>
        </div>
    </div>
</div>

<div class="cart-overlay"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartDrawer = document.querySelector('.cart-drawer-wrapper');
        const cartOverlay = document.querySelector('.cart-overlay');
        const cartClose = document.querySelector('.cart-drawer-close');
        const cartTriggers = document.querySelectorAll('.cart-drawer-trigger');

        function openCart() {
            cartDrawer.classList.add('active');
            cartOverlay.classList.add('active');
            loadCartItems();
        }

        function closeCart() {
            cartDrawer.classList.remove('active');
            cartOverlay.classList.remove('active');
        }

        cartTriggers.forEach(btn => btn.addEventListener('click', openCart));
        cartClose.addEventListener('click', closeCart);
        cartOverlay.addEventListener('click', closeCart);

        // Add to Cart Logic
        document.addEventListener('click', function(e) {
            if (e.target.closest('.add-to-cart-btn')) {
                const btn = e.target.closest('.add-to-cart-btn');
                const id = btn.dataset.id;
                const name = btn.dataset.name;
                const price = btn.dataset.price;
                const image = btn.dataset.image;
                
                // If there's a quantity input on the page (like in product.php), use it
                let qty = 1;
                const qtyInput = document.getElementById('quantity') || document.getElementById('qtyInput');
                if (qtyInput) {
                    qty = parseInt(qtyInput.value) || 1;
                }

                addToCart(id, name, price, image, qty);
            }
        });

        function addToCart(id, name, price, image, qty) {
            const formData = new FormData();
            formData.append('action', 'add');
            formData.append('id', id);
            formData.append('name', name);
            formData.append('price', price);
            formData.append('image', image);
            formData.append('qty', qty);

            fetch('ajax_cart.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    updateCartUI(data);
                    openCart();
                }
            });
        }

        function updateCartUI(data) {
            // Update counts
            const counts = document.querySelectorAll('.cart-count');
            counts.forEach(el => el.textContent = data.count);
            document.querySelector('.cart-count-text').textContent = `${data.count} items`;
            
            loadCartItems();
        }

        window.loadCartItems = function() {
            fetch('ajax_cart.php', {
                method: 'POST',
                body: new URLSearchParams({ 'action': 'get' })
            })
            .then(res => res.json())
            .then(data => {
                const list = document.querySelector('.cart-items-list');
                list.innerHTML = '';
                
                let grandTotal = 0;
                let originalTotal = 0;

                Object.values(data.cart).forEach(item => {
                    const price = parseFloat(item.price);
                    const qty = parseInt(item.qty);
                    grandTotal += price * qty;
                    // For demo, assume 40% discount if not specified, or just use price
                    originalTotal += (price / 0.6) * qty; 

                    const itemHtml = `
                        <div class="cart-item-card" data-id="${item.id}">
                            <img src="${item.image}" class="cart-item-img" alt="${item.name}">
                            <div class="cart-item-info">
                                <h6 class="cart-item-title">${item.name}</h6>
                                <div class="cart-item-price">
                                    <span class="item-original-price">₹${((price / 0.6)).toFixed(2)}</span>
                                    <span class="item-current-price">₹${price.toLocaleString()}</span>
                                    <span class="item-discount">(40% OFF)</span>
                                </div>
                                <div class="cart-item-actions">
                                    <div class="qty-selector-small">
                                        <button class="qty-btn-sm" onclick="updateItemQty(${item.id}, -1)">-</button>
                                        <input type="text" class="qty-input-sm" value="${qty}" readonly>
                                        <button class="qty-btn-sm" onclick="updateItemQty(${item.id}, 1)">+</button>
                                    </div>
                                    <i class="far fa-trash-alt delete-item" onclick="removeItem(${item.id})"></i>
                                </div>
                            </div>
                        </div>
                    `;
                    list.insertAdjacentHTML('beforeend', itemHtml);
                });

                // Update Totals
                document.getElementById('cart-grand-total').textContent = `₹${grandTotal.toLocaleString()}`;
                document.getElementById('cart-original-total').textContent = `₹${originalTotal.toLocaleString()}`;
                const savings = originalTotal - grandTotal;
                document.getElementById('total-savings-text').textContent = `₹${savings.toLocaleString()} Saved so far!`;
                
                const discountPercent = Math.round((savings / originalTotal) * 100) || 0;
                document.getElementById('cart-discount-text').textContent = `(${discountPercent}% OFF)`;

                // Rewards Logic
                const rewardProgress = document.getElementById('reward-progress');
                const rewardMsg = document.getElementById('reward-message');
                const m1 = document.querySelector('.milestone-1');
                const m2 = document.querySelector('.milestone-2');

                let progress = (grandTotal / 1699) * 100;
                if (progress > 100) progress = 100;
                rewardProgress.style.width = `${progress}%`;

                if (grandTotal >= 1699) {
                    rewardMsg.textContent = "You have unlocked all rewards!";
                    m1.classList.add('active');
                    m2.classList.add('active');
                } else if (grandTotal >= 999) {
                    rewardMsg.textContent = `You are ₹${(1699 - grandTotal).toLocaleString()} away from Free Key Chain!`;
                    m1.classList.add('active');
                    m2.classList.remove('active');
                } else {
                    rewardMsg.textContent = `You are ₹${(999 - grandTotal).toLocaleString()} away from Free Shipping!`;
                    m1.classList.remove('active');
                    m2.classList.remove('active');
                }

                if (data.count === 0) {
                    list.innerHTML = '<div class="text-center py-5"><p class="text-muted">Your cart is empty</p></div>';
                }
            });
        };

        window.updateItemQty = function(id, delta) {
            const row = document.querySelector(`.cart-item-card[data-id="${id}"]`);
            const input = row.querySelector('.qty-input-sm');
            let newQty = parseInt(input.value) + delta;
            
            if (newQty < 1) {
                removeItem(id);
                return;
            }

            const formData = new FormData();
            formData.append('action', 'update');
            formData.append('id', id);
            formData.append('qty', newQty);

            fetch('ajax_cart.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                updateCartUI(data);
            });
        };

        window.removeItem = function(id) {
            const formData = new FormData();
            formData.append('action', 'remove');
            formData.append('id', id);

            fetch('ajax_cart.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                updateCartUI(data);
            });
        };

        // Load cart on page load
        loadCartItems();
    });
</script>


<!-- MOBILE MENU -->
<div class="mobile-menu-wrapper d-lg-none">

    <div class="mobile-menu-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0 fw-bold">
            <span style="color:#D4AF37;">Astro</span>Rajeev
        </h4>

        <button class="mobile-menu-close btn border-0 bg-transparent">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="mobile-menu-content">

        <?php foreach ($navbarMenu as $item): ?>
            <?php if (!empty($item['children'])): ?>
                <div class="mobile-dropdown">
                    <button class="mobile-dropdown-btn">
                        <?= htmlspecialchars($item['title']) ?>
                        <i class="fas fa-chevron-down"></i>
                    </button>

                    <div class="mobile-dropdown-menu">
                        <?php foreach ($item['children'] as $child): ?>
                            <?php 
                                $childLink = isset($child['link']) ? $child['link'] : 'collection/' . $child['slug'];
                                $childTitle = isset($child['title']) ? $child['title'] : $child['name'];
                            ?>
                            <a href="<?= htmlspecialchars($childLink) ?>"><?= htmlspecialchars($childTitle) ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?= htmlspecialchars($item['link']) ?>" class="mobile-link"><?= htmlspecialchars($item['title']) ?></a>
            <?php endif; ?>
        <?php endforeach; ?>

    </div>
</div>

<!-- OVERLAY -->
<div class="mobile-overlay"></div>

<script>
    /* MOBILE MENU */
const menuBtn = document.querySelector('.mobile-menu-btn');
const mobileMenu = document.querySelector('.mobile-menu-wrapper');
const mobileOverlay = document.querySelector('.mobile-overlay');
const closeMenu = document.querySelector('.mobile-menu-close');

/* OPEN MENU */
menuBtn.addEventListener('click', () => {
    mobileMenu.classList.add('active');
    mobileOverlay.classList.add('active');
});

/* CLOSE MENU */
closeMenu.addEventListener('click', () => {
    mobileMenu.classList.remove('active');
    mobileOverlay.classList.remove('active');
});

mobileOverlay.addEventListener('click', () => {
    mobileMenu.classList.remove('active');
    mobileOverlay.classList.remove('active');
});

/* DROPDOWN */
document.querySelectorAll('.mobile-dropdown-btn').forEach(button => {

    button.addEventListener('click', () => {

        const parent = button.parentElement;

        parent.classList.toggle('active');

    });

});
</script>