document.addEventListener('DOMContentLoaded', function() {
    // Hero Slider
    initHeroSlider();
    
    // Product Filters
    initProductFilters();
    
    // Testimonial Slider
    initTestimonialSlider();
    
    // Newsletter Form
    initNewsletterForm();
    
    // Mobile Menu Toggle
    initMobileMenu();
});

// Hero Slider
function initHeroSlider() {
    const slides = document.querySelectorAll('.hero-slider .slide');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    let currentSlide = 0;
    
    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        
        // Handle circular navigation
        if (index >= slides.length) {
            currentSlide = 0;
        } else if (index < 0) {
            currentSlide = slides.length - 1;
        } else {
            currentSlide = index;
        }
        
        slides[currentSlide].classList.add('active');
    }
    
    // Auto slide change
    let slideInterval = setInterval(() => {
        showSlide(currentSlide + 1);
    }, 5000);
    
    // Reset interval when manually changing slides
    function resetInterval() {
        clearInterval(slideInterval);
        slideInterval = setInterval(() => {
            showSlide(currentSlide + 1);
        }, 5000);
    }
    
    // Event listeners for buttons
    if (prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => {
            showSlide(currentSlide - 1);
            resetInterval();
        });
        
        nextBtn.addEventListener('click', () => {
            showSlide(currentSlide + 1);
            resetInterval();
        });
    }
}

// Product Filters
function initProductFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.product-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const filter = btn.getAttribute('data-filter');
            
            // Show/hide products based on filter
            productCards.forEach(card => {
                if (filter === 'all') {
                    card.style.display = 'block';
                } else {
                    const categories = card.getAttribute('data-category').split(' ');
                    if (categories.includes(filter)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });
}

// Testimonial Slider
function initTestimonialSlider() {
    const testimonials = document.querySelectorAll('.testimonial-card');
    const dots = document.querySelectorAll('.testimonial-dots .dot');
    let currentTestimonial = 0;
    
    function showTestimonial(index) {
        testimonials.forEach(testimonial => testimonial.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Handle circular navigation
        if (index >= testimonials.length) {
            currentTestimonial = 0;
        } else if (index < 0) {
            currentTestimonial = testimonials.length - 1;
        } else {
            currentTestimonial = index;
        }
        
        testimonials[currentTestimonial].classList.add('active');
        dots[currentTestimonial].classList.add('active');
    }
    
    // Auto testimonial change
    let testimonialInterval = setInterval(() => {
        showTestimonial(currentTestimonial + 1);
    }, 6000);
    
    // Click event for dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showTestimonial(index);
            clearInterval(testimonialInterval);
            testimonialInterval = setInterval(() => {
                showTestimonial(currentTestimonial + 1);
            }, 6000);
        });
    });
}

// Newsletter Form
function initNewsletterForm() {
    const newsletterForm = document.querySelector('.newsletter-form');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            // Simple validation
            if (email && email.includes('@')) {
                // Here you would typically send the data to a server
                // For now, we'll just show an alert
                alert('Cảm ơn bạn đã đăng ký! Chúng tôi sẽ gửi thông tin đến ' + email);
                this.reset();
            } else {
                alert('Vui lòng nhập địa chỉ email hợp lệ');
            }
        });
    }
}

// Mobile Menu Toggle
function initMobileMenu() {
    const header = document.querySelector('header');
    
    if (window.innerWidth <= 768) {
        // Create mobile menu button
        const mobileMenuBtn = document.createElement('button');
        mobileMenuBtn.className = 'mobile-menu-btn';
        mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
        
        const mainNav = document.querySelector('.main-nav');
        mainNav.style.display = 'none';
        
        // Add button to header
        const headerWrapper = document.querySelector('.header-wrapper');
        headerWrapper.insertBefore(mobileMenuBtn, mainNav);
        
        // Toggle menu on click
        mobileMenuBtn.addEventListener('click', () => {
            if (mainNav.style.display === 'none') {
                mainNav.style.display = 'block';
                mobileMenuBtn.innerHTML = '<i class="fas fa-times"></i>';
            } else {
                mainNav.style.display = 'none';
                mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
            }
        });
    }
}

// Add to cart functionality
document.querySelectorAll('.action-btn').forEach(btn => {
    if (btn.querySelector('.fa-shopping-cart')) {
        btn.addEventListener('click', function() {
            const productCard = this.closest('.product-card');
            const productName = productCard.querySelector('.product-name').textContent;
            
            // Update cart count
            const cartCount = document.querySelector('.cart-count');
            cartCount.textContent = parseInt(cartCount.textContent) + 1;
            
            // Show notification
            alert(`Đã thêm ${productName} vào giỏ hàng!`);
        });
    }
});

// Wishlist functionality
document.querySelectorAll('.action-btn').forEach(btn => {
    if (btn.querySelector('.fa-heart')) {
        btn.addEventListener('click', function() {
            this.classList.toggle('active');
            const isActive = this.classList.contains('active');
            
            if (isActive) {
                this.style.backgroundColor = '#ff6b6b';
                this.style.color = 'white';
            } else {
                this.style.backgroundColor = 'white';
                this.style.color = '#2f3640';
            }
        });
    }
});

// Quick view functionality
document.querySelectorAll('.action-btn').forEach(btn => {
    if (btn.querySelector('.fa-eye')) {
        btn.addEventListener('click', function() {
            const productCard = this.closest('.product-card');
            const productName = productCard.querySelector('.product-name').textContent;
            const productPrice = productCard.querySelector('.product-price').textContent;
            const productImg = productCard.querySelector('.product-img img').src;
            
            // Here you would typically open a modal with product details
            // For simplicity, we'll just show an alert
            alert(`Quick view: ${productName} - ${productPrice}`);
        });
    }
});
// Sticky Header
let lastScrollTop = 0;
const header = document.querySelector('header');
const scrollThreshold = 100;

window.addEventListener('scroll', function() {
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    
    // Add sticky class when scrolled
    if (currentScroll > 10) {
        header.classList.add('sticky');
    } else {
        header.classList.remove('sticky');
    }
    
    // Hide/show header based on scroll direction
    if (currentScroll > lastScrollTop && currentScroll > scrollThreshold) {
        // Scrolling down
        header.classList.add('hide');
    } else {
        // Scrolling up
        header.classList.remove('hide');
    }
    
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
}, false);
