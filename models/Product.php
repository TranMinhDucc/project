<?php
require_once 'Model.php';

class Product extends Model {
    protected $table = 'products';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Get product by ID with all related information
    public function getProductDetail($id) {
        $query = "SELECT p.*, b.name as brand_name, c.name as category_name 
                 FROM " . $this->table . " p
                 LEFT JOIN brands b ON p.brand_id = b.id
                 LEFT JOIN categories c ON p.category_id = c.id
                 WHERE p.id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If no data found in database, return sample data
        if (!$result) {
            return $this->getSampleProductData($id);
        }
        
        return $result;
    }
    
    // Get sample product data for testing
    private function getSampleProductData($id) {
        $sampleProducts = [
            1 => [
                'id' => 1,
                'name' => 'Nike Air Max 2025',
                'brand_id' => 1,
                'category_id' => 1,
                'brand_name' => 'Nike',
                'category_name' => 'Giày thể thao',
                'price' => 2500000,
                'discount_price' => 0,
                'description' => 'Nike Air Max 2025 là phiên bản mới nhất của dòng giày Air Max, mang đến sự thoải mái và phong cách hiện đại. Với công nghệ đệm Air đột phá, giày cung cấp khả năng hấp thụ sốc tối ưu và độ bền vượt trội.',
                'details' => 'Nike Air Max 2025 được thiết kế với upper làm từ vật liệu nhẹ và thoáng khí, giúp chân luôn khô ráo và thoải mái trong suốt quá trình sử dụng. Đế giữa với công nghệ Air đệm toàn bộ bàn chân, mang lại cảm giác nhẹ nhàng như đang đi trên mây. Đế ngoài với hoa văn đặc trưng cung cấp độ bám dính tốt trên mọi bề mặt.',
                'material' => 'Vải dệt thoáng khí, đệm Air, cao su',
                'origin' => 'Việt Nam',
                'warranty' => '12 tháng',
                'stock' => 50,
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ],
            2 => [
                'id' => 2,
                'name' => 'Adidas Ultraboost 5.0',
                'brand_id' => 2,
                'category_id' => 2,
                'brand_name' => 'Adidas',
                'category_name' => 'Giày chạy bộ',
                'price' => 3200000,
                'discount_price' => 0,
                'description' => 'Adidas Ultraboost 5.0 là đôi giày chạy bộ cao cấp với công nghệ Boost đệm tiên tiến. Thiết kế hiện đại kết hợp với hiệu suất vượt trội, mang đến trải nghiệm chạy bộ hoàn hảo.',
                'details' => 'Adidas Ultraboost 5.0 sử dụng công nghệ Boost đệm đột phá, cung cấp năng lượng trả về tối đa với mỗi bước chân. Upper Primeknit+ co giãn và thoáng khí, ôm sát chân nhưng vẫn đảm bảo sự thoải mái. Đế Continental™ Rubber cung cấp độ bám dính vượt trội trên mọi bề mặt.',
                'material' => 'Primeknit+, Boost, Continental™ Rubber',
                'origin' => 'Indonesia',
                'warranty' => '12 tháng',
                'stock' => 35,
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ],
            3 => [
                'id' => 3,
                'name' => 'Puma RS-X Toys',
                'brand_id' => 3,
                'category_id' => 3,
                'brand_name' => 'Puma',
                'category_name' => 'Giày thời trang',
                'price' => 2800000,
                'discount_price' => 1960000,
                'description' => 'Puma RS-X Toys là phiên bản mới của dòng giày RS-X, lấy cảm hứng từ thế giới đồ chơi. Thiết kế đầy màu sắc và phong cách retro hiện đại, mang đến vẻ ngoài độc đáo và ấn tượng.',
                'details' => 'Puma RS-X Toys kết hợp giữa phong cách retro và hiện đại với upper đa màu sắc và chi tiết thiết kế độc đáo. Đệm RS (Reinforced Structure) cung cấp sự thoải mái tối ưu cho cả ngày dài. Đế ngoài với hoa văn đặc trưng cung cấp độ bám dính tốt và độ bền cao.',
                'material' => 'Vải dệt, đệm RS, cao su',
                'origin' => 'Trung Quốc',
                'warranty' => '6 tháng',
                'stock' => 25,
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ],
            4 => [
                'id' => 4,
                'name' => 'Converse Chuck 70s High Top',
                'brand_id' => 4,
                'category_id' => 3,
                'brand_name' => 'Converse',
                'category_name' => 'Giày thời trang',
                'price' => 1800000,
                'discount_price' => 0,
                'description' => 'Converse Chuck 70s High Top là phiên bản cao cấp của dòng giày Chuck Taylor All Star cổ điển. Với chất liệu và công nghệ sản xuất cải tiến, giày mang đến sự thoải mái và độ bền vượt trội so với phiên bản thông thường.',
                'details' => 'Converse Chuck 70s High Top sử dụng vải canvas dày và bền hơn, cùng với đế cao su đặc biệt. Thiết kế cổ điển với các chi tiết như viền cổ màu kem, logo Converse đặc trưng và đế cao su màu kem. Giày phù hợp với nhiều phong cách thời trang khác nhau, từ casual đến street style.',
                'material' => 'Canvas, cao su',
                'origin' => 'Việt Nam',
                'warranty' => '6 tháng',
                'stock' => 40,
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ]
        ];
        
        return isset($sampleProducts[$id]) ? $sampleProducts[$id] : null;
    }
    
    // Get product images
    public function getProductImages($productId) {
        $query = "SELECT * FROM product_images WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // If no data found in database, return sample data
        if (empty($result)) {
            return $this->getSampleProductImages($productId);
        }
        
        return $result;
    }
    
    // Get sample product images for testing
    private function getSampleProductImages($productId) {
        $sampleImages = [
            1 => [
                [
                    'id' => 1,
                    'product_id' => 1,
                    'image_url' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'is_main' => 1
                ],
                [
                    'id' => 2,
                    'product_id' => 1,
                    'image_url' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'is_main' => 0
                ],
                [
                    'id' => 3,
                    'product_id' => 1,
                    'image_url' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'is_main' => 0
                ]
            ],
            2 => [
                [
                    'id' => 4,
                    'product_id' => 2,
                    'image_url' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'is_main' => 1
                ],
                [
                    'id' => 5,
                    'product_id' => 2,
                    'image_url' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'is_main' => 0
                ],
                [
                    'id' => 6,
                    'product_id' => 2,
                    'image_url' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'is_main' => 0
                ]
            ],
            3 => [
                [
                    'id' => 7,
                    'product_id' => 3,
                    'image_url' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'is_main' => 1
                ],
                [
                    'id' => 8,
                    'product_id' => 3,
                    'image_url' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'is_main' => 0
                ],
                [
                    'id' => 9,
                    'product_id' => 3,
                    'image_url' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'is_main' => 0
                ]
            ],
            4 => [
                [
                    'id' => 10,
                    'product_id' => 4,
                    'image_url' => 'https://images.unsplash.com/photo-1608231387042-66d1773070a5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'is_main' => 1
                ],
                [
                    'id' => 11,
                    'product_id' => 4,
                    'image_url' => 'https://images.unsplash.com/photo-1608231387042-66d1773070a5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'is_main' => 0
                ],
                [
                    'id' => 12,
                    'product_id' => 4,
                    'image_url' => 'https://images.unsplash.com/photo-1608231387042-66d1773070a5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                    'is_main' => 0
                ]
            ]
        ];
        
        return isset($sampleImages[$productId]) ? $sampleImages[$productId] : [];
    }
    
    // Get product reviews
    public function getProductReviews($productId) {
        $query = "SELECT r.*, u.name as user_name 
                 FROM reviews r
                 LEFT JOIN users u ON r.user_id = u.id
                 WHERE r.product_id = :product_id
                 ORDER BY r.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // If no data found in database, return sample data
        if (empty($result)) {
            return $this->getSampleProductReviews($productId);
        }
        
        return $result;
    }
    
    // Get sample product reviews for testing
    private function getSampleProductReviews($productId) {
        $sampleReviews = [
            1 => [
                [
                    'id' => 1,
                    'product_id' => 1,
                    'user_id' => 1,
                    'user_name' => 'Nguyễn Văn A',
                    'rating' => 5,
                    'comment' => 'Giày rất đẹp và thoải mái. Tôi đã mua được 2 tuần và rất hài lòng với chất lượng.',
                    'created_at' => '2023-03-15 10:30:00'
                ],
                [
                    'id' => 2,
                    'product_id' => 1,
                    'user_id' => 2,
                    'user_name' => 'Trần Thị B',
                    'rating' => 4,
                    'comment' => 'Giày đẹp, chất lượng tốt nhưng giá hơi cao. Nên có chương trình giảm giá thường xuyên hơn.',
                    'created_at' => '2023-03-10 15:45:00'
                ],
                [
                    'id' => 3,
                    'product_id' => 1,
                    'user_id' => 3,
                    'user_name' => 'Lê Văn C',
                    'rating' => 5,
                    'comment' => 'Đôi giày tốt nhất tôi từng mua. Đệm rất thoải mái, đi cả ngày không bị mỏi chân.',
                    'created_at' => '2023-03-05 09:20:00'
                ]
            ],
            2 => [
                [
                    'id' => 4,
                    'product_id' => 2,
                    'user_id' => 4,
                    'user_name' => 'Phạm Thị D',
                    'rating' => 5,
                    'comment' => 'Giày chạy bộ tốt nhất tôi từng sử dụng. Đệm Boost thực sự tạo sự khác biệt.',
                    'created_at' => '2023-03-18 14:15:00'
                ],
                [
                    'id' => 5,
                    'product_id' => 2,
                    'user_id' => 5,
                    'user_name' => 'Hoàng Văn E',
                    'rating' => 5,
                    'comment' => 'Chất lượng tuyệt vời, thiết kế đẹp. Giá hơi cao nhưng xứng đáng với chất lượng.',
                    'created_at' => '2023-03-12 11:30:00'
                ],
                [
                    'id' => 6,
                    'product_id' => 2,
                    'user_id' => 6,
                    'user_name' => 'Đỗ Thị F',
                    'rating' => 4,
                    'comment' => 'Giày rất thoải mái, nhưng size hơi nhỏ so với thông thường. Nên chọn size lớn hơn 0.5.',
                    'created_at' => '2023-03-08 16:40:00'
                ]
            ],
            3 => [
                [
                    'id' => 7,
                    'product_id' => 3,
                    'user_id' => 7,
                    'user_name' => 'Vũ Văn G',
                    'rating' => 4,
                    'comment' => 'Thiết kế đẹp, màu sắc bắt mắt. Giày khá thoải mái nhưng không phù hợp để chạy bộ.',
                    'created_at' => '2023-03-20 09:10:00'
                ],
                [
                    'id' => 8,
                    'product_id' => 3,
                    'user_id' => 8,
                    'user_name' => 'Bùi Thị H',
                    'rating' => 5,
                    'comment' => 'Giày rất đẹp, phong cách retro hiện đại. Giá khuyến mãi rất hợp lý.',
                    'created_at' => '2023-03-15 13:25:00'
                ],
                [
                    'id' => 9,
                    'product_id' => 3,
                    'user_id' => 9,
                    'user_name' => 'Mai Văn I',
                    'rating' => 3,
                    'comment' => 'Thiết kế đẹp nhưng chất lượng không như mong đợi. Đế giày hơi cứng.',
                    'created_at' => '2023-03-10 10:50:00'
                ]
            ],
            4 => [
                [
                    'id' => 10,
                    'product_id' => 4,
                    'user_id' => 10,
                    'user_name' => 'Lý Thị K',
                    'rating' => 5,
                    'comment' => 'Giày Converse cổ điển nhưng chất lượng cao cấp hơn. Rất thoải mái và bền.',
                    'created_at' => '2023-03-22 15:30:00'
                ],
                [
                    'id' => 11,
                    'product_id' => 4,
                    'user_id' => 11,
                    'user_name' => 'Ngô Văn L',
                    'rating' => 4,
                    'comment' => 'Phiên bản cao cấp của Chuck Taylor. Chất lượng tốt hơn phiên bản thường.',
                    'created_at' => '2023-03-18 11:15:00'
                ],
                [
                    'id' => 12,
                    'product_id' => 4,
                    'user_id' => 12,
                    'user_name' => 'Trịnh Thị M',
                    'rating' => 5,
                    'comment' => 'Giày đẹp, chất lượng tốt. Phù hợp với nhiều phong cách thời trang.',
                    'created_at' => '2023-03-12 14:40:00'
                ]
            ]
        ];
        
        return isset($sampleReviews[$productId]) ? $sampleReviews[$productId] : [];
    }
    
    // Get related products
    public function getRelatedProducts($productId, $categoryId, $limit = 4) {
        $query = "SELECT * FROM " . $this->table . " 
                 WHERE category_id = :category_id 
                 AND id != :product_id
                 LIMIT :limit";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // If no data found in database, return sample data
        if (empty($result)) {
            return $this->getSampleRelatedProducts($productId, $limit);
        }
        
        return $result;
    }
    
    // Get sample related products for testing
    private function getSampleRelatedProducts($productId, $limit) {
        $sampleProducts = [
            1 => [
                [
                    'id' => 2,
                    'name' => 'Adidas Ultraboost 5.0',
                    'brand_name' => 'Adidas',
                    'category_name' => 'Giày chạy bộ',
                    'price' => 3200000,
                    'discount_price' => 0,
                    'image_url' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
                ],
                [
                    'id' => 3,
                    'name' => 'Puma RS-X Toys',
                    'brand_name' => 'Puma',
                    'category_name' => 'Giày thời trang',
                    'price' => 2800000,
                    'discount_price' => 1960000,
                    'image_url' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
                ],
                [
                    'id' => 4,
                    'name' => 'Converse Chuck 70s High Top',
                    'brand_name' => 'Converse',
                    'category_name' => 'Giày thời trang',
                    'price' => 1800000,
                    'discount_price' => 0,
                    'image_url' => 'https://images.unsplash.com/photo-1608231387042-66d1773070a5?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
                ]
            ],
            2 => [
                [
                    'id' => 1,
                    'name' => 'Nike Air Max 2025',
                    'brand_name' => 'Nike',
                    'category_name' => 'Giày thể thao',
                    'price' => 2500000,
                    'discount_price' => 0,
                    'image_url' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
                ],
                [
                    'id' => 3,
                    'name' => 'Puma RS-X Toys',
                    'brand_name' => 'Puma',
                    'category_name' => 'Giày thời trang',
                    'price' => 2800000,
                    'discount_price' => 1960000,
                    'image_url' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
                ],
                [
                    'id' => 4,
                    'name' => 'Converse Chuck 70s High Top',
                    'brand_name' => 'Converse',
                    'category_name' => 'Giày thời trang',
                    'price' => 1800000,
                    'discount_price' => 0,
                    'image_url' => 'https://images.unsplash.com/photo-1608231387042-66d1773070a5?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
                ]
            ],
            3 => [
                [
                    'id' => 1,
                    'name' => 'Nike Air Max 2025',
                    'brand_name' => 'Nike',
                    'category_name' => 'Giày thể thao',
                    'price' => 2500000,
                    'discount_price' => 0,
                    'image_url' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
                ],
                [
                    'id' => 2,
                    'name' => 'Adidas Ultraboost 5.0',
                    'brand_name' => 'Adidas',
                    'category_name' => 'Giày chạy bộ',
                    'price' => 3200000,
                    'discount_price' => 0,
                    'image_url' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
                ],
                [
                    'id' => 4,
                    'name' => 'Converse Chuck 70s High Top',
                    'brand_name' => 'Converse',
                    'category_name' => 'Giày thời trang',
                    'price' => 1800000,
                    'discount_price' => 0,
                    'image_url' => 'https://images.unsplash.com/photo-1608231387042-66d1773070a5?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
                ]
            ],
            4 => [
                [
                    'id' => 1,
                    'name' => 'Nike Air Max 2025',
                    'brand_name' => 'Nike',
                    'category_name' => 'Giày thể thao',
                    'price' => 2500000,
                    'discount_price' => 0,
                    'image_url' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
                ],
                [
                    'id' => 2,
                    'name' => 'Adidas Ultraboost 5.0',
                    'brand_name' => 'Adidas',
                    'category_name' => 'Giày chạy bộ',
                    'price' => 3200000,
                    'discount_price' => 0,
                    'image_url' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
                ],
                [
                    'id' => 3,
                    'name' => 'Puma RS-X Toys',
                    'brand_name' => 'Puma',
                    'category_name' => 'Giày thời trang',
                    'price' => 2800000,
                    'discount_price' => 1960000,
                    'image_url' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
                ]
            ]
        ];
        
        return isset($sampleProducts[$productId]) ? array_slice($sampleProducts[$productId], 0, $limit) : [];
    }
    
    // Get product sizes
    public function getProductSizes($productId) {
        $query = "SELECT id, size, stock 
                 FROM product_sizes
                 WHERE product_id = :product_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // If no data found in database, return sample data
        if (empty($result)) {
            return $this->getSampleProductSizes($productId);
        }
        
        return $result;
    }
    
    // Get sample product sizes for testing
    private function getSampleProductSizes($productId) {
        $sampleSizes = [
            1 => [
                ['id' => 1, 'size' => '38', 'stock' => 10],
                ['id' => 2, 'size' => '39', 'stock' => 15],
                ['id' => 3, 'size' => '40', 'stock' => 20],
                ['id' => 4, 'size' => '41', 'stock' => 15],
                ['id' => 5, 'size' => '42', 'stock' => 10],
                ['id' => 6, 'size' => '43', 'stock' => 5],
                ['id' => 7, 'size' => '44', 'stock' => 0]
            ],
            2 => [
                ['id' => 1, 'size' => '38', 'stock' => 5],
                ['id' => 2, 'size' => '39', 'stock' => 10],
                ['id' => 3, 'size' => '40', 'stock' => 15],
                ['id' => 4, 'size' => '41', 'stock' => 20],
                ['id' => 5, 'size' => '42', 'stock' => 15],
                ['id' => 6, 'size' => '43', 'stock' => 10],
                ['id' => 7, 'size' => '44', 'stock' => 5]
            ],
            3 => [
                ['id' => 1, 'size' => '38', 'stock' => 0],
                ['id' => 2, 'size' => '39', 'stock' => 5],
                ['id' => 3, 'size' => '40', 'stock' => 10],
                ['id' => 4, 'size' => '41', 'stock' => 15],
                ['id' => 5, 'size' => '42', 'stock' => 10],
                ['id' => 6, 'size' => '43', 'stock' => 5],
                ['id' => 7, 'size' => '44', 'stock' => 0]
            ],
            4 => [
                ['id' => 1, 'size' => '38', 'stock' => 15],
                ['id' => 2, 'size' => '39', 'stock' => 20],
                ['id' => 3, 'size' => '40', 'stock' => 25],
                ['id' => 4, 'size' => '41', 'stock' => 20],
                ['id' => 5, 'size' => '42', 'stock' => 15],
                ['id' => 6, 'size' => '43', 'stock' => 10],
                ['id' => 7, 'size' => '44', 'stock' => 5]
            ]
        ];
        
        return isset($sampleSizes[$productId]) ? $sampleSizes[$productId] : [];
    }
    
    // Get product colors
    public function getProductColors($productId) {
        $query = "SELECT id, color_name, color_code, stock 
                 FROM product_colors
                 WHERE product_id = :product_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // If no data found in database, return sample data
        if (empty($result)) {
            return $this->getSampleProductColors($productId);
        }
        
        return $result;
    }
    
    // Get sample product colors for testing
    private function getSampleProductColors($productId) {
        $sampleColors = [
            1 => [
                ['id' => 1, 'color_name' => 'Đen', 'color_code' => '#000000', 'stock' => 20],
                ['id' => 2, 'color_name' => 'Trắng', 'color_code' => '#FFFFFF', 'stock' => 15],
                ['id' => 3, 'color_name' => 'Đỏ', 'color_code' => '#FF0000', 'stock' => 10],
                ['id' => 4, 'color_name' => 'Xanh dương', 'color_code' => '#0000FF', 'stock' => 5]
            ],
            2 => [
                ['id' => 1, 'color_name' => 'Đen', 'color_code' => '#000000', 'stock' => 15],
                ['id' => 2, 'color_name' => 'Trắng', 'color_code' => '#FFFFFF', 'stock' => 20],
                ['id' => 3, 'color_name' => 'Xám', 'color_code' => '#808080', 'stock' => 10],
                ['id' => 4, 'color_name' => 'Xanh lá', 'color_code' => '#00FF00', 'stock' => 0]
            ],
            3 => [
                ['id' => 1, 'color_name' => 'Đen', 'color_code' => '#000000', 'stock' => 10],
                ['id' => 2, 'color_name' => 'Trắng', 'color_code' => '#FFFFFF', 'stock' => 5],
                ['id' => 3, 'color_name' => 'Đỏ', 'color_code' => '#FF0000', 'stock' => 0],
                ['id' => 4, 'color_name' => 'Xanh dương', 'color_code' => '#0000FF', 'stock' => 10]
            ],
            4 => [
                ['id' => 1, 'color_name' => 'Đen', 'color_code' => '#000000', 'stock' => 25],
                ['id' => 2, 'color_name' => 'Trắng', 'color_code' => '#FFFFFF', 'stock' => 20],
                ['id' => 3, 'color_name' => 'Xám', 'color_code' => '#808080', 'stock' => 15],
                ['id' => 4, 'color_name' => 'Navy', 'color_code' => '#000080', 'stock' => 10]
            ]
        ];
        
        return isset($sampleColors[$productId]) ? $sampleColors[$productId] : [];
    }
    
    // Get total number of products
    public function getTotalProducts($category = null) {
        try {
            $query = "SELECT COUNT(*) as total FROM " . $this->table;
            if ($category) {
                $query .= " WHERE category_id = :category_id";
            }
            
            $stmt = $this->conn->prepare($query);
            if ($category) {
                $stmt->bindParam(':category_id', $category);
            }
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            // Return sample count if database error
            return 20;
        }
    }
    
    // Get products with pagination
    public function getProducts($category = null, $offset = 0, $limit = 12) {
        try {
            $query = "SELECT p.*, b.name as brand_name, c.name as category_name,
                     (SELECT image_url FROM product_images WHERE product_id = p.id AND is_main = 1 LIMIT 1) as main_image
                     FROM " . $this->table . " p
                     LEFT JOIN brands b ON p.brand_id = b.id
                     LEFT JOIN categories c ON p.category_id = c.id";
            
            if ($category) {
                $query .= " WHERE p.category_id = :category_id";
            }
            
            $query .= " ORDER BY p.created_at DESC LIMIT :offset, :limit";
            
            $stmt = $this->conn->prepare($query);
            if ($category) {
                $stmt->bindParam(':category_id', $category);
            }
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // If no data found in database, return sample data
            if (empty($result)) {
                return $this->getSampleProducts($offset, $limit);
            }
            
            return $result;
        } catch (PDOException $e) {
            // Return sample data if database error
            return $this->getSampleProducts($offset, $limit);
        }
    }
    
    // Get all categories
    public function getAllCategories() {
        try {
            $query = "SELECT * FROM categories ORDER BY name";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // If no data found in database, return sample data
            if (empty($result)) {
                return $this->getSampleCategories();
            }
            
            return $result;
        } catch (PDOException $e) {
            // Return sample data if database error
            return $this->getSampleCategories();
        }
    }
    
    // Get all brands
    public function getAllBrands() {
        try {
            $query = "SELECT * FROM brands ORDER BY name";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // If no data found in database, return sample data
            if (empty($result)) {
                return $this->getSampleBrands();
            }
            
            return $result;
        } catch (PDOException $e) {
            // Return sample data if database error
            return $this->getSampleBrands();
        }
    }
    
    // Get sample products for testing
    private function getSampleProducts($offset = 0, $limit = 12) {
        $sampleProducts = [
            [
                'id' => 1,
                'name' => 'Nike Air Max 2025',
                'brand_id' => 1,
                'category_id' => 1,
                'brand_name' => 'Nike',
                'category_name' => 'Giày thể thao',
                'price' => 2500000,
                'discount_price' => 0,
                'description' => 'Nike Air Max 2025 là phiên bản mới nhất của dòng giày Air Max.',
                'image' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'id' => 2,
                'name' => 'Adidas Ultraboost 5.0',
                'brand_id' => 2,
                'category_id' => 2,
                'brand_name' => 'Adidas',
                'category_name' => 'Giày chạy bộ',
                'price' => 3200000,
                'discount_price' => 0,
                'description' => 'Adidas Ultraboost 5.0 là đôi giày chạy bộ cao cấp với công nghệ Boost đệm tiên tiến.',
                'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'id' => 3,
                'name' => 'Puma RS-X Toys',
                'brand_id' => 3,
                'category_id' => 3,
                'brand_name' => 'Puma',
                'category_name' => 'Giày thời trang',
                'price' => 2800000,
                'discount_price' => 1960000,
                'description' => 'Puma RS-X Toys là phiên bản mới của dòng giày RS-X, lấy cảm hứng từ thế giới đồ chơi.',
                'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'id' => 4,
                'name' => 'Converse Chuck 70s High Top',
                'brand_id' => 4,
                'category_id' => 3,
                'brand_name' => 'Converse',
                'category_name' => 'Giày thời trang',
                'price' => 1800000,
                'discount_price' => 0,
                'description' => 'Converse Chuck 70s High Top là phiên bản cao cấp của dòng giày Chuck Taylor All Star cổ điển.',
                'image' => 'https://images.unsplash.com/photo-1608231387042-66d1773070a5?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
            ]
        ];
        
        return array_slice($sampleProducts, $offset, $limit);
    }
    
    // Get sample categories for testing
    private function getSampleCategories() {
        return [
            ['id' => 1, 'name' => 'Giày thể thao', 'slug' => 'giay-the-thao'],
            ['id' => 2, 'name' => 'Giày chạy bộ', 'slug' => 'giay-chay-bo'],
            ['id' => 3, 'name' => 'Giày thời trang', 'slug' => 'giay-thoi-trang'],
            ['id' => 4, 'name' => 'Giày công sở', 'slug' => 'giay-cong-so']
        ];
    }
    
    // Get sample brands for testing
    private function getSampleBrands() {
        return [
            ['id' => 1, 'name' => 'Nike', 'slug' => 'nike'],
            ['id' => 2, 'name' => 'Adidas', 'slug' => 'adidas'],
            ['id' => 3, 'name' => 'Puma', 'slug' => 'puma'],
            ['id' => 4, 'name' => 'Converse', 'slug' => 'converse']
        ];
    }
}
?> 