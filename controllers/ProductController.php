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

    public function uploadImage($file, $productId) {
        $targetDir = "public/images/products/";
        $fileName = basename($file["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif');
        if (!in_array(strtolower($fileType), $allowTypes)) {
            throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }
        
        // Generate unique filename
        $fileName = uniqid() . '.' . $fileType;
        $targetFilePath = $targetDir . $fileName;
        
        // Upload file to server
        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $this->productModel->addProductImage($productId, $fileName);
            return $fileName;
        } else {
            throw new Exception("Sorry, there was an error uploading your file.");
        }
    }

    public function handleProductForm() {
        try {
            $productId = isset($_POST['product_id']) ? $_POST['product_id'] : null;
            $productData = [
                'name' => $_POST['name'],
                'brand' => $_POST['brand'],
                'category' => $_POST['category'],
                'price' => $_POST['price'],
                'sale_price' => $_POST['sale_price'],
                'description' => $_POST['description']
            ];

            if ($productId) {
                // Update existing product
                $this->productModel->updateProduct($productId, $productData);
            } else {
                // Create new product
                $productId = $this->productModel->createProduct($productData);
            }

            // Handle image upload
            if (!empty($_FILES["images"]["name"][0])) {
                foreach ($_FILES["images"]["tmp_name"] as $key => $tmp_name) {
                    $file = [
                        "name" => $_FILES["images"]["name"][$key],
                        "type" => $_FILES["images"]["type"][$key],
                        "tmp_name" => $tmp_name,
                        "error" => $_FILES["images"]["error"][$key],
                        "size" => $_FILES["images"]["size"][$key]
                    ];
                    $this->uploadImage($file, $productId);
                }
            }

            header("Location: /project/admin/products");
            exit();
        } catch (Exception $e) {
            // Handle error
            $_SESSION['error'] = $e->getMessage();
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    public function deleteImage() {
        try {
            $imageId = $_POST['image_id'];
            $image = $this->productModel->getImageById($imageId);
            
            if ($image) {
                // Delete file from server
                $filePath = "public/images/products/" . $image['image_url'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                
                // Delete from database
                $this->productModel->deleteImage($imageId);
                
                echo json_encode(['success' => true]);
            } else {
                throw new Exception("Image not found");
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function search() {
        try {
            // Get search parameters
            $keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 12;
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
            
            // Get filter parameters
            $filters = [];
            
            // Brand filter
            if (isset($_GET['brands']) && is_array($_GET['brands'])) {
                $filters['brands'] = $_GET['brands'];
            }
            
            // Category filter
            if (isset($_GET['category']) && !empty($_GET['category'])) {
                $filters['category'] = $_GET['category'];
            }
            
            // Price range filter
            if (isset($_GET['min_price']) && !empty($_GET['min_price'])) {
                $filters['min_price'] = (int)$_GET['min_price'];
            }
            
            if (isset($_GET['max_price']) && !empty($_GET['max_price'])) {
                $filters['max_price'] = (int)$_GET['max_price'];
            }
            
            // Size filter
            if (isset($_GET['sizes']) && is_array($_GET['sizes'])) {
                $filters['sizes'] = $_GET['sizes'];
            }
            
            // Color filter
            if (isset($_GET['colors']) && is_array($_GET['colors'])) {
                $filters['colors'] = $_GET['colors'];
            }
            
            // Get search results
            $products = $this->productModel->searchProducts($keyword, $filters, $sort, $page, $limit);
            
            // Get total results count
            $totalResults = $this->productModel->getTotalSearchResults($keyword, $filters);
            
            // Calculate total pages
            $totalPages = ceil($totalResults / $limit);
            
            // Ensure page is within valid range
            $page = max(1, min($page, $totalPages));
            
            // Get all categories for filter
            $categories = $this->productModel->getAllCategories();
            
            // Get all brands for filter
            $brands = $this->productModel->getAllBrands();
            
            // Get all sizes for filter
            $sizes = $this->productModel->getAllSizes();
            
            // Get all colors for filter
            $colors = $this->productModel->getAllColors();
            
            // Load the view
            include 'views/product/search.php';
        } catch (Exception $e) {
            // Log error
            error_log($e->getMessage());
            
            // Set error message
            $error = 'Có lỗi xảy ra khi tìm kiếm sản phẩm. Vui lòng thử lại sau.';
            
            // Load error view
            include 'views/errors/error.php';
        }
    }
}
?> 