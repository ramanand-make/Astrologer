<?php 
require_once 'includes/functions.php';
$conn = getSashDBConnection();

$categorySlug = isset($_GET['category']) ? $_GET['category'] : '';
$category = null;
$category_id = null;
$title = "Best Sellers";

if ($categorySlug) {
    $category = getCategoryBySlug($conn, $categorySlug);
    if ($category) {
        $category_id = $category['id'];
        $title = $category['name'];
    }
}

$products = getProducts($conn, 12, $category_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> – Astroyogi Store</title>
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
    
    <link href="<?= BASE_URL ?>assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php  include('includes/header.php')?>





<style>
    .best-seller-section h1{
    text-align: center;
    font-size: 48px;
    font-weight: 800;
    color: #111;
    margin-bottom: 40px;
    position: relative;
}

/* Optional Underline Design */
.best-seller-section h1::after{
    content: "";
    width: 80px;
    height: 4px;
    background: #D4AF37;
    position: absolute;
    left: 50%;
    bottom: -12px;
    transform: translateX(-50%);
    border-radius: 10px;
}

/* Responsive */
@media(max-width:768px){

    .best-seller-section h1{
        font-size: 34px;
    }

}
</style>

    <!-- Best Sellers Section -->
    <section class="best-seller-section py-5">
        <div class="container">
            <h1><?= htmlspecialchars($title) ?></h1>
            <div class="product-topbar">

            <button class="filter-btn">
                <i class="fas fa-sliders-h"></i>
                Show filter
            </button>

            <div class="topbar-right">
                <div class="view-icons">
                    <i class="fas fa-th-list active"></i>
                    <i class="fas fa-th"></i>
                </div>

                <div class="sort-box">
                    <span>Sort by:</span>
                    <select>
                        <option>Best selling</option>
                        <option>Newest</option>
                        <option>Price low to high</option>
                        <option>Price high to low</option>
                    </select>
                </div>
            </div>

        </div>
            
            <div class="row g-4">
                <?php if (empty($products)): ?>
                    <div class="col-12 text-center py-5">
                        <h3>No products found in this collection.</h3>
                        <a href="collection.php" class="btn btn-outline-dark mt-3">View All Products</a>
                    </div>
                <?php else: ?>
                    <?php 
                    foreach ($products as $index => $prod): 
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
                                <button class="add-to-cart-btn">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($products)): ?>
            <div class="text-center mt-5">
                <a href="collection.php" class="btn-primary-custom">View All Products</a>
            </div>
            <?php endif; ?>
        </div>
    </section>

    
    <?php include('includes/text.php')?>
    

    <?php include('includes/footer.php')?>
</body>
</html>