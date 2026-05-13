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
                     <img src="assets/images/logo/logo-new (1).png" alt="Astrologerrajeev Logo" >
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
                                        $childLink = isset($child['link']) ? $child['link'] : 'collection.php?category=' . $child['slug'];
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

                <button class="btn p-0 border-0 bg-transparent position-relative" aria-label="Cart">
                    <i class="fas fa-shopping-bag" style="font-size: 18px; color: #333;"></i>

                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                        style="background: #F5C518; color: #1a1a1a; font-size: 10px;">
                        0
                    </span>
                </button>

                <button class="mobile-menu-btn btn p-0 border-0 bg-transparent d-lg-none" aria-label="Menu">
                    <i class="fas fa-bars" style="font-size: 22px; color: #333;"></i>
                </button>
            </div>
        </div>
    </div>
</header>

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
                                $childLink = isset($child['link']) ? $child['link'] : 'collection.php?category=' . $child['slug'];
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