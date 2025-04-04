-- Insert new products
INSERT INTO products (name, description, price, sale_price, brand_id, category_id) VALUES
('Nike Air Max 270', 'Giày thể thao Nike Air Max 270 với công nghệ đệm Air độc quyền, mang lại cảm giác thoải mái suốt ngày dài', 3200000, 2880000, 1, 1),
('Adidas Ultraboost 21', 'Giày chạy bộ Adidas Ultraboost 21 với công nghệ đệm Boost, đem lại hiệu suất cao trong tập luyện', 4200000, 3780000, 2, 3),
('Puma RS-X³', 'Giày sneaker Puma RS-X³ với thiết kế đột phá, phong cách retro futuristic độc đáo', 2800000, 2520000, 3, 2),
('Nike Air Jordan 1', 'Giày bóng rổ Nike Air Jordan 1 High với thiết kế huyền thoại', 4500000, 4050000, 1, 4),
('Adidas Stan Smith', 'Giày thời trang Adidas Stan Smith phiên bản classic với chất liệu da cao cấp', 2200000, 1980000, 2, 2),
('Nike Air Force 1', 'Giày thể thao Nike Air Force 1 Low với thiết kế đơn giản, dễ phối đồ', 2600000, 2340000, 1, 2);

-- Insert product colors for new products
INSERT INTO product_colors (product_id, color_name, color_code, stock) 
SELECT p.id, color_data.color_name, color_data.color_code, color_data.stock
FROM products p
CROSS JOIN (
    SELECT 'Đen' as color_name, '#000000' as color_code, 30 as stock UNION ALL
    SELECT 'Trắng', '#FFFFFF', 25 UNION ALL
    SELECT 'Xanh navy', '#000080', 20
) color_data
WHERE p.name IN ('Nike Air Max 270', 'Adidas Ultraboost 21', 'Puma RS-X³', 'Nike Air Jordan 1', 'Adidas Stan Smith', 'Nike Air Force 1')
ORDER BY p.id;

-- Insert product sizes for new products
INSERT INTO product_sizes (product_id, size, stock)
SELECT p.id, size_data.size, size_data.stock
FROM products p
CROSS JOIN (
    SELECT '39' as size, 15 as stock UNION ALL
    SELECT '40', 20 UNION ALL
    SELECT '41', 25 UNION ALL
    SELECT '42', 20 UNION ALL
    SELECT '43', 15
) size_data
WHERE p.name IN ('Nike Air Max 270', 'Adidas Ultraboost 21', 'Puma RS-X³', 'Nike Air Jordan 1', 'Adidas Stan Smith', 'Nike Air Force 1')
ORDER BY p.id;

-- Insert product images for new products
INSERT INTO product_images (product_id, image_url, is_primary) VALUES
((SELECT id FROM products WHERE name = 'Nike Air Max 270' LIMIT 1), 'https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/skwgyqrbfzhu6uyeh0xt/air-max-270-shoes-2V5C4p.png', 1),
((SELECT id FROM products WHERE name = 'Adidas Ultraboost 21' LIMIT 1), 'https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/fbaf991a78bc4896a3e9ad7800abcec6_9366/Ultraboost_22_Shoes_Black_GZ0127_01_standard.jpg', 1),
((SELECT id FROM products WHERE name = 'Puma RS-X³' LIMIT 1), 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_1350,h_1350/global/373308/02/sv01/fnd/IND/fmt/png/RS-X%C2%B3-Puzzle-Shoes', 1),
((SELECT id FROM products WHERE name = 'Nike Air Jordan 1' LIMIT 1), 'https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/99486859-0ff3-46b4-949b-2d16af2ad421/air-jordan-1-high-og-shoes-s3mJ0j.png', 1),
((SELECT id FROM products WHERE name = 'Adidas Stan Smith' LIMIT 1), 'https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/68ae7ea7849b43eca70aac1e00f5146d_9366/Stan_Smith_Shoes_White_FX5502_01_standard.jpg', 1),
((SELECT id FROM products WHERE name = 'Nike Air Force 1' LIMIT 1), 'https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/b7d9211c-26e7-431a-ac24-b0540fb3c00f/air-force-1-07-shoes-WrLlWX.png', 1); 