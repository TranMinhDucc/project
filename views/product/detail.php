<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - ShoesStyle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/project/views/css/style.css">
    <link rel="stylesheet" href="/project/views/css/product-detail.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="/project/">
                        <h1>ShoesStyle</h1>
                    </a>
                </div>
                
                <nav class="main-nav">
                    <ul>
                        <li><a href="/project/">Trang chủ</a></li>
                        <li><a href="/project/collections/men">Nam</a></li>
                        <li><a href="/project/collections/women">Nữ</a></li>
                        <li><a href="/project/collections/kids">Trẻ em</a></li>
                        <li><a href="/project/collections/sport">Thể thao</a></li>
                        <li><a href="/project/sale">Khuyến mãi</a></li>
                    </ul>
                </nav>
                
                <div class="header-actions">
                    <div class="search-box">
                        <input type="text" placeholder="Tìm kiếm...">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                    <div class="user-actions">
                        <a href="/project/account" class="icon-btn"><i class="fas fa-user"></i></a>
                        <a href="/project/cart" class="icon-btn cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count">0</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="/project/">Trang chủ</a></li>
                <li><a href="/project/collections/<?php echo strtolower($product['category_name']); ?>"><?php echo htmlspecialchars($product['category_name']); ?></a></li>
                <li class="active"><?php echo htmlspecialchars($product['name']); ?></li>
            </ul>
        </div>
    </div>

    <!-- Product Detail -->
    <section class="product-detail">
        <div class="container">
            <div class="product-detail-wrapper">
                <!-- Product Images -->
                <div class="product-images">
                    <div class="main-image">
                        <?php if (!empty($images)): ?>
                            <img src="<?php echo htmlspecialchars($images[0]['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" id="main-product-image">
                        <?php else: ?>
                            <img src="../images/placeholder.jpg" alt="Không có hình ảnh" id="main-product-image">
                        <?php endif; ?>
                    </div>
                    
                    <?php if (count($images) > 1): ?>
                        <div class="thumbnail-images">
                            <?php foreach ($images as $index => $image): ?>
                                <div class="thumbnail" data-image="<?php echo htmlspecialchars($image['image_url']); ?>">
                                    <img src="<?php echo htmlspecialchars($image['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?> - Hình <?php echo $index + 1; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Product Info -->
                <div class="product-info">
                    <div class="product-header">
                        <h1 class="product-name"><?php echo isset($product['name']) ? htmlspecialchars($product['name']) : 'Sản phẩm không xác định'; ?></h1>
                        <div class="product-brand"><?php echo isset($product['brand_name']) ? htmlspecialchars($product['brand_name']) : 'Chưa cập nhật'; ?></div>
                    </div>
                    
                    <div class="product-rating">
                        <div class="stars">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php if ($i <= $averageRating): ?>
                                    <i class="fas fa-star"></i>
                                <?php elseif ($i - 0.5 <= $averageRating): ?>
                                    <i class="fas fa-star-half-alt"></i>
                                <?php else: ?>
                                    <i class="far fa-star"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <div class="rating-count">
                            <span><?php echo count($reviews); ?> đánh giá</span>
                            <a href="#reviews" class="review-link">Xem tất cả</a>
                        </div>
                    </div>
                    
                    <div class="product-price">
                        <?php if (isset($product['discount_price']) && $product['discount_price'] > 0): ?>
                            <span class="old-price"><?php echo number_format($product['price'], 0, ',', '.'); ?>₫</span>
                            <span class="current-price"><?php echo number_format($product['discount_price'], 0, ',', '.'); ?>₫</span>
                            <span class="discount-badge">-<?php echo round((($product['price'] - $product['discount_price']) / $product['price']) * 100); ?>%</span>
                        <?php else: ?>
                            <span class="current-price"><?php echo isset($product['price']) ? number_format($product['price'], 0, ',', '.') : '0'; ?>₫</span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="product-description">
                        <h3>Mô tả sản phẩm</h3>
                        <div class="description-content">
                            <?php if (isset($product['description']) && !empty($product['description'])): ?>
                                <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                            <?php else: ?>
                                <p>Chưa có mô tả cho sản phẩm này.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Color Selection -->
                    <?php if (!empty($colors)): ?>
                        <div class="product-colors">
                            <h3>Màu sắc</h3>
                            <div class="color-options">
                                <?php foreach ($colors as $color): ?>
                                    <div class="color-option <?php echo $color['stock'] <= 0 ? 'out-of-stock' : ''; ?>" data-color-id="<?php echo $color['id']; ?>">
                                        <div class="color-swatch" style="background-color: <?php echo htmlspecialchars($color['color_code']); ?>"></div>
                                        <span class="color-name"><?php echo htmlspecialchars($color['color_name']); ?></span>
                                        <?php if ($color['stock'] <= 0): ?>
                                            <span class="out-of-stock-label">Hết hàng</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Size Selection -->
                    <?php if (!empty($sizes)): ?>
                        <div class="product-sizes">
                            <h3>Kích thước</h3>
                            <div class="size-options">
                                <?php foreach ($sizes as $size): ?>
                                    <div class="size-option <?php echo $size['stock'] <= 0 ? 'out-of-stock' : ''; ?>" data-size-id="<?php echo $size['id']; ?>">
                                        <span class="size-value"><?php echo htmlspecialchars($size['size']); ?></span>
                                        <?php if ($size['stock'] <= 0): ?>
                                            <span class="out-of-stock-label">Hết hàng</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="size-guide">
                                <a href="#" class="size-guide-link">Hướng dẫn chọn size</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Quantity Selection -->
                    <div class="product-quantity">
                        <h3>Số lượng</h3>
                        <div class="quantity-selector">
                            <button class="quantity-btn minus"><i class="fas fa-minus"></i></button>
                            <input type="number" id="quantity" value="1" min="1" max="10">
                            <button class="quantity-btn plus"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    
                    <!-- Add to Cart -->
                    <div class="product-actions">
                        <button class="add-to-cart-btn">
                            <i class="fas fa-shopping-cart"></i>
                            Thêm vào giỏ hàng
                        </button>
                        <button class="buy-now-btn">
                            Mua ngay
                        </button>
                        <button class="wishlist-btn">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    
                    <!-- Product Features -->
                    <div class="product-features">
                        <div class="feature">
                            <i class="fas fa-truck"></i>
                            <span>Miễn phí vận chuyển cho đơn hàng trên 500.000₫</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-undo"></i>
                            <span>Đổi trả miễn phí trong 30 ngày</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-shield-alt"></i>
                            <span>Bảo hành chính hãng 12 tháng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Tabs -->
    <section class="product-tabs">
        <div class="container">
            <div class="tabs-header">
                <button class="tab-btn active" data-tab="details">Chi tiết sản phẩm</button>
                <button class="tab-btn" data-tab="specifications">Thông số kỹ thuật</button>
                <button class="tab-btn" data-tab="reviews">Đánh giá (<?php echo count($reviews); ?>)</button>
            </div>
            
            <div class="tabs-content">
                <!-- Details Tab -->
                <div class="tab-content active" id="details">
                    <div class="product-details">
                        <?php if (isset($product['details']) && !empty($product['details'])): ?>
                            <?php echo nl2br(htmlspecialchars($product['details'])); ?>
                        <?php else: ?>
                            <p>Chưa có thông tin chi tiết cho sản phẩm này.</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Specifications Tab -->
                <div class="tab-content" id="specifications">
                    <div class="product-specifications">
                        <table class="specs-table">
                            <tr>
                                <th>Thương hiệu</th>
                                <td><?php echo isset($product['brand_name']) ? htmlspecialchars($product['brand_name']) : 'Chưa cập nhật'; ?></td>
                            </tr>
                            <tr>
                                <th>Danh mục</th>
                                <td><?php echo isset($product['category_name']) ? htmlspecialchars($product['category_name']) : 'Chưa cập nhật'; ?></td>
                            </tr>
                            <tr>
                                <th>Chất liệu</th>
                                <td><?php echo isset($product['material']) ? htmlspecialchars($product['material']) : 'Chưa cập nhật'; ?></td>
                            </tr>
                            <tr>
                                <th>Xuất xứ</th>
                                <td><?php echo isset($product['origin']) ? htmlspecialchars($product['origin']) : 'Chưa cập nhật'; ?></td>
                            </tr>
                            <tr>
                                <th>Bảo hành</th>
                                <td><?php echo isset($product['warranty']) ? htmlspecialchars($product['warranty']) : 'Chưa cập nhật'; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <!-- Reviews Tab -->
                <div class="tab-content" id="reviews">
                    <div class="product-reviews">
                        <?php if (count($reviews) > 0): ?>
                            <div class="reviews-summary">
                                <div class="average-rating">
                                    <div class="rating-value"><?php echo number_format($averageRating, 1); ?></div>
                                    <div class="stars">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?php if ($i <= $averageRating): ?>
                                                <i class="fas fa-star"></i>
                                            <?php elseif ($i - 0.5 <= $averageRating): ?>
                                                <i class="fas fa-star-half-alt"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="total-reviews"><?php echo count($reviews); ?> đánh giá</div>
                                </div>
                            </div>
                            
                            <div class="reviews-list">
                                <?php foreach ($reviews as $review): ?>
                                    <div class="review-item">
                                        <div class="review-header">
                                            <div class="reviewer-info">
                                                <div class="reviewer-name"><?php echo htmlspecialchars($review['user_name']); ?></div>
                                                <div class="review-date"><?php echo date('d/m/Y', strtotime($review['created_at'])); ?></div>
                                            </div>
                                            <div class="review-rating">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <?php if ($i <= $review['rating']): ?>
                                                        <i class="fas fa-star"></i>
                                                    <?php else: ?>
                                                        <i class="far fa-star"></i>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <?php echo nl2br(htmlspecialchars($review['comment'])); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="no-reviews">
                                <p>Chưa có đánh giá nào cho sản phẩm này.</p>
                                <button class="write-review-btn">Viết đánh giá đầu tiên</button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="related-products">
        <div class="container">
            <h2 class="section-title">Sản phẩm liên quan</h2>
            <div class="products-grid">
                <?php foreach ($relatedProducts as $relatedProduct): ?>
                    <div class="product-card">
                        <div class="product-img">
                            <img src="<?php echo htmlspecialchars($relatedProduct['image_url']); ?>" alt="<?php echo htmlspecialchars($relatedProduct['name']); ?>">
                            <div class="product-actions">
                                <button class="action-btn"><i class="fas fa-heart"></i></button>
                                <button class="action-btn"><i class="fas fa-shopping-cart"></i></button>
                                <button class="action-btn"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><?php echo htmlspecialchars($relatedProduct['name']); ?></h3>
                            <div class="product-brand"><?php echo htmlspecialchars($relatedProduct['brand_name']); ?></div>
                            <div class="product-price">
                                <?php if ($relatedProduct['discount_price'] > 0): ?>
                                    <span class="old-price"><?php echo number_format($relatedProduct['price'], 0, ',', '.'); ?>₫</span>
                                    <span class="current-price"><?php echo number_format($relatedProduct['discount_price'], 0, ',', '.'); ?>₫</span>
                                <?php else: ?>
                                    <span class="current-price"><?php echo number_format($relatedProduct['price'], 0, ',', '.'); ?>₫</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <div class="footer-logo">
                        <h2>ShoesStyle</h2>
                    </div>
                    <p>Cung cấp các sản phẩm giày chất lượng cao với giá cả hợp lý.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Danh mục</h3>
                    <ul>
                        <li><a href="/project/collections/men">Giày nam</a></li>
                        <li><a href="/project/collections/women">Giày nữ</a></li>
                        <li><a href="/project/collections/kids">Giày trẻ em</a></li>
                        <li><a href="/project/collections/sport">Giày thể thao</a></li>
                        <li><a href="/project/collections/formal">Giày công sở</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Thông tin</h3>
                    <ul>
                        <li><a href="/project/about">Về chúng tôi</a></li>
                        <li><a href="/project/contact">Liên hệ</a></li>
                        <li><a href="/project/blog">Blog</a></li>
                        <li><a href="/project/faq">FAQ</a></li>
                        <li><a href="/project/shipping">Chính sách vận chuyển</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Liên hệ</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> 123 Đường ABC, Quận 1, TP.HCM</li>
                        <li><i class="fas fa-phone"></i> +84 123 456 789</li>
                        <li><i class="fas fa-envelope"></i> info@shoesstyle.com</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="copyright">
                    <p>&copy; 2025 ShoesStyle. Tất cả quyền được bảo lưu.</p>
                </div>
                <div class="payment-methods">
                    <img src="https://www.freepnglogos.com/uploads/visa-logo-download-png-21.png" alt="Visa">
                    <img src="https://www.freepnglogos.com/uploads/mastercard-png/mastercard-logo-png-transparent-svg-vector-bie-supply-0.png" alt="MasterCard">
                    <img src="https://www.freepnglogos.com/uploads/paypal-logo-png-7.png" alt="PayPal">
                </div>
            </div>
        </div>
    </footer>

    <script src="/project/views/js/main.js"></script>
    <script src="/project/views/js/product-detail.js"></script>
</body>
</html> 