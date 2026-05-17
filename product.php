<?php
require_once 'includes/functions.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$conn = getSashDBConnection();
$product = getProductBySlug($conn, $slug);

if (!$product) {
    header("Location: index.php"); // Or 404 page
    exit;
}

// Fetch additional images for thumbnails
$additionalImages = getProductImages($conn, $product['id']);
$thumbnails = array_merge([$product['image']], $additionalImages);

// Calculate discount
$discount = 0;
if ($product['price'] > 0 && $product['sale_price'] > 0) {
    $discount = round((($product['price'] - $product['sale_price']) / $product['price']) * 100);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> – Astroyogi Store</title>
    <base href="<?= BASE_URL ?>">
    
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
                        sans: ['Roboto', 'sans-serif'],
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="product-detail-page">

<?php include('includes/header.php'); ?>

<main class="container mx-auto px-4 py-8 mt-24">
    <div class="flex flex-col lg:flex-row gap-8 lg:gap-16">
        
        <!-- Left Side: Sticky Image Section -->
        <div class="lg:w-[55%] relative">
            <div class="sticky-left">
                <div class="relative rounded-3xl overflow-hidden bg-gray-50 border border-gray-100 group">
                    <img id="main-product-image" src="<?= get_image_url($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105">
                    
                    <!-- Top Left Logo Overlay (Optional, based on image) -->
                    <div class="absolute top-4 left-4 w-8 h-8 bg-black/80 rounded-full flex items-center justify-center">
                        <i class="fas fa-globe text-white text-[10px]"></i>
                    </div>

                    <!-- Navigation Arrows -->
                    <button class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 p-3 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all hover:bg-white">
                        <i class="fas fa-chevron-left text-gray-800"></i>
                    </button>
                    <button class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 p-3 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all hover:bg-white">
                        <i class="fas fa-chevron-right text-gray-800"></i>
                    </button>

                    <!-- Bottom Right Badge (Optional) -->
                    <div class="absolute bottom-4 right-4 w-16 h-16 opacity-80">
                         <img src="https://astrotalk.com/assets/images/at-trust-badge.png" class="w-full h-full object-contain" alt="Trust Badge">
                    </div>
                </div>
                
                <!-- Thumbnails - 5 images in small boxes -->
                <div class="flex gap-4 mt-6 overflow-x-auto pb-4 no-scrollbar">
                    <?php foreach ($thumbnails as $index => $thumb): ?>
                        <div class="thumbnail-item flex-shrink-0 w-24 h-24 rounded-2xl overflow-hidden cursor-pointer border-2 transition-all duration-300 <?= $index === 0 ? 'thumbnail-active shadow-md' : 'border-gray-100 hover:border-accent hover:shadow-sm'; ?>" onclick="changeImage('<?= get_image_url($thumb); ?>', this)">
                            <img src="<?= get_image_url($thumb); ?>" alt="Thumbnail <?= $index + 1; ?>" class="w-full h-full object-cover">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Right Side: Scrollable Details Section -->
        <div class="lg:w-[45%]">
            <div class="space-y-8">
                <!-- Product Title & Rating -->
                <div class="space-y-2">
                    <h1 class="product-detail-title font-bold text-[#282928] tracking-tight leading-tight"><?= htmlspecialchars($product['name']); ?></h1>
                    <div class="flex items-center gap-3">
                        <div class="flex text-[#F5C518] text-lg">
                            <?php 
                            $rating = isset($product['rating']) ? $product['rating'] : 4.5;
                            for($i=0; $i<5; $i++): ?>
                                <i class="fas fa-star<?= ($i < floor($rating)) ? '' : (($i < $rating) ? '-half-alt' : '-empty'); ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <span class="text-gray-900 font-bold text-lg"><?= $rating; ?></span>
                        <span class="text-gray-400 font-medium">(<?= isset($product['product_review']) ? $product['product_review'] : '58'; ?> reviews)</span>
                    </div>
                </div>

                <!-- Tags -->
                <!-- <div class="flex flex-wrap gap-2">
                    <?php foreach ($product['tags'] as $tag): ?>
                        <span class="bg-[#FFF9E6] text-[#D4AF37] px-4 py-1.5 rounded-full text-sm font-bold border border-[#F5C518]/20 shadow-sm"><?php echo $tag; ?></span>
                    <?php endforeach; ?>
                </div> -->

                <!-- Pricing -->
                <div class="space-y-1">
                    <div class="flex items-center gap-4">
                        <span class="text-xl font-black text-gray-900">₹<?= number_format($product['sale_price'], 2); ?></span>
                        <span class="text-xl text-gray-400 line-through font-medium">₹<?= number_format($product['price'], 2); ?></span>
                        <?php if ($discount > 0): ?>
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-lg font-black text-sm uppercase tracking-wider"><?= $discount; ?>% OFF</span>
                        <?php endif; ?>
                    </div>
                    <p class="text-sm text-gray-500 font-medium">M.R.P. (Incl. of all taxes). Free Delivery on all online payments</p>
                </div>

                <!-- Best Offers Section -->
                <!-- <div class="bg-white rounded-2xl p-6 border-2 border-gray-50 shadow-sm space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-percent text-orange-600 text-sm"></i>
                        </div>
                        <span class="font-extrabold text-xl text-gray-900">Best offers</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                            <div class="absolute top-0 left-0 w-full h-1 bg-orange-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <span class="bg-gradient-to-r from-orange-400 to-red-400 text-white text-[10px] px-3 py-1 rounded-full absolute top-3 left-3 uppercase font-black tracking-tighter">Recommended</span>
                            <div class="mt-8 space-y-1">
                                <p class="font-black text-gray-900">Extra 5% Off</p>
                                <p class="text-xs text-gray-500 font-medium">Pay via UPI for instant savings</p>
                            </div>
                            <div class="mt-4 bg-red-50 text-red-600 text-[10px] font-black py-1.5 px-3 rounded-full inline-flex items-center gap-2 border border-red-100">
                                <i class="fas fa-check-circle"></i> AUTO-APPLIED
                            </div>
                        </div>
                        <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                            <div class="absolute top-0 left-0 w-full h-1 bg-blue-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="space-y-1">
                                <p class="font-black text-gray-900">Free Shipping</p>
                                <p class="text-xs text-gray-500 font-medium">On orders above ₹999</p>
                            </div>
                            <div class="mt-8 bg-red-50 text-red-600 text-[10px] font-black py-1.5 px-3 rounded-full inline-flex items-center gap-2 border border-red-100">
                                <i class="fas fa-check-circle"></i> AUTO-APPLIED
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Quantity & Stock -->
                <div class="flex items-center gap-8 py-2">
                    <div class="flex items-center bg-gray-50 rounded-xl p-1 border border-gray-200">
                        <button class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-400 hover:text-gray-900" onclick="updateQty(-1)">
                            <i class="fas fa-minus text-sm"></i>
                        </button>
                        <input type="number" id="quantity" value="1" min="1" class="w-12 text-center bg-transparent border-none focus:ring-0 font-black text-lg text-gray-900" readonly>
                        <button class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-400 hover:text-gray-900" onclick="updateQty(1)">
                            <i class="fas fa-plus text-sm"></i>
                        </button>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="flex h-3 w-3 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                        </span>
                        <span class="font-bold text-green-600">In stock - Ready to be shipped</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-1 gap-4 pt-4">
                    <div class="relative group">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#4468E1] text-white text-[11px] px-4 py-1.5 rounded-lg font-black opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap shadow-xl z-10">
                            <i class="fas fa-gift mr-2"></i> Add to cart for Free Gifts above ₹999
                        </div>
                        <button class="w-full bg-[#2D2D2D] text-white py-3 rounded-2xl font-black text-xl hover:bg-black transition-all transform hover:scale-[1.01] active:scale-95 shadow-lg shadow-black/10 add-to-cart-btn"
                                data-id="<?= $product['id'] ?>" 
                                data-name="<?= htmlspecialchars($product['name']) ?>" 
                                data-price="<?= $product['sale_price'] > 0 ? $product['sale_price'] : $product['price'] ?>" 
                                data-image="<?= get_image_url($product['image']) ?>">
                            Add to cart
                        </button>
                    </div>
                    <button class="w-full bg-[#F5C518] text-[#1a1a1a] py-3 rounded-2xl font-black text-xl hover:bg-[#FACC15] transition-all transform hover:scale-[1.01] active:scale-95 shadow-lg shadow-yellow-500/20 flex items-center justify-center gap-4">
                        Buy now 
                        <!-- <div class="flex items-center gap-1 bg-white/90 px-3 py-1.5 rounded-lg shadow-sm">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/Paytm_Logo_%28standalone%29.png" alt="Paytm" class="h-4">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f2/PhonePe_Logo.png" alt="PhonePe" class="h-4">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/Google_Pay_%28GPay%29_Logo_%282020%29.svg" alt="GPay" class="h-4">
                        </div> -->
                        <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                </div>

                <!-- Delivery Estimator -->
                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-3 shadow-inner">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-map-marker-alt text-orange-500"></i>
                        <span class="font-black uppercase text-xs tracking-widest text-gray-700">ESTIMATED DELIVERY TIME</span>
                    </div>
                    <div class="flex gap-3">
                        <input type="text" placeholder="Enter your zipcode" class="flex-grow border-2 border-gray-200 rounded-xl px-5 py-3 focus:ring-2 focus:ring-yellow-400 focus:border-transparent outline-none font-bold text-gray-700 placeholder:text-gray-400 transition-all">
                        <button class="bg-black text-white px-8 py-3 rounded-xl font-black uppercase text-xs hover:bg-gray-800 transition-all active:scale-95">Check</button>
                    </div>
                </div>

                <!-- Spiritual Heading (From Screenshot) -->
                <div class="pt-8 text-center lg:text-left">
                    <h2 class="text-3xl lg:text-xl font-extrabold text-[#D4AF37] leading-tight">
                        Spiritual Vibe for a Calm Mind & Strong Willpower
                    </h2>
                </div>

                <!-- Accordion Sections -->
                <div class="divide-y divide-gray-100 border-t border-b border-gray-100 mt-8">
                    <!-- Description -->
                    <div class="accordion-item py-6 active">
                        <button class="w-full flex items-center justify-between text-left group outline-none" onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center group-hover:bg-yellow-50 transition-colors">
                                    <i class="fas fa-list-ul text-gray-400 group-hover:text-yellow-600 transition-colors"></i>
                                </div>
                                <span class="text-xl font-black text-gray-800 tracking-tight">Description</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-300 transition-transform duration-300 group-hover:text-gray-600"></i>
                        </button>
                        <div class="accordion-content">
                            <div class="pt-6 text-gray-600 font-medium leading-relaxed space-y-4">
                                <p><?php echo $product['description']; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Got any questions -->
                    <div class="accordion-item py-6">
                        <button class="w-full flex items-center justify-between text-left group outline-none" onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center group-hover:bg-yellow-50 transition-colors">
                                    <i class="far fa-question-circle text-gray-400 group-hover:text-yellow-600 transition-colors"></i>
                                </div>
                                <span class="text-xl font-black text-gray-800 tracking-tight">Got any questions</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-300 transition-transform duration-300 group-hover:text-gray-600"></i>
                        </button>
                        <div class="accordion-content">
                            <div class="pt-6 text-gray-600 font-medium leading-relaxed">
                                <?= !empty($product['gotanyquestion']) ? $product['gotanyquestion'] : 'How to wear? It can be worn on either hand. Is it certified? Yes, all our products are lab certified.'; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Return and Exchange -->
                    <div class="accordion-item py-6">
                        <button class="w-full flex items-center justify-between text-left group outline-none" onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center group-hover:bg-yellow-50 transition-colors">
                                    <i class="fas fa-box-open text-gray-400 group-hover:text-yellow-600 transition-colors"></i>
                                </div>
                                <span class="text-xl font-black text-gray-800 tracking-tight">Return and Exchange</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-300 transition-transform duration-300 group-hover:text-gray-600"></i>
                        </button>
                        <div class="accordion-content">
                            <div class="pt-6 text-gray-600 font-medium leading-relaxed">
                                <?= !empty($product['returnexchange']) ? $product['returnexchange'] : 'We offer a 7-day return and exchange policy for all our products.'; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Disclaimer -->
                    <div class="accordion-item py-6">
                        <button class="w-full flex items-center justify-between text-left group outline-none" onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center group-hover:bg-yellow-50 transition-colors">
                                    <i class="fas fa-info-circle text-gray-400 group-hover:text-yellow-600 transition-colors"></i>
                                </div>
                                <span class="text-xl font-black text-gray-800 tracking-tight">Disclaimer</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-300 transition-transform duration-300 group-hover:text-gray-600"></i>
                        </button>
                        <div class="accordion-content">
                            <div class="pt-6 text-gray-500 font-medium italic leading-relaxed text-sm">
                                <?php echo $product['disclaimer']; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>


<?php include('includes/footer.php'); ?>

<!-- Floating WhatsApp Button -->
<a href="#" class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-2xl hover:bg-green-600 transition-all z-50">
    <i class="fab fa-whatsapp text-3xl"></i>
</a>

<script>
    function changeImage(src, element) {
        document.getElementById('main-product-image').src = src;
        
        // Update active thumbnail state
        document.querySelectorAll('.thumbnail-item').forEach(item => {
            item.classList.remove('thumbnail-active');
        });
        element.classList.add('thumbnail-active');
    }

    function toggleAccordion(button) {
        const item = button.parentElement;
        const isActive = item.classList.contains('active');
        
        // Optional: Close other accordions
        // document.querySelectorAll('.accordion-item').forEach(i => i.classList.remove('active'));
        
        if (isActive) {
            item.classList.remove('active');
        } else {
            item.classList.add('active');
        }
    }

    function updateQty(delta) {
        const input = document.getElementById('quantity');
        let val = parseInt(input.value) + delta;
        if (val < 1) val = 1;
        input.value = val;
    }
</script>

</body>
</html>
