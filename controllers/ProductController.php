<?php
require_once 'models/Product.php';

class ProductController {
    private $productModel;
    
    public function __construct() {
        $this->productModel = new Product();
    }
    
    public function detail($id) {
        // Get product details
        $product = $this->productModel->getProductDetail($id);
        
        // Check if product exists
        if (!$product) {
            // Product not found, redirect to home page or show error
            header('Location: /');
            exit;
        }
        
        // Get product images
        $images = $this->productModel->getProductImages($id);
        
        // Get product reviews
        $reviews = $this->productModel->getProductReviews($id);
        
        // Get related products
        $relatedProducts = $this->productModel->getRelatedProducts($id, $product['category_id']);
        
        // Get product sizes
        $sizes = $this->productModel->getProductSizes($id);
        
        // Get product colors
        $colors = $this->productModel->getProductColors($id);
        
        // Calculate average rating
        $averageRating = 0;
        if (count($reviews) > 0) {
            $totalRating = 0;
            foreach ($reviews as $review) {
                $totalRating += $review['rating'];
            }
            $averageRating = $totalRating / count($reviews);
        }
        
        // Load the view
        include 'views/product/detail.php';
    }
    
    public function list($category = null, $page = 1, $limit = 12) {
        try {
            // Get total products count
            $totalProducts = $this->productModel->getTotalProducts($category);
            
            // Calculate total pages
            $totalPages = ceil($totalProducts / $limit);
            
            // Ensure page is within valid range
            $page = max(1, min($page, $totalPages));
            
            // Calculate offset
            $offset = ($page - 1) * $limit;
            
            // Get products for current page
            $products = $this->productModel->getProducts($category, $offset, $limit);
            
            // Get all categories for filter
            $categories = $this->productModel->getAllCategories();
            
            // Get all brands for filter
            $brands = $this->productModel->getAllBrands();
            
            // Load the view
            include 'views/product/list.php';
        } catch (Exception $e) {
            // Log error
            error_log($e->getMessage());
            
            // Set error message
            $error = 'Có lỗi xảy ra khi tải danh sách sản phẩm. Vui lòng thử lại sau.';
            
            // Load error view
            include 'views/errors/error.php';
        }
    }
}
?> 