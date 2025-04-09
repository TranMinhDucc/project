document.addEventListener('DOMContentLoaded', function() {
    // Price range slider
    initPriceRangeSlider();
    
    // Mobile filter toggle
    initMobileFilterToggle();
    
    // Initialize search suggestions
    initSearchSuggestions();
});

/**
 * Initialize price range slider
 */
function initPriceRangeSlider() {
    const priceRange = document.querySelector('.price-range');
    if (!priceRange) return;
    
    const minPrice = parseInt(priceRange.dataset.min);
    const maxPrice = parseInt(priceRange.dataset.max);
    const minPriceInput = document.querySelector('.min-price');
    const maxPriceInput = document.querySelector('.max-price');
    const minPriceDisplay = document.querySelector('.min-price-display');
    const maxPriceDisplay = document.querySelector('.max-price-display');
    
    // Set initial values
    const currentMinPrice = minPriceInput.value ? parseInt(minPriceInput.value) : minPrice;
    const currentMaxPrice = maxPriceInput.value ? parseInt(maxPriceInput.value) : maxPrice;
    
    // Create slider elements
    const sliderTrack = document.createElement('div');
    sliderTrack.className = 'slider-track';
    priceRange.appendChild(sliderTrack);
    
    const minHandle = document.createElement('div');
    minHandle.className = 'slider-handle min-handle';
    priceRange.appendChild(minHandle);
    
    const maxHandle = document.createElement('div');
    maxHandle.className = 'slider-handle max-handle';
    priceRange.appendChild(maxHandle);
    
    // Set initial positions
    const minPosition = ((currentMinPrice - minPrice) / (maxPrice - minPrice)) * 100;
    const maxPosition = ((currentMaxPrice - minPrice) / (maxPrice - minPrice)) * 100;
    
    minHandle.style.left = `${minPosition}%`;
    maxHandle.style.left = `${maxPosition}%`;
    sliderTrack.style.left = `${minPosition}%`;
    sliderTrack.style.width = `${maxPosition - minPosition}%`;
    
    // Update price displays
    minPriceDisplay.textContent = formatPrice(currentMinPrice);
    maxPriceDisplay.textContent = formatPrice(currentMaxPrice);
    
    // Handle drag events
    let isDragging = false;
    let activeHandle = null;
    
    minHandle.addEventListener('mousedown', function(e) {
        isDragging = true;
        activeHandle = minHandle;
        e.preventDefault();
    });
    
    maxHandle.addEventListener('mousedown', function(e) {
        isDragging = true;
        activeHandle = maxHandle;
        e.preventDefault();
    });
    
    document.addEventListener('mousemove', function(e) {
        if (!isDragging) return;
        
        const rect = priceRange.getBoundingClientRect();
        const position = Math.max(0, Math.min(100, ((e.clientX - rect.left) / rect.width) * 100));
        
        if (activeHandle === minHandle) {
            const maxPosition = parseFloat(maxHandle.style.left);
            if (position <= maxPosition) {
                minHandle.style.left = `${position}%`;
                sliderTrack.style.left = `${position}%`;
                sliderTrack.style.width = `${maxPosition - position}%`;
                
                const newMinPrice = Math.round(minPrice + (position / 100) * (maxPrice - minPrice));
                minPriceInput.value = newMinPrice;
                minPriceDisplay.textContent = formatPrice(newMinPrice);
            }
        } else {
            const minPosition = parseFloat(minHandle.style.left);
            if (position >= minPosition) {
                maxHandle.style.left = `${position}%`;
                sliderTrack.style.width = `${position - minPosition}%`;
                
                const newMaxPrice = Math.round(minPrice + (position / 100) * (maxPrice - minPrice));
                maxPriceInput.value = newMaxPrice;
                maxPriceDisplay.textContent = formatPrice(newMaxPrice);
            }
        }
    });
    
    document.addEventListener('mouseup', function() {
        isDragging = false;
        activeHandle = null;
    });
}

/**
 * Format price with thousand separator
 */
function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '₫';
}

/**
 * Initialize mobile filter toggle
 */
function initMobileFilterToggle() {
    const filterToggle = document.createElement('button');
    filterToggle.className = 'filter-toggle';
    filterToggle.innerHTML = '<i class="fas fa-filter"></i> Bộ lọc';
    
    const productControls = document.querySelector('.product-controls');
    if (productControls) {
        productControls.prepend(filterToggle);
    }
    
    const filters = document.querySelector('.filters');
    if (!filters) return;
    
    filterToggle.addEventListener('click', function() {
        filters.classList.toggle('active');
    });
    
    // Close filters when clicking outside
    document.addEventListener('click', function(e) {
        if (!filters.contains(e.target) && !filterToggle.contains(e.target) && filters.classList.contains('active')) {
            filters.classList.remove('active');
        }
    });
}

/**
 * Initialize search suggestions
 */
function initSearchSuggestions() {
    const searchInput = document.querySelector('.search-box input');
    const searchForm = document.querySelector('.search-box form');
    const suggestionsContainer = document.createElement('div');
    suggestionsContainer.className = 'search-suggestions';
    searchForm.appendChild(suggestionsContainer);

    let searchTimeout;

    // Handle search input
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();

        if (query.length < 2) {
            suggestionsContainer.style.display = 'none';
            return;
        }

        // Add debounce to prevent too many requests
        searchTimeout = setTimeout(() => {
            fetchSearchSuggestions(query);
        }, 300);
    });

    // Handle form submission
    searchForm.addEventListener('submit', function(e) {
        const query = searchInput.value.trim();
        if (!query) {
            e.preventDefault();
            return;
        }
        suggestionsContainer.style.display = 'none';
    });

    // Close suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchForm.contains(e.target)) {
            suggestionsContainer.style.display = 'none';
        }
    });

    // Fetch search suggestions
    function fetchSearchSuggestions(query) {
        fetch(`/project/api/search-suggestions?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if (data.suggestions && data.suggestions.length > 0) {
                    displaySuggestions(data.suggestions);
                } else {
                    suggestionsContainer.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error fetching suggestions:', error);
                suggestionsContainer.style.display = 'none';
            });
    }

    // Display search suggestions
    function displaySuggestions(suggestions) {
        suggestionsContainer.innerHTML = '';
        
        suggestions.forEach(suggestion => {
            const item = document.createElement('div');
            item.className = 'suggestion-item';
            item.textContent = suggestion.name;
            
            item.addEventListener('click', () => {
                searchInput.value = suggestion.name;
                suggestionsContainer.style.display = 'none';
                searchForm.submit();
            });
            
            suggestionsContainer.appendChild(item);
        });
        
        suggestionsContainer.style.display = 'block';
    }
} 