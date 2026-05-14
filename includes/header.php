<?php
require_once __DIR__ . '/functions.php';
$conn = getSashDBConnection();
$navbarMenu = getNavbarMenu($conn);
?>
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
            <nav class="nav-desktop d-none d-lg-flex align-items-center">

                <?php foreach ($navbarMenu as $item): ?>
                    <?php if (!empty($item['children'])): ?>
                        <div class="dropdown-custom">
                            <a href="<?= htmlspecialchars($item['link']) ?>" class="nav-link-custom">
                                <?= htmlspecialchars($item['title']) ?> <i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i>
                            </a>

                            <div class="dropdown-menu-custom">
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
                        <a href="<?= htmlspecialchars($item['link']) ?>" class="nav-link-custom"><?= htmlspecialchars($item['title']) ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>

            </nav>

            <!-- Header Icons -->
            <div class="d-flex align-items-center" style="gap: 20px;">
                <button class="btn p-0 border-0 bg-transparent" aria-label="Search">
                    <i class="fas fa-search" style="font-size: 18px; color: #333;"></i>
                </button>

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

<style>
    /* CART DRAWER STYLES */
    .cart-drawer-wrapper {
        position: fixed;
        top: 0;
        right: -450px;
        width: 420px;
        max-width: 100%;
        height: 100%;
        background: #fff;
        z-index: 999999;
        transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: -10px 0 30px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
    }

    .cart-drawer-wrapper.active {
        right: 0;
    }

    .cart-drawer {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .cart-drawer-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-drawer-content {
        flex: 1;
        overflow-y: auto;
    }

    .cart-drawer-footer {
        border-top: 1px solid #eee;
        background: #fff;
    }

    /* REWARDS PROGRESS */
    .progress-container {
        height: 6px;
        background: #eee;
        border-radius: 10px;
        position: relative;
        margin: 40px 10px 20px;
    }

    .progress-bar-custom {
        height: 100%;
        background: #F5C518;
        border-radius: 10px;
        transition: width 0.5s ease;
    }

    .milestone {
        position: absolute;
        top: -15px;
        transform: translateX(-50%);
        text-align: center;
    }

    .milestone-icon {
        width: 30px;
        height: 30px;
        background: #fff;
        border: 2px solid #eee;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 5px;
        font-size: 12px;
        color: #999;
    }

    .milestone.active .milestone-icon {
        border-color: #F5C518;
        color: #F5C518;
        background: #FFF9E6;
    }

    .milestone-label {
        font-size: 9px;
        font-weight: bold;
        display: block;
        white-space: nowrap;
    }

    .milestone-value {
        font-size: 10px;
        color: #333;
        font-weight: 700;
    }

    /* CART ITEM CARD */
    .cart-item-card {
        display: flex;
        gap: 15px;
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid #f5f5f5;
        position: relative;
    }

    .cart-item-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    .cart-item-info {
        flex: 1;
    }

    .cart-item-title {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #1a1a1a;
        line-height: 1.4;
    }

    .cart-item-price {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
    }

    .item-original-price {
        font-size: 12px;
        color: #999;
        text-decoration: line-through;
    }

    .item-current-price {
        font-size: 14px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .item-discount {
        font-size: 11px;
        color: #28a745;
        font-weight: 600;
    }

    .cart-item-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .qty-selector-small {
        display: flex;
        align-items: center;
        background: #f8f8f8;
        border-radius: 4px;
        padding: 2px;
    }

    .qty-btn-sm {
        width: 24px;
        height: 24px;
        border: none;
        background: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: #555;
    }

    .qty-input-sm {
        width: 30px;
        text-align: center;
        border: none;
        background: transparent;
        font-weight: 600;
        font-size: 13px;
    }

    .delete-item {
        color: #999;
        cursor: pointer;
        transition: 0.3s;
    }

    .delete-item:hover {
        color: #dc3545;
    }

    .savings-banner {
        background: #4abfa4;
        color: #fff;
        text-align: center;
        padding: 8px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
    }

    /* MOBILE OVERLAY FOR CART */
    .cart-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        opacity: 0;
        visibility: hidden;
        transition: 0.3s;
        z-index: 999998;
    }

    .cart-overlay.active {
        opacity: 1;
        visibility: visible;
    }
</style>

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

<style>
    /* MOBILE MENU */
.mobile-menu-wrapper {
    position: fixed;
    top: 0;
    left: -320px;
    width: 300px;
    height: 100%;
    background: #fff;
    z-index: 99999;
    transition: 0.4s ease;
    overflow-y: auto;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.mobile-menu-wrapper.active {
    left: 0;
}

/* OVERLAY */
.mobile-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    opacity: 0;
    visibility: hidden;
    transition: 0.3s;
    z-index: 9999;
}

.mobile-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* HEADER */
.mobile-menu-header {
    padding: 20px;
    border-bottom: 1px solid #eee;
}

.mobile-menu-close i {
    font-size: 22px;
    color: #333;
}

/* CONTENT */
.mobile-menu-content {
    padding: 10px 0;
}

/* LINKS */
.mobile-link,
.mobile-dropdown-btn {
    width: 100%;
    border: none;
    background: transparent;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-decoration: none;
    color: #222;
    font-size: 15px;
    font-weight: 500;
    transition: 0.3s;
}

.mobile-link:hover,
.mobile-dropdown-btn:hover {
    background: #f7f7f7;
    color: #D4AF37;
}

/* SUBMENU */
.mobile-dropdown-menu {
    display: none;
    background: #fafafa;
}

.mobile-dropdown-menu a {
    display: block;
    padding: 12px 35px;
    text-decoration: none;
    color: #555;
    font-size: 14px;
}

.mobile-dropdown-menu a:hover {
    color: #D4AF37;
    background: #f3f3f3;
}

/* ACTIVE */
.mobile-dropdown.active .mobile-dropdown-menu {
    display: block;
}

.mobile-dropdown.active i {
    transform: rotate(180deg);
}

.mobile-dropdown-btn i {
    transition: 0.3s;
}
</style>

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