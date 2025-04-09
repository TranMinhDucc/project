<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoesStyle - Thế Giới Giày Chất Lượng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/project/views/css/style.css">
    <style>
        .auth-forms {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .auth-forms form {
            width: 45%;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .auth-forms input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .auth-forms button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .auth-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .auth-forms {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 500px;
        }

        .cart-container {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 30px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-details h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .item-details p {
            margin: 5px 0;
            color: #666;
        }

        .remove-btn {
            padding: 8px 16px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .remove-btn:hover {
            background-color: #e60000;
        }

        .cart-summary {
            text-align: right;
        }

        .cart-summary h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .checkout-btn {
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .checkout-btn:hover {
            background-color: #0056b3;
        }
    </style>
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
                    <li><a href="/project/" class="active">Trang chủ</a></li>
                    <li><a href="/project/collections/men">Nam</a></li>
                    <li><a href="/project/collections/women">Nữ</a></li>
                    <li><a href="/project/collections/kids">Trẻ em</a></li>
                    <li><a href="/project/collections/sport">Thể thao</a></li>
                    <li><a href="/project/sale">Khuyến mãi</a></li>
                </ul>
            </nav>
            
            <div class="header-actions">
                <div class="search-bar">
                    <form action="/project/search" method="GET">
                        <input type="text" name="q" placeholder="Tìm kiếm..." autocomplete="off">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="user-actions">
                    <a href="/project/register" class="icon-btn" id="user-icon"><i class="fas fa-user"></i></a>
                    <a href="/project/cart.php" class="icon-btn cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>


    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-slider">
            <div class="slide active">
                <div class="slide-content">
                    <h2>Bộ sưu tập mới 2025</h2>
                    <p>Khám phá xu hướng giày mới nhất với thiết kế độc đáo</p>
                    <a href="/collections/new" class="btn primary-btn">Khám phá ngay</a>
                </div>
                <div class="slide-image" style="background-image: url('https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');"></div>
            </div>
        </div>
        <div class="slider-controls">
            <button class="prev-btn"><i class="fas fa-chevron-left"></i></button>
            <button class="next-btn"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="featured-categories">
        <div class="container">
            <h2 class="section-title">Danh mục nổi bật</h2>
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Giày thể thao">
                    </div>
                    <div class="category-info">
                        <h3>Giày thể thao</h3>
                        <a href="/collections/sport" class="btn outline-btn">Xem thêm</a>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1543163521-1bf539c55dd2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Giày công sở">
                    </div>
                    <div class="category-info">
                        <h3>Giày công sở</h3>
                        <a href="/collections/formal" class="btn outline-btn">Xem thêm</a>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1551107696-a4b0c5a0d9a2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Giày chạy bộ">
                    </div>
                    <div class="category-info">
                        <h3>Giày chạy bộ</h3>
                        <a href="/collections/running" class="btn outline-btn">Xem thêm</a>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Giày thời trang">
                    </div>
                    <div class="category-info">
                        <h3>Giày thời trang</h3>
                        <a href="/collections/fashion" class="btn outline-btn">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-products">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Sản phẩm nổi bật</h2>
                <div class="product-filters">
                    <button class="filter-btn active" data-filter="all">Tất cả</button>
                    <button class="filter-btn" data-filter="new">Mới nhất</button>
                    <button class="filter-btn" data-filter="bestseller">Bán chạy</button>
                    <button class="filter-btn" data-filter="sale">Giảm giá</button>
                </div>
            </div>
            
            <div class="products-grid">
                <!-- Product 1 -->
                <div class="product-card" data-category="new bestseller">
                    <div class="product-badge new">Mới</div>
                    <div class="product-img">
                        <a href="/project/product/1">
                            <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Nike Air Max">
                        </a>
                        <div class="product-actions">
                            <button class="action-btn"><i class="fas fa-heart"></i></button>
                            <button class="action-btn"><i class="fas fa-shopping-cart"></i></button>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name"><a href="/project/product/1">Nike Air Max 2025</a></h3>
                        <div class="product-brand">Nike</div>
                        <div class="product-price">2.500.000₫</div>
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>(45)</span>
                        </div>
                    </div>
                </div>
                
                <!-- Product 2 -->
                <div class="product-card" data-category="bestseller">
                    <div class="product-img">
                        <a href="/project/product/2">
                            <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Adidas Ultraboost">
                        </a>
                        <div class="product-actions">
                            <button class="action-btn"><i class="fas fa-heart"></i></button>
                            <button class="action-btn"><i class="fas fa-shopping-cart"></i></button>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name"><a href="/project/product/2">Adidas Ultraboost 5.0</a></h3>
                        <div class="product-brand">Adidas</div>
                        <div class="product-price">3.200.000₫</div>
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>(78)</span>
                        </div>
                    </div>
                </div>
                
                <!-- Product 3 -->
                <div class="product-card" data-category="sale">
                    <div class="product-badge sale">-30%</div>
                    <div class="product-img">
                        <a href="/project/product/3">
                            <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Puma RS-X">
                        </a>
                        <div class="product-actions">
                            <button class="action-btn"><i class="fas fa-heart"></i></button>
                            <button class="action-btn"><i class="fas fa-shopping-cart"></i></button>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name"><a href="/project/product/3">Puma RS-X Toys</a></h3>
                        <div class="product-brand">Puma</div>
                        <div class="product-price">
                            <span class="old-price">2.800.000₫</span>
                            1.960.000₫
                        </div>
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>(32)</span>
                        </div>
                    </div>
                </div>
                
                <!-- Product 4 -->
                <div class="product-card" data-category="new">
                    <div class="product-badge new">Mới</div>
                    <div class="product-img">
                        <a href="/project/product/4">
                            <img src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Converse Chuck Taylor">
                        </a>
                        <div class="product-actions">
                            <button class="action-btn"><i class="fas fa-heart"></i></button>
                            <button class="action-btn"><i class="fas fa-shopping-cart"></i></button>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name"><a href="/project/product/4">Converse Chuck 70s High Top</a></h3>
                        <div class="product-brand">Converse</div>
                        <div class="product-price">1.800.000₫</div>
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>(56)</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="view-all-container">
                <a href="/project/products" class="btn primary-btn">Xem tất cả sản phẩm</a>
            </div>
        </div>
    </section>

    <!-- Special Offer Banner -->
    <section class="special-offer">
        <div class="container">
            <div class="offer-content">
                <h2>Ưu đãi đặc biệt</h2>
                <h3>Giảm đến 50% cho đơn hàng đầu tiên</h3>
                <p>Sử dụng mã: <strong>WELCOME50</strong></p>
                <a href="/sale" class="btn primary-btn">Mua ngay</a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">Khách hàng nói gì về chúng tôi</h2>
            <div class="testimonial-slider">
                <div class="testimonial-card active">
                    <div class="testimonial-img">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Customer">
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"Chất lượng giày tuyệt vời, dịch vụ khách hàng chuyên nghiệp. Tôi đã mua 3 đôi và rất hài lòng với tất cả."</p>
                        <div class="testimonial-author">Nguyễn Văn A</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </section>

    <!-- Brands -->
    <section class="brands">
        <div class="container">
            <h2 class="section-title">Thương hiệu nổi bật</h2>
            <div class="brands-slider">
                <div class="brand-logo"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Logo_NIKE.svg/1200px-Logo_NIKE.svg.png" alt="Nike"></div>
                <div class="brand-logo"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/20/Adidas_Logo.svg/1200px-Adidas_Logo.svg.png" alt="Adidas"></div>
                <div class="brand-logo"><img src="https://upload.wikimedia.org/wikipedia/en/thumb/4/49/Puma_AG.svg/1200px-Puma_AG.svg.png" alt="Puma"></div>
                <div class="brand-logo"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/Converse_logo.svg/1200px-Converse_logo.svg.png" alt="Converse"></div>
                <div class="brand-logo"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Vans_logo.svg/1200px-Vans_logo.svg.png" alt="Vans"></div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="newsletter">
        <div class="container">
            <div class="newsletter-content">
                <h2>Đăng ký nhận thông tin</h2>
                <p>Nhận thông tin về sản phẩm mới, khuyến mãi đặc biệt và nhiều ưu đãi hấp dẫn khác.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Nhập email của bạn" required>
                    <button type="submit" class="btn primary-btn">Đăng ký</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Modal for Auth Forms -->
    <div id="auth-modal" class="auth-modal">
        <div class="auth-forms">
            <!-- Registration Form -->
            <form id="register-form" action="/project/register" method="POST">
                <h2>Đăng Ký</h2>
                <input type="text" name="username" placeholder="Tên đăng nhập" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mật khẩu" required>
                <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
                <button type="submit">Đăng Ký</button>
            </form>

            <!-- Login Form -->
            <form id="login-form" action="/project/login" method="POST">
                <h2>Đăng Nhập</h2>
                <input type="text" name="username" placeholder="Tên đăng nhập" required>
                <input type="password" name="password" placeholder="Mật khẩu" required>
                <button type="submit">Đăng Nhập</button>
            </form>
        </div>
    </div>

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
                        <li><a href="/collections/men">Giày nam</a></li>
                        <li><a href="/collections/women">Giày nữ</a></li>
                        <li><a href="/collections/kids">Giày trẻ em</a></li>
                        <li><a href="/collections/sport">Giày thể thao</a></li>
                        <li><a href="/collections/formal">Giày công sở</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Thông tin</h3>
                    <ul>
                        <li><a href="/about">Về chúng tôi</a></li>
                        <li><a href="/contact">Liên hệ</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="/faq">FAQ</a></li>
                        <li><a href="/shipping">Chính sách vận chuyển</a></li>
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
    <script>
    document.getElementById('register-form').addEventListener('submit', function(event) {
        const password = this.password.value;
        const confirmPassword = this.confirm_password.value;

        if (password !== confirmPassword) {
            event.preventDefault();
            alert('Mật khẩu xác nhận không khớp.');
        }
    });

    document.getElementById('user-icon').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('auth-modal').style.display = 'flex';
    });

    window.addEventListener('click', function(event) {
        const modal = document.getElementById('auth-modal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
    </script>
</body>
</html>
