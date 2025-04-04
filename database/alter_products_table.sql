-- Thêm trường image_url vào bảng products
ALTER TABLE products
ADD COLUMN image_url VARCHAR(255) DEFAULT NULL;

-- Cập nhật trường image_url cho các sản phẩm hiện có từ bảng product_images
UPDATE products p
JOIN product_images pi ON p.id = pi.product_id
SET p.image_url = pi.image_url
WHERE pi.is_primary = 1; 