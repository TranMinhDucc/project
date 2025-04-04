<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm - ShoesStyle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/project/views/css/style.css">
    <link rel="stylesheet" href="/project/views/css/product-list.css">
</head>
<body>
    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <!-- Product List -->
    <div class="product-list">
        <div class="container">
            <nav class="breadcrumb">
                <a href="/project/">Trang chủ</a>
                <span class="separator">/</span>
                <span class="current">Sản phẩm</span>
            </nav>

            <?php
            // Pagination variables
            $items_per_page = 12;
            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $total_items = count($products);
            $total_pages = ceil($total_items / $items_per_page);
            $offset = ($current_page - 1) * $items_per_page;
            
            // Get products for current page
            $current_products = array_slice($products, $offset, $items_per_page);
            ?>

            <div class="product-list-wrapper">
                <!-- Filters -->
                <aside class="filters">
                    <form class="filter-form" method="GET">
                        <!-- Categories -->
                        <div class="filter-section">
                            <h3>Danh mục</h3>
                            <ul class="category-filter">
                                <?php foreach ($categories as $category): ?>
                                <li>
                                    <a href="?category=<?php echo htmlspecialchars($category['id']); ?>" 
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
                            <select name="sort" class="sort-select">
                                <option value="newest" <?php echo ($_GET['sort'] ?? '') === 'newest' ? 'selected' : ''; ?>>
                                    Mới nhất
                                </option>
                                <option value="price_asc" <?php echo ($_GET['sort'] ?? '') === 'price_asc' ? 'selected' : ''; ?>>
                                    Giá tăng dần
                                </option>
                                <option value="price_desc" <?php echo ($_GET['sort'] ?? '') === 'price_desc' ? 'selected' : ''; ?>>
                                    Giá giảm dần
                                </option>
                                <option value="name_asc" <?php echo ($_GET['sort'] ?? '') === 'name_asc' ? 'selected' : ''; ?>>
                                    Tên A-Z
                                </option>
                                <option value="name_desc" <?php echo ($_GET['sort'] ?? '') === 'name_desc' ? 'selected' : ''; ?>>
                                    Tên Z-A
                                </option>
                            </select>
                        </div>

                        <div class="view-options">
                            <button type="button" class="view-btn active" data-view="grid">
                                <i class="fas fa-th"></i>
                            </button>
                            <button type="button" class="view-btn" data-view="list">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>

                    <?php if (empty($current_products)): ?>
                    <div class="no-products">
                        <i class="fas fa-box-open"></i>
                        <p>Không tìm thấy sản phẩm nào phù hợp với tiêu chí tìm kiếm của bạn.</p>
                    </div>
                    <?php else: ?>
                    <div class="products-grid">
                        <?php foreach ($current_products as $product): ?>
                        <div class="product-card">
                            <?php if (isset($product['sale_price']) && $product['sale_price'] > 0): ?>
                            <div class="product-badge sale">
                                -<?php echo round((1 - $product['sale_price'] / $product['price']) * 100); ?>%
                            </div>
                            <?php endif; ?>

                            <div class="product-img">
                                <img src="<?php echo htmlspecialchars($product['image_url'] ?? '/project/images/placeholder.jpg'); ?>" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>">
                                
                                <div class="product-actions">
                                    <a href="/project/product/<?php echo htmlspecialchars($product['id']); ?>" class="action-btn">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="action-btn wishlist-btn"
                                            data-product-id="<?php echo htmlspecialchars($product['id']); ?>">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <button type="button" class="action-btn add-to-cart-btn"
                                            data-product-id="<?php echo htmlspecialchars($product['id']); ?>">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="product-info">
                                <h3 class="product-name">
                                    <a href="/project/product/<?php echo htmlspecialchars($product['id']); ?>">
                                        <?php echo htmlspecialchars($product['name']); ?>
                                    </a>
                                </h3>
                                
                                <div class="product-brand">
                                    <?php echo htmlspecialchars($product['brand_name']); ?>
                                </div>
                                
                                <div class="product-price">
                                    <?php if (isset($product['sale_price']) && $product['sale_price'] > 0): ?>
                                    <span class="old-price">
                                        <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                                    </span>
                                    <span class="current-price">
                                        <?php echo number_format($product['sale_price'], 0, ',', '.'); ?>đ
                                    </span>
                                    <?php else: ?>
                                    <span class="current-price">
                                        <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                                    </span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="product-description">
                                    <?php echo htmlspecialchars($product['description']); ?>
                                </div>
                                
                                <div class="product-category">
                                    <?php echo htmlspecialchars($product['category_name']); ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($total_pages > 1): ?>
                    <div class="pagination">
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>" 
                           class="page-link <?php echo ($current_page == $i) ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                        <?php endfor; ?>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

    <!-- Quick View Modal -->
    <div class="quick-view-modal">
        <div class="modal-content">
            <button type="button" class="close-modal">
                <i class="fas fa-times"></i>
            </button>
            <div class="quick-view-content">
                <!-- Content will be loaded here via AJAX -->
            </div>
        </div>
    </div>

    <script src="/project/views/js/product-list.js"></script>
</body>
</html> 