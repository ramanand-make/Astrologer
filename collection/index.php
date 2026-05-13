<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astroyogi Store – Buy Astrology Remedies & Spiritual Products</title>
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
    
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php  include('../includes/header.php')?>





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
            <h1>Best Sellers</h1>
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
                <!-- Product 1 -->
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="product-badge">SALE</span>
                            <img src="https://images.unsplash.com/photo-1611652022419-a9419f74343d?w=400&h=400&fit=crop" alt="Evil Eye Car Hanging">
                            <button class="quick-view-btn">Quick View</button>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Evil Eye Car Hanging</h3>
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
                                <span class="original-price">₹1,999</span>
                                <span class="current-price">₹799</span>
                            </div>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>
                
                <!-- Product 2 -->
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="product-badge">SALE</span>
                            <img src="https://images.unsplash.com/photo-1602524816989-93a0e1c41a38?w=400&h=400&fit=crop" alt="7 Mukhi Rudraksha Bracelet">
                            <button class="quick-view-btn">Quick View</button>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">7 Mukhi Rudraksha Bracelet</h3>
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
                                <span class="original-price">₹1,999</span>
                                <span class="current-price">₹699</span>
                            </div>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>
                
                <!-- Product 3 -->
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="product-badge">SALE</span>
                            <img src="https://images.unsplash.com/photo-1599707367072-cd6ada2bc375?w=400&h=400&fit=crop" alt="Pyrite Tortoise">
                            <button class="quick-view-btn">Quick View</button>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Pyrite Tortoise (Kachhua) for Money & Protection</h3>
                            <div class="product-rating">
                                <span class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </span>
                                <span class="rating-text">4.7 (12)</span>
                            </div>
                            <div class="product-price">
                                <span class="original-price">₹1,299</span>
                                <span class="current-price">₹719</span>
                            </div>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>
                
                <!-- Product 4 -->
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="product-badge">SALE</span>
                            <img src="https://images.unsplash.com/photo-1573408301185-9146fe634ad0?w=400&h=400&fit=crop" alt="Dhan Yog Bracelet">
                            <button class="quick-view-btn">Quick View</button>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Dhan Yog Bracelet</h3>
                            <div class="product-rating">
                                <span class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </span>
                                <span class="rating-text">4.8 (37)</span>
                            </div>
                            <div class="product-price">
                                <span class="original-price">₹1,999</span>
                                <span class="current-price">₹699</span>
                            </div>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="#" class="btn-primary-custom">View All Products</a>
            </div>
        </div>
    </section>

    
    <?php include('../includes/text.php')?>
    

    <?php include('../includes/footer.php')?>