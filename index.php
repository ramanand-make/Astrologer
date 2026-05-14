<?php require_once 'includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astroyogi Store – Buy Astrology Remedies & Spiritual Products</title>
    <base href="<?= BASE_URL ?>">
    <meta name="description" content="Shop authentic spiritual products, crystals, rudraksha, gemstones and more at Astroyogi Store. Lab certified, ethically sourced with 25+ years of legacy.">
    <!-- SWIPER CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<!-- SWIPER JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#F5C518',
                        secondary: '#1a1a1a',
                        accent: '#D4AF37',
                        background: '#FAFAFA',
                        surface: '#FFFFFF',
                        muted: '#6B7280',
                        'muted-light': '#9CA3AF',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php  include('includes/header.php')?>


<!-- HERO SLIDER -->
<section class="hero-slider">
    <div class="swiper heroSwiper">

        <div class="swiper-wrapper">

            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="hero-slide">
                    <img src="https://images.unsplash.com/photo-1611652022419-a9419f74343d?q=80&w=1920&auto=format&fit=crop"
                        alt="Banner 1">

                    <div class="hero-overlay"></div>

                    <div class="hero-content">
                        <h2>Evil Eye Collection</h2>
                        <p>Positive Vibes Only</p>
                        <a href="#" class="hero-btn">Shop Now</a>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide">
                <div class="hero-slide">
                    <img src="https://images.unsplash.com/photo-1599707367072-cd6ada2bc375?q=80&w=1920&auto=format&fit=crop"
                        alt="Banner 2">

                    <div class="hero-overlay"></div>

                    <div class="hero-content">
                        <h2>Rudraksha Energy</h2>
                        <p>Divine Spiritual Power</p>
                        <a href="#" class="hero-btn">Explore Now</a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide">
                <div class="hero-slide">
                    <img src="https://images.unsplash.com/photo-1599707367072-cd6ada2bc375?q=80&w=1920&auto=format&fit=crop"
                        alt="Banner 3">

                    <div class="hero-overlay"></div>

                    <div class="hero-content">
                        <h2>Healing Crystals</h2>
                        <p>Balance Your Energy</p>
                        <a href="#" class="hero-btn">Discover More</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>

    </div>
</section>

<script>
    /* HERO SWIPER */
var swiper = new Swiper(".heroSwiper", {

    loop: true,

    speed: 1200,

    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },

    effect: "fade",

    fadeEffect: {
        crossFade: true,
    },

    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

});
</script>
    <?php  include('includes/trustbar.php')?>

    <!-- Best Sellers Section -->
    <section class="best-seller-section py-5">
        <div class="container">
             <div class="d-flex justify-content-center align-items-center mb-4">
        
        <div class="text-center w-100">
            <div style="font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 600; color: #1a1a1a;">
                BEST<br><em>SELLER</em>
            </div>
        </div>

    </div>
            
            <div class="row g-4">
                <?php 
                $bestSellers = getProducts($conn, 4); 
                foreach ($bestSellers as $index => $prod): 
                    $delay = ($index + 1) * 100;
                    $discount = 0;
                    if ($prod['price'] > 0 && $prod['sale_price'] > 0) {
                        $discount = round((($prod['price'] - $prod['sale_price']) / $prod['price']) * 100);
                    }
                ?>
                <!-- Product <?= $index + 1 ?> -->
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                    <div class="product-card">
                        <div class="product-image">
                            <?php if ($discount > 0): ?>
                                <span class="product-badge">SALE</span>
                            <?php endif; ?>
                            <a href="product/<?= htmlspecialchars($prod['slug']) ?>">
                                <img src="<?= htmlspecialchars($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>">
                            </a>
                            <button class="quick-view-btn">Quick View</button>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">
                                <a href="product/<?= htmlspecialchars($prod['slug']) ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($prod['name']) ?>
                                </a>
                            </h3>
                            <div class="product-rating">
                                <span class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </span>
                                <span class="rating-text">4.5 (47)</span>
                            </div>
                            <div class="product-price">
                                <?php if ($prod['sale_price'] > 0): ?>
                                    <span class="original-price">₹<?= number_format($prod['price'], 2) ?></span>
                                    <span class="current-price">₹<?= number_format($prod['sale_price'], 2) ?></span>
                                <?php else: ?>
                                    <span class="current-price">₹<?= number_format($prod['price'], 2) ?></span>
                                <?php endif; ?>
                            </div>
                            <button class="add-to-cart-btn" 
                                    data-id="<?= $prod['id'] ?>" 
                                    data-name="<?= htmlspecialchars($prod['name']) ?>" 
                                    data-price="<?= $prod['sale_price'] > 0 ? $prod['sale_price'] : $prod['price'] ?>" 
                                    data-image="<?= get_image_url($prod['image']) ?>">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-5">
                <a href="#" class="btn-primary-custom">View All Products</a>
            </div>
        </div>
    </section>

    <!-- Shop By Purpose Section -->
    <section class="py-5" style="background: #FAFAFA;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Shop By Purpose</h2>
            </div>
            
            <div class="row g-4">
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="100">
                    <a href="#" class="text-decoration-none">
                        <div class="purpose-card">
                            <img src="https://images.unsplash.com/photo-1518199266791-5375a83190b7?w=300&h=400&fit=crop" alt="Love">
                            <div class="purpose-overlay">
                                <p class="purpose-label">Energies for deeper bonds.</p>
                                <h3 class="purpose-title">LOVE</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="150">
                    <a href="#" class="text-decoration-none">
                        <div class="purpose-card">
                            <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=300&h=400&fit=crop" alt="Marriage">
                            <div class="purpose-overlay">
                                <p class="purpose-label">Sacred Bond for Two</p>
                                <h3 class="purpose-title">MARRIAGE</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="200">
                    <a href="#" class="text-decoration-none">
                        <div class="purpose-card">
                            <img src="https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=300&h=400&fit=crop" alt="Gifts">
                            <div class="purpose-overlay">
                                <p class="purpose-label">Energy You Can Gift</p>
                                <h3 class="purpose-title">GIFTS</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="250">
                    <a href="#" class="text-decoration-none">
                        <div class="purpose-card">
                            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=300&h=400&fit=crop" alt="Career">
                            <div class="purpose-overlay">
                                <p class="purpose-label">Fuel Your Ambition</p>
                                <h3 class="purpose-title">CAREER</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="300">
                    <a href="#" class="text-decoration-none">
                        <div class="purpose-card">
                            <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=300&h=400&fit=crop" alt="Health">
                            <div class="purpose-overlay">
                                <p class="purpose-label">Balance Your Energy</p>
                                <h3 class="purpose-title">HEALTH</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="350">
                    <a href="#" class="text-decoration-none">
                        <div class="purpose-card">
                            <img src="https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=300&h=400&fit=crop" alt="Money">
                            <div class="purpose-overlay">
                                <p class="purpose-label">Freedom Begins Here</p>
                                <h3 class="purpose-title">MONEY</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Spotlight Section -->
    <section class="py-5" style="background: white;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Spotlight</h2>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="spotlight-card" style="background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);">
                        <img src="https://images.unsplash.com/photo-1611652022419-a9419f74343d?w=400&h=400&fit=crop" alt="Evil Eye" style="opacity: 0.9;">
                        <div class="spotlight-content">
                            <h3 class="spotlight-title">Evil eye</h3>
                            <a href="#" class="explore-btn">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="spotlight-card" style="background: linear-gradient(135deg, #FFF8E1 0%, #FFECB3 100%);">
                        <img src="https://images.unsplash.com/photo-1599707367072-cd6ada2bc375?w=400&h=400&fit=crop" alt="Power of Pyrite" style="opacity: 0.9;">
                        <div class="spotlight-content">
                            <h3 class="spotlight-title">Power of Pyrite</h3>
                            <a href="#" class="explore-btn">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="spotlight-card" style="background: linear-gradient(135deg, #F3E5F5 0%, #E1BEE7 100%);">
                        <img src="https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=400&h=400&fit=crop" alt="Pendants" style="opacity: 0.9;">
                        <div class="spotlight-content">
                            <h3 class="spotlight-title">Pendants</h3>
                            <a href="#" class="explore-btn">Explore</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Combo Deals Section -->
    <section class="py-5" style="background: #FAFAFA;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Combo Deals</h2>
            </div>
            
            <div class="row g-4">
                <?php 
                // Fetch products from 'Combos' category (ID 14 based on previous scan) or just any 4 products
                $combos = getProducts($conn, 4); 
                foreach ($combos as $index => $prod): 
                    $delay = ($index + 1) * 100;
                ?>
                <!-- Combo <?= $index + 1 ?> -->
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="product-badge" style="background: #D4AF37;">COMBO</span>
                            <a href="product/<?= htmlspecialchars($prod['slug']) ?>">
                                <img src="<?= get_image_url($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>">
                            </a>
                            <button class="quick-view-btn">Quick View</button>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">
                                <a href="product/<?= htmlspecialchars($prod['slug']) ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($prod['name']) ?>
                                </a>
                            </h3>
                            <div class="product-price">
                                <?php if ($prod['sale_price'] > 0): ?>
                                    <span class="original-price">₹<?= number_format($prod['price'], 2) ?></span>
                                    <span class="current-price">₹<?= number_format($prod['sale_price'], 2) ?></span>
                                <?php else: ?>
                                    <span class="current-price">₹<?= number_format($prod['price'], 2) ?></span>
                                <?php endif; ?>
                            </div>
                            <button class="add-to-cart-btn" 
                                    data-id="<?= $prod['id'] ?>" 
                                    data-name="<?= htmlspecialchars($prod['name']) ?>" 
                                    data-price="<?= $prod['sale_price'] > 0 ? $prod['sale_price'] : $prod['price'] ?>" 
                                    data-image="<?= get_image_url($prod['image']) ?>">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="#" class="text-decoration-none d-inline-flex align-items-center fw-semibold" style="color: #1a1a1a;">
                    View all products <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Product Section -->
    <section class="py-5" style="background: white;">
        <div class="container">
            <?php 
            // Fetch one featured product
            $featuredProducts = getProducts($conn, 1); 
            if (!empty($featuredProducts)):
                $feat = $featuredProducts[0];
                $featThumbnails = getProductImages($conn, $feat['id']);
                $featAllImages = array_merge([$feat['image']], $featThumbnails);
                $featDiscount = 0;
                if ($feat['price'] > 0 && $feat['sale_price'] > 0) {
                    $featDiscount = round((($feat['price'] - $feat['sale_price']) / $feat['price']) * 100);
                }
            ?>
            <div class="featured-product" data-aos="fade-up">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="featured-gallery">
                            <div class="featured-thumbnails">
                                <?php foreach ($featAllImages as $idx => $t): ?>
                                    <div class="featured-thumb <?= $idx === 0 ? 'active' : '' ?>" onclick="updateFeaturedImage('<?= get_image_url($t) ?>', this)">
                                        <img src="<?= get_image_url($t) ?>" alt="Thumbnail <?= $idx + 1 ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="featured-main-image">
                                <img src="<?= get_image_url($feat['image']) ?>" alt="<?= htmlspecialchars($feat['name']) ?>" id="featuredMainImg">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="featured-details">
                            <h2 class="featured-title">
                                <a href="product/<?= htmlspecialchars($feat['slug']) ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($feat['name']) ?>
                                </a>
                            </h2>
                            <div class="featured-price-box">
                                <?php if ($feat['sale_price'] > 0): ?>
                                    <span class="featured-original-price">₹<?= number_format($feat['price'], 2) ?></span>
                                    <span class="featured-current-price">₹<?= number_format($feat['sale_price'], 2) ?></span>
                                    <?php if ($featDiscount > 0): ?>
                                        <span class="discount-badge"><?= $featDiscount ?>% OFF</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="featured-current-price">₹<?= number_format($feat['price'], 2) ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="quantity-selector">
                                <button class="qty-btn" onclick="decreaseQty()">-</button>
                                <input type="text" class="qty-input" value="1" id="qtyInput" readonly>
                                <button class="qty-btn" onclick="increaseQty()">+</button>
                            </div>
                            <button class="btn-primary-custom add-to-cart-btn" 
                                    style="width: 100%; padding: 16px;"
                                    data-id="<?= $feat['id'] ?>" 
                                    data-name="<?= htmlspecialchars($feat['name']) ?>" 
                                    data-price="<?= $feat['sale_price'] > 0 ? $feat['sale_price'] : $feat['price'] ?>" 
                                    data-image="<?= get_image_url($feat['image']) ?>">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <script>
    function updateFeaturedImage(src, el) {
        document.getElementById('featuredMainImg').src = src;
        document.querySelectorAll('.featured-thumb').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
    }
    function increaseQty() {
        let input = document.getElementById('qtyInput');
        input.value = parseInt(input.value) + 1;
    }
    function decreaseQty() {
        let input = document.getElementById('qtyInput');
        if(parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
    }
    </script>

    <!-- Editor's Pick Section -->
    <section class="py-5" style="background: #FAFAFA;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Editor's Pick for You</h2>
            </div>
            
            <div class="row g-4">
                <?php 
                $editorsPick = getProducts($conn, 4); 
                foreach ($editorsPick as $index => $prod): 
                    $delay = ($index + 1) * 100;
                ?>
                <!-- Product <?= $index + 1 ?> -->
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                    <div class="product-card">
                        <div class="product-image">
                            <a href="product/<?= htmlspecialchars($prod['slug']) ?>">
                                <img src="<?= get_image_url($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>">
                            </a>
                            <button class="quick-view-btn">Quick View</button>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">
                                <a href="product/<?= htmlspecialchars($prod['slug']) ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($prod['name']) ?>
                                </a>
                            </h3>
                            <div class="product-rating">
                                <span class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </span>
                                <span class="rating-text">4.6 (58)</span>
                            </div>
                            <div class="product-price">
                                <?php if ($prod['sale_price'] > 0): ?>
                                    <span class="original-price">₹<?= number_format($prod['price'], 2) ?></span>
                                    <span class="current-price">₹<?= number_format($prod['sale_price'], 2) ?></span>
                                <?php else: ?>
                                    <span class="current-price">₹<?= number_format($prod['price'], 2) ?></span>
                                <?php endif; ?>
                            </div>
                            <button class="add-to-cart-btn" 
                                    data-id="<?= $prod['id'] ?>" 
                                    data-name="<?= htmlspecialchars($prod['name']) ?>" 
                                    data-price="<?= $prod['sale_price'] > 0 ? $prod['sale_price'] : $prod['price'] ?>" 
                                    data-image="<?= get_image_url($prod['image']) ?>">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Trust Badges & Contact Section -->
    <section class="py-5" style="background: white;">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="d-flex flex-wrap gap-4">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 50px; height: 50px; background: #FFF9E6; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check-circle" style="color: #D4AF37; font-size: 24px;"></i>
                            </div>
                            <span class="fw-medium">Guarantee of Purity</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 50px; height: 50px; background: #FFF9E6; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-leaf" style="color: #D4AF37; font-size: 24px;"></i>
                            </div>
                            <span class="fw-medium">Ethically Sourced</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 50px; height: 50px; background: #FFF9E6; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-certificate" style="color: #D4AF37; font-size: 24px;"></i>
                            </div>
                            <span class="fw-medium">100% Lab Certified</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 50px; height: 50px; background: #FFF9E6; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-trophy" style="color: #D4AF37; font-size: 24px;"></i>
                            </div>
                            <span class="fw-medium">25 Years of Legacy</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="contact-form-section">
                        <h3 class="contact-form-title">Not Sure What to Buy?</h3>
                        <p class="contact-form-subtitle">Drop your number and our experts will reach out to guide you!</p>
                        <form>
                            <input type="text" class="form-input" placeholder="Name" required>
                            <div class="phone-input-group">
                                <span class="country-code">+91</span>
                                <input type="tel" class="form-input" placeholder="Mobile Number" required style="margin-bottom: 0;">
                            </div>
                            <button type="submit" class="btn-primary-custom mt-3" style="width: 100%;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Astroyogi Section -->
    <section class="trust-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title" style="color: white;">Why Astrologerrajeev?</h2>
                <p class="text-white-50 mx-auto" style="max-width: 800px;">
                    Trust is our core value at Yogii, where authenticity is key. We use only natural stones, free from dyes and artificial polish. With 25+ years of strong legacy, every purchase supports children's education and is crafted with care, integrity, and tradition.
                </p>
            </div>
            
            <div class="row g-4">
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="trust-badge-item">
                        <div class="trust-badge-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4 class="trust-badge-title">Authenticity is Our Promise</h4>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="trust-badge-item">
                        <div class="trust-badge-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h4 class="trust-badge-title">25 Years Of Legacy</h4>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="trust-badge-item">
                        <div class="trust-badge-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h4 class="trust-badge-title">Lab Certified</h4>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="trust-badge-item">
                        <div class="trust-badge-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 class="trust-badge-title">Empowered & Ethical</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Celebrities Section -->
    <!-- <section class="celebrities-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Loved by India's Leading Celebrities</h2>
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='20'%3E%3Cpath d='M0 10 Q50 0 100 10 T200 10' stroke='%23F5C518' stroke-width='3' fill='none'/%3E%3C/svg%3E" alt="Underline" class="mt-2">
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="celebrity-video-card">
                        <div class="celebrity-video d-flex align-items-center justify-content-center">
                            <i class="fas fa-play-circle" style="font-size: 60px; color: rgba(255,255,255,0.8);"></i>
                        </div>
                        <p class="celebrity-caption">An "Engaged" show couple finds warmth & harmony with Rose Quartz Bracelet</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="celebrity-video-card">
                        <div class="celebrity-video d-flex align-items-center justify-content-center">
                            <i class="fas fa-play-circle" style="font-size: 60px; color: rgba(255,255,255,0.8);"></i>
                        </div>
                        <p class="celebrity-caption">Ankita Lokhande trusts Astroyogi crystals for clarity, balance, and good vibes.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="celebrity-video-card">
                        <div class="celebrity-video d-flex align-items-center justify-content-center">
                            <i class="fas fa-play-circle" style="font-size: 60px; color: rgba(255,255,255,0.8);"></i>
                        </div>
                        <p class="celebrity-caption">Shalini Passi says Amethyst Harmony Tree brings positivity to her home.</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Testimonials</h2>
            </div>
            
            <div class="swiper testimonials-swiper">
                <div class="swiper-wrapper">
                    <!-- Testimonial 1 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="testimonial-title">Amethyst Bracelet</h4>
                            <p class="testimonial-text">Got this bracelet as a gift. The purple beads looks so classy and they fit comfortably for daily wear. Was doubtful first but I actually feel calmer wearing it. Definitely happy with the quality and look. highly recommended.</p>
                            <p class="testimonial-author">- Rashi Khanna</p>
                            <div class="testimonial-product">
                                <img src="https://images.unsplash.com/photo-1573408301185-9146fe634ad0?w=100&h=100&fit=crop" alt="Amethyst Bracelet">
                                <div class="testimonial-product-info">
                                    <p class="testimonial-product-name">Amethyst Bracelet</p>
                                    <p class="testimonial-product-price">
                                        <span class="original">₹1,999</span>
                                        <span class="current">₹699</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 2 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="testimonial-title">Rose Quartz Bracelet</h4>
                            <p class="testimonial-text">Received this rose quartz bracelet recently and it's lovely. These pink beads are very elegant and the bracelet fits perfectly. it really brings a gentle, calming vibe. Would like to recommend it for quality and prettyness.</p>
                            <p class="testimonial-author">- Payal Jain</p>
                            <div class="testimonial-product">
                                <img src="https://images.unsplash.com/photo-1518199266791-5375a83190b7?w=100&h=100&fit=crop" alt="Rose Quartz Bracelet">
                                <div class="testimonial-product-info">
                                    <p class="testimonial-product-name">Rose Quartz Bracelet</p>
                                    <p class="testimonial-product-price">
                                        <span class="original">₹1,999</span>
                                        <span class="current">₹499</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 3 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="testimonial-title">Evil Eye Pendant</h4>
                            <p class="testimonial-text">This evil eye pendant got my attention online and I ordered it. the blue eye stand out beautifuly and feels protective without being flashy. It's light weight, comfortable for daily wear.</p>
                            <p class="testimonial-author">- Amrita Pandey</p>
                            <div class="testimonial-product">
                                <img src="https://images.unsplash.com/photo-1611652022419-a9419f74343d?w=100&h=100&fit=crop" alt="Evil Eye Pendant">
                                <div class="testimonial-product-info">
                                    <p class="testimonial-product-name">Evil Eye Pendant</p>
                                    <p class="testimonial-product-price">
                                        <span class="original">₹999</span>
                                        <span class="current">₹699</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 4 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="testimonial-title">Tiger Eye Pendant</h4>
                            <p class="testimonial-text">Wanted to purchase a tiger eye as my astrologer recommended it. After a lot of research online I found this one. The golden-brown stone catches light nicely and stands out.</p>
                            <p class="testimonial-author">- Khushi Shah</p>
                            <div class="testimonial-product">
                                <img src="https://images.unsplash.com/photo-1599707367072-cd6ada2bc375?w=100&h=100&fit=crop" alt="Tiger Eye Pendant">
                                <div class="testimonial-product-info">
                                    <p class="testimonial-product-name">Tiger Eye Pendant</p>
                                    <p class="testimonial-product-price">
                                        <span class="original">₹1,499</span>
                                        <span class="current">₹999</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 5 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="testimonial-title">Dhan Yog Bracelet</h4>
                            <p class="testimonial-text">Got this delivered recently. I bought this one bcz the stones used are natural and lab certified. i am definitely happy with the quality & it is seriously giving me the motivation needed.</p>
                            <p class="testimonial-author">- Saras</p>
                            <div class="testimonial-product">
                                <img src="https://images.unsplash.com/photo-1573408301185-9146fe634ad0?w=100&h=100&fit=crop" alt="Dhan Yog Bracelet">
                                <div class="testimonial-product-info">
                                    <p class="testimonial-product-name">Dhan Yog Bracelet</p>
                                    <p class="testimonial-product-price">
                                        <span class="original">₹1,999</span>
                                        <span class="current">₹699</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <!-- Publications Section -->
    <!-- <section class="publications-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Astroyogi Featured in Leading Publications</h2>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="publication-card">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/The_Economic_Times_logo.svg/200px-The_Economic_Times_logo.svg.png" alt="Economic Times" class="publication-logo">
                        <p class="publication-text">The Economic Times mentions how Astroyogi is scaling digital spiritual services for Gen Z</p>
                        <a href="#" class="read-more-link">Read More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="publication-card">
                        <img src="https://upload.wikimedia.org/wikipedia/en/thumb/3/3a/Financial_Express_India_logo.svg/200px-Financial_Express_India_logo.svg.png" alt="Financial Express" class="publication-logo">
                        <p class="publication-text">Financial Express features how Astroyogi is reshaping spiritual retail experiences</p>
                        <a href="#" class="read-more-link">Read More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="publication-card">
                        <div style="height: 40px; display: flex; align-items: center; margin-bottom: 16px;">
                            <span style="font-weight: 700; font-size: 18px; color: #333;">ETV Bharat</span>
                        </div>
                        <p class="publication-text">ETV Bharat spotlights how Astroyogi is tapping Gen Z's rising interest in crystals</p>
                        <a href="#" class="read-more-link">Read More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="publication-card">
                        <div style="height: 40px; display: flex; align-items: center; margin-bottom: 16px;">
                            <span style="font-weight: 700; font-size: 18px; color: #333;">Indian Express</span>
                        </div>
                        <p class="publication-text">Indian Express highlights Astroyogi's blend of astrology, crystals, and modern style</p>
                        <a href="#" class="read-more-link">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <?php include('includes/footer.php')?>