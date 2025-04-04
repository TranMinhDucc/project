document.addEventListener('DOMContentLoaded', function() {
    // Image Gallery
    const mainImage = document.getElementById('main-product-image');
    const thumbnails = document.querySelectorAll('.thumbnail');
    
    if (thumbnails.length > 0 && mainImage) {
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                const imageUrl = this.getAttribute('data-image');
                mainImage.src = imageUrl;
                
                // Update active thumbnail
                thumbnails.forEach(thumb => thumb.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Set first thumbnail as active
        thumbnails[0].classList.add('active');
    }
    
    // Color Selection
    const colorOptions = document.querySelectorAll('.color-option:not(.out-of-stock)');
    
    if (colorOptions.length > 0) {
        colorOptions.forEach(option => {
            option.addEventListener('click', function() {
                colorOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
        
        // Select first available color by default
        colorOptions[0].classList.add('selected');
    }
    
    // Size Selection
    const sizeOptions = document.querySelectorAll('.size-option:not(.out-of-stock)');
    
    if (sizeOptions.length > 0) {
        sizeOptions.forEach(option => {
            option.addEventListener('click', function() {
                sizeOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
        
        // Select first available size by default
        sizeOptions[0].classList.add('selected');
    }
    
    // Quantity Selection
    const quantityInput = document.getElementById('quantity');
    const minusBtn = document.querySelector('.quantity-btn.minus');
    const plusBtn = document.querySelector('.quantity-btn.plus');
    
    if (quantityInput && minusBtn && plusBtn) {
        minusBtn.addEventListener('click', function() {
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                quantityInput.value = value - 1;
            }
        });
        
        plusBtn.addEventListener('click', function() {
            let value = parseInt(quantityInput.value);
            if (value < 10) {
                quantityInput.value = value + 1;
            }
        });
        
        quantityInput.addEventListener('change', function() {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            } else if (value > 10) {
                this.value = 10;
            }
        });
    }
    
    // Tabs
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    if (tabButtons.length > 0 && tabContents.length > 0) {
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                
                // Update active tab button
                tabButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Show corresponding tab content
                tabContents.forEach(content => {
                    content.classList.remove('active');
                    if (content.id === tabId) {
                        content.classList.add('active');
                    }
                });
            });
        });
    }
    
    // Xử lý hiệu ứng zoom khi di chuột qua ảnh chính
    const mainImageContainer = document.querySelector('.main-image');
    
    if (mainImageContainer && mainImage) {
        mainImageContainer.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            // Tính toán vị trí zoom
            const xPercent = x / rect.width * 100;
            const yPercent = y / rect.height * 100;
            
            // Áp dụng hiệu ứng zoom
            mainImage.style.transformOrigin = `${xPercent}% ${yPercent}%`;
        });
        
        // Reset zoom khi di chuột ra khỏi ảnh
        mainImageContainer.addEventListener('mouseleave', function() {
            mainImage.style.transformOrigin = 'center center';
        });
    }
    
    // Add to Cart
    const addToCartBtn = document.querySelector('.add-to-cart-btn');
    
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function() {
            // Get selected color and size
            const selectedColor = document.querySelector('.color-option.selected');
            const selectedSize = document.querySelector('.size-option.selected');
            
            if (colorOptions.length > 0 && !selectedColor) {
                alert('Vui lòng chọn màu sắc');
                return;
            }
            
            if (sizeOptions.length > 0 && !selectedSize) {
                alert('Vui lòng chọn kích thước');
                return;
            }
            
            // Get product details
            const productId = window.location.pathname.split('/').pop();
            const quantity = quantityInput ? parseInt(quantityInput.value) : 1;
            const colorId = selectedColor ? selectedColor.getAttribute('data-color-id') : null;
            const sizeId = selectedSize ? selectedSize.getAttribute('data-size-id') : null;
            
            // Add to cart logic (AJAX request)
            // This is a placeholder for the actual implementation
            console.log('Adding to cart:', {
                productId,
                quantity,
                colorId,
                sizeId
            });
            
            // Show success message
            alert('Đã thêm sản phẩm vào giỏ hàng');
            
            // Update cart count
            const cartCount = document.querySelector('.cart-count');
            if (cartCount) {
                const currentCount = parseInt(cartCount.textContent);
                cartCount.textContent = currentCount + quantity;
            }
        });
    }
    
    // Buy Now
    const buyNowBtn = document.querySelector('.buy-now-btn');
    
    if (buyNowBtn) {
        buyNowBtn.addEventListener('click', function() {
            // Similar logic as Add to Cart
            const selectedColor = document.querySelector('.color-option.selected');
            const selectedSize = document.querySelector('.size-option.selected');
            
            if (colorOptions.length > 0 && !selectedColor) {
                alert('Vui lòng chọn màu sắc');
                return;
            }
            
            if (sizeOptions.length > 0 && !selectedSize) {
                alert('Vui lòng chọn kích thước');
                return;
            }
            
            // Redirect to checkout page
            // This is a placeholder for the actual implementation
            console.log('Buying now');
            window.location.href = '/checkout';
        });
    }
    
    // Wishlist
    const wishlistBtn = document.querySelector('.wishlist-btn');
    
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', function() {
            const icon = this.querySelector('i');
            
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                icon.style.color = '#dc3545';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                icon.style.color = '';
            }
            
            // Add to wishlist logic (AJAX request)
            // This is a placeholder for the actual implementation
            console.log('Toggling wishlist');
        });
    }
    
    // Write Review
    const writeReviewBtn = document.querySelector('.write-review-btn');
    
    if (writeReviewBtn) {
        writeReviewBtn.addEventListener('click', function() {
            // Redirect to review form or show modal
            // This is a placeholder for the actual implementation
            console.log('Writing review');
            alert('Tính năng đang được phát triển');
        });
    }
    
    // Size Guide
    const sizeGuideLink = document.querySelector('.size-guide-link');
    
    if (sizeGuideLink) {
        sizeGuideLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Show size guide modal or redirect to size guide page
            // This is a placeholder for the actual implementation
            console.log('Showing size guide');
            alert('Hướng dẫn chọn size đang được cập nhật');
        });
    }
    
    // Related Products
    const relatedProductLinks = document.querySelectorAll('.related-products .product-card');
    
    if (relatedProductLinks.length > 0) {
        relatedProductLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Only navigate if not clicking on action buttons
                if (!e.target.closest('.action-btn')) {
                    const productId = this.getAttribute('data-product-id');
                    window.location.href = `/product/${productId}`;
                }
            });
        });
    }
    
    // Handle image loading errors
    const productImages = document.querySelectorAll('.product-images img');
    
    productImages.forEach(img => {
        img.addEventListener('error', function() {
            this.src = '../images/placeholder.jpg';
            this.alt = 'Không thể tải hình ảnh';
        });
    });
}); 