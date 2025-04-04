document.addEventListener('DOMContentLoaded', function() {
    // Quick View
    const quickViewBtns = document.querySelectorAll('.quick-view-btn');
    
    if (quickViewBtns.length) {
        quickViewBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.dataset.productId;
                window.location.href = `/project/product/${productId}`;
            });
        });
    }
    
    // View Toggle
    const viewBtns = document.querySelectorAll('.view-btn');
    const productsGrid = document.querySelector('.products-grid');
    
    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            viewBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            if (this.dataset.view === 'list') {
                productsGrid.classList.add('list-view');
            } else {
                productsGrid.classList.remove('list-view');
            }
            
            // Save view preference
            localStorage.setItem('productView', this.dataset.view);
        });
    });
    
    // Load saved view preference
    const savedView = localStorage.getItem('productView');
    if (savedView) {
        const btn = document.querySelector(`[data-view="${savedView}"]`);
        if (btn) btn.click();
    }
    
    // Filter Toggle (Mobile)
    const filterToggle = document.querySelector('.filter-toggle');
    const filters = document.querySelector('.filters');
    
    if (filterToggle && filters) {
        filterToggle.addEventListener('click', function() {
            filters.classList.toggle('active');
        });
        
        // Close filters when clicking outside
        document.addEventListener('click', function(e) {
            if (!filters.contains(e.target) && !filterToggle.contains(e.target)) {
                filters.classList.remove('active');
            }
        });
    }
    
    // Sort Products
    const sortSelect = document.querySelector('.sort-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const url = new URL(window.location);
            url.searchParams.set('sort', this.value);
            window.location = url;
        });
    }
    
    // Filter Form Submit
    const filterForm = document.querySelector('.filter-form');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const params = new URLSearchParams();
            
            for (let [key, value] of formData.entries()) {
                if (value) {
                    params.append(key, value);
                }
            }
            
            window.location.search = params.toString();
        });
    }
    
    // Price Range Slider
    const priceRange = document.querySelector('.price-range');
    const minPrice = document.querySelector('.min-price');
    const maxPrice = document.querySelector('.max-price');
    
    if (priceRange && minPrice && maxPrice) {
        noUiSlider.create(priceRange, {
            start: [
                parseInt(minPrice.dataset.value || 0),
                parseInt(maxPrice.dataset.value || 1000000)
            ],
            connect: true,
            range: {
                'min': 0,
                'max': 1000000
            },
            format: {
                to: value => Math.round(value),
                from: value => Math.round(value)
            }
        });
        
        priceRange.noUiSlider.on('update', function(values) {
            minPrice.value = values[0];
            maxPrice.value = values[1];
            
            // Update price display
            document.querySelector('.min-price-display').textContent = 
                new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' })
                    .format(values[0]);
            document.querySelector('.max-price-display').textContent = 
                new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' })
                    .format(values[1]);
        });
    }
    
    // Add to Cart
    const addToCartBtns = document.querySelectorAll('.add-to-cart-btn');
    
    addToCartBtns.forEach(btn => {
        btn.addEventListener('click', async function(e) {
            e.preventDefault();
            const productId = this.dataset.productId;
            
            try {
                btn.classList.add('loading');
                
                const response = await fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: 1
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Show success message
                    showNotification('success', 'Product added to cart successfully');
                    
                    // Update cart count
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.cartCount;
                    }
                } else {
                    throw new Error(data.message || 'Could not add product to cart');
                }
            } catch (error) {
                console.error('Add to cart error:', error);
                showNotification('error', error.message || 'Could not add product to cart');
            } finally {
                btn.classList.remove('loading');
            }
        });
    });
    
    // Wishlist Toggle
    const wishlistBtns = document.querySelectorAll('.wishlist-btn');
    
    wishlistBtns.forEach(btn => {
        btn.addEventListener('click', async function(e) {
            e.preventDefault();
            const productId = this.dataset.productId;
            
            try {
                btn.classList.add('loading');
                
                const response = await fetch('/wishlist/toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ product_id: productId })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    btn.classList.toggle('active');
                    showNotification('success', data.message);
                } else {
                    throw new Error(data.message || 'Could not update wishlist');
                }
            } catch (error) {
                console.error('Wishlist error:', error);
                showNotification('error', error.message || 'Could not update wishlist');
            } finally {
                btn.classList.remove('loading');
            }
        });
    });
    
    // Infinite Scroll
    let loading = false;
    let page = 1;
    const loadMoreThreshold = 300; // pixels from bottom
    
    function loadMoreProducts() {
        if (loading) return;
        
        const scrollPosition = window.innerHeight + window.pageYOffset;
        const pageBottom = document.documentElement.offsetHeight - loadMoreThreshold;
        
        if (scrollPosition >= pageBottom) {
            loading = true;
            page++;
            
            const url = new URL(window.location);
            url.searchParams.set('page', page);
            url.searchParams.set('ajax', '1');
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.html) {
                        productsGrid.insertAdjacentHTML('beforeend', data.html);
                        loading = false;
                    } else {
                        // No more products, remove scroll listener
                        window.removeEventListener('scroll', loadMoreProducts);
                    }
                })
                .catch(error => {
                    console.error('Load more error:', error);
                    loading = false;
                });
        }
    }
    
    // Enable infinite scroll if element exists
    if (document.querySelector('.enable-infinite-scroll')) {
        window.addEventListener('scroll', loadMoreProducts);
    }
    
    // Notification Helper
    function showNotification(type, message) {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Trigger animation
        setTimeout(() => notification.classList.add('show'), 100);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
}); 