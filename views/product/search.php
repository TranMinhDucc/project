<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm - ShoesStyle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/project/views/css/style.css">
    <link rel="stylesheet" href="/project/views/css/product-list.css">
    <link rel="stylesheet" href="/project/views/css/search.css">
</head>
<body>
    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <!-- Search Results -->
    <div class="search-results">
        <div class="container">
            <nav class="breadcrumb">
                <a href="/project/">Trang chủ</a>
                <span class="separator">/</span>
                <span class="current">Kết quả tìm kiếm</span>
            </nav>

            <div class="search-header">
                <h1>Kết quả tìm kiếm</h1>
                <?php if (!empty($keyword)): ?>
                <p class="search-query">Tìm kiếm: <strong><?php echo htmlspecialchars($keyword); ?></strong></p>
                <?php endif; ?>
                <p class="search-count">Tìm thấy <strong><?php echo $totalResults; ?></strong> sản phẩm</p>
            </div>

            <div class="search-wrapper">
                <!-- Filters -->
                <aside class="filters">
                    <form class="filter-form" method="GET" action="/project/search">
                        <!-- Search input -->
                        <div class="filter-section">
                            <h3>Tìm kiếm</h3>
                            <div class="search-input">
                                <input type="text" name="q" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Tìm kiếm sản phẩm...">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="filter-section">
                            <h3>Danh mục</h3>
                            <ul class="category-filter">
                                <?php foreach ($categories as $category): ?>
                                <li>
                                    <a href="?q=<?php echo urlencode($keyword); ?>&category=<?php echo htmlspecialchars($category['id']); ?>" 
                                       class="<?php echo isset($_GET['category']) && $_GET['category'] == $category['id'] ? 'active' : ''; ?>">
                                        <?php echo htmlspecialchars($category['name']); ?>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Brands -->
                        <div class="filter-section">
                            <h3>Thương hiệu</h3>
                            <ul class="brand-filter">
                                <?php foreach ($brands as $brand): ?>
                                <li>
                                    <label>
                                        <input type="checkbox" name="brands[]" 
                                               value="<?php echo htmlspecialchars($brand['id']); ?>"
                                               <?php echo isset($_GET['brands']) && in_array($brand['id'], $_GET['brands']) ? 'checked' : ''; ?>>
                                        <?php echo htmlspecialchars($brand['name']); ?>
                                    </label>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Sizes -->
                        <div class="filter-section">
                            <h3>Kích cỡ</h3>
                            <ul class="size-filter">
                                <?php foreach ($sizes as $size): ?>
                                <li>
                                    <label>
                                        <input type="checkbox" name="sizes[]" 
                                               value="<?php echo htmlspecialchars($size['id']); ?>"
                                               <?php echo isset($_GET['sizes']) && in_array($size['id'], $_GET['sizes']) ? 'checked' : ''; ?>>
                                        <?php echo htmlspecialchars($size['size_name']); ?>
                                    </label>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Colors -->
                        <div class="filter-section">
                            <h3>Màu sắc</h3>
                            <ul class="color-filter">
                                <?php foreach ($colors as $color): ?>
                                <li>
                                    <label>
                                        <input type="checkbox" name="colors[]" 
                                               value="<?php echo htmlspecialchars($color['id']); ?>"
                                               <?php echo isset($_GET['colors']) && in_array($color['id'], $_GET['colors']) ? 'checked' : ''; ?>>
                                        <span class="color-swatch" style="background-color: <?php echo htmlspecialchars($color['code']); ?>"></span>
                                        <?php echo htmlspecialchars($color['name']); ?>
                                    </label>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Price Range -->
                        <div class="filter-section">
                            <h3>Giá</h3>
                            <div class="price-range" data-min="0" data-max="10000000"></div>
                            <div class="price-inputs">
                                <input type="hidden" name="min_price" class="min-price" 
                                       value="<?php echo htmlspecialchars($_GET['min_price'] ?? '0'); ?>">
                                <input type="hidden" name="max_price" class="max-price"
                                       value="<?php echo htmlspecialchars($_GET['max_price'] ?? '10000000'); ?>">
                                <span class="min-price-display"></span>
                                <span class="max-price-display"></span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Lọc sản phẩm</button>
                    </form>
                </aside>

                <!-- Product Grid -->
                <div class="product-grid">
                    <div class="product-controls">
                        <div class="sort-options">
                            <select name="sort" class="sort-select" onchange="window.location.href=this.value">
                                <option value="?q=<?php echo urlencode($keyword); ?>&sort=newest" <?php echo ($sort === 'newest') ? 'selected' : ''; ?>>
                                    Mới nhất
                                </option>
                                <option value="?q=<?php echo urlencode($keyword); ?>&sort=price_asc" <?php echo ($sort === 'price_asc') ? 'selected' : ''; ?>>
                                    Giá tăng dần
                                </option>
                                <option value="?q=<?php echo urlencode($keyword); ?>&sort=price_desc" <?php echo ($sort === 'price_desc') ? 'selected' : ''; ?>>
                                    Giá giảm dần
                                </option>
                                <option value="?q=<?php echo urlencode($keyword); ?>&sort=popular" <?php echo ($sort === 'popular') ? 'selected' : ''; ?>>
                                    Phổ biến
                                </option>
                            </select>
                        </div>
                    </div>

                    <?php if (empty($products)): ?>
                    <div class="no-results">
                        <div class="no-results-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h2>Không tìm thấy sản phẩm</h2>
                        <p>Chúng tôi không tìm thấy sản phẩm phù hợp với tiêu chí tìm kiếm của bạn.</p>
                        <div class="suggestions">
                            <h3>Gợi ý:</h3>
                            <ul>
                                <li>Kiểm tra lại từ khóa tìm kiếm</li>
                                <li>Thử sử dụng từ khóa khác</li>
                                <li>Thử bỏ bớt bộ lọc</li>
                                <li>Xem tất cả sản phẩm <a href="/project/products">tại đây</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="products-container">
                        <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <div class="product-img">
                                <a href="/project/product/<?php echo $product['id']; ?>">
                                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                </a>
                                <div class="product-actions">
                                    <button class="action-btn"><i class="fas fa-heart"></i></button>
                                    <button class="action-btn"><i class="fas fa-shopping-cart"></i></button>
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="product-name"><a href="/project/product/<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                                <div class="product-brand"><?php echo htmlspecialchars($product['brand_name']); ?></div>
                                <div class="product-price">
                                    <?php if (isset($product['discount_price']) && $product['discount_price'] < $product['price']): ?>
                                    <span class="old-price"><?php echo number_format($product['price'], 0, ',', '.'); ?>₫</span>
                                    <?php echo number_format($product['discount_price'], 0, ',', '.'); ?>₫
                                    <?php else: ?>
                                    <?php echo number_format($product['price'], 0, ',', '.'); ?>₫
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <?php if ($totalPages > 1): ?>
                    <div class="pagination">
                        <?php if ($page > 1): ?>
                        <a href="?q=<?php echo urlencode($keyword); ?>&page=<?php echo $page - 1; ?>" class="page-link">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?q=<?php echo urlencode($keyword); ?>&page=<?php echo $i; ?>" 
                           class="page-link <?php echo $i === $page ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                        <?php endfor; ?>
                        
                        <?php if ($page < $totalPages): ?>
                        <a href="?q=<?php echo urlencode($keyword); ?>&page=<?php echo $page + 1; ?>" class="page-link">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

    <script src="/project/views/js/main.js"></script>
    <script src="/project/views/js/search.js"></script>
</body>
</html> 