<!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-social mb-4">
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                    <h4 class="footer-title">Astrologerrajeev's Commitment</h4>
                    <p class="footer-description">
                        we promise authenticity, intention, and care in everything we create. Every product is pure, ethically sourced, and crafted to help you reconnect with yourself — while also giving back through our Karma & Destiny initiative.
                    </p>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5 class="footer-title">Policies</h5>
                    <ul class="footer-links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Return and Refund Policy</a></li>
                        <li><a href="#">Shipping Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5 class="footer-title">Collections</h5>
                    <ul class="footer-links">
                        <li><a href="#">Bracelets</a></li>
                        <li><a href="#">Rudraksha</a></li>
                        <li><a href="#">Gemstones</a></li>
                        <li><a href="#">Yantras</a></li>
                        <li><a href="#">Pendants</a></li>
                        <li><a href="#">Trees</a></li>
                        <li><a href="#">Puja Products</a></li>
                        <li><a href="#">Towers & Tumbles</a></li>
                        <li><a href="#">Gifts</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Track Order</a></li>
                        <li><a href="#">Blogs</a></li>
                        <li><a href="#">Sitemap</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5 class="footer-title">Shop By Purpose</h5>
                    <ul class="footer-links">
                        <li><a href="#">Love</a></li>
                        <li><a href="#">Money</a></li>
                        <li><a href="#">Career</a></li>
                        <li><a href="#">Health</a></li>
                        <li><a href="#">Marriage</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2026, Astrologerrajeev | Designed & Developed by <a href="https://makes360.com">Makes360</a></p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/919999999999" class="whatsapp-btn" target="_blank" aria-label="WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Hero Swiper
        const heroSwiper = new Swiper('.hero-swiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            }
        });

        // Testimonials Swiper
        const testimonialsSwiper = new Swiper('.testimonials-swiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 24,
            navigation: {
                nextEl: '.testimonials-swiper .swiper-button-next',
                prevEl: '.testimonials-swiper .swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                }
            }
        });

        // Quantity functions
        function increaseQty() {
            const input = document.getElementById('qtyInput');
            let value = parseInt(input.value);
            input.value = value + 1;
        }

        function decreaseQty() {
            const input = document.getElementById('qtyInput');
            let value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        }

        // Featured product thumbnail gallery
        const thumbs = document.querySelectorAll('.featured-thumb');
        const mainImg = document.getElementById('featuredMainImg');

        thumbs.forEach(thumb => {
            thumb.addEventListener('click', function() {
                thumbs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                mainImg.src = this.querySelector('img').src.replace('100', '500');
            });
        });

        // GSAP Animations
        gsap.registerPlugin(ScrollTrigger);

        // Animate product cards on scroll
        gsap.utils.toArray('.product-card').forEach(card => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                },
                y: 50,
                opacity: 0,
                duration: 0.6,
                ease: 'power2.out'
            });
        });

        // Sticky header effect
        const header = document.querySelector('.main-header');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                header.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
            } else {
                header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.05)';
            }
            
            lastScroll = currentScroll;
        });

        // Add to cart animation
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-check"></i> Added!';
                this.style.background = '#4CAF50';
                
                setTimeout(() => {
                    this.innerHTML = 'Add to Cart';
                    this.style.background = '#F5C518';
                }, 2000);
            });
        });

        // Mobile menu toggle
        
    </script>
</body>
</html>
