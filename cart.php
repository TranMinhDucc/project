<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Giỏ Hàng - ShoesStyle</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="/project/views/css/style.css" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }

    .cart-container {
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .cart-title {
      text-align: center;
      font-size: 32px;
      margin-bottom: 30px;
      color: #333;
    }

    .cart-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid #eee;
      padding: 15px 0;
    }

    .item-image {
      width: 100px;
      border-radius: 8px;
    }

    .item-info {
      flex: 1;
      margin-left: 20px;
    }

    .item-name {
      font-size: 18px;
      font-weight: 500;
      margin-bottom: 8px;
    }

    .item-price {
      color: #28a745;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .item-quantity input {
      width: 60px;
      padding: 4px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .remove-btn {
      background: none;
      border: none;
      color: #dc3545;
      font-size: 20px;
      cursor: pointer;
      transition: color 0.3s;
    }

    .remove-btn:hover {
      color: #a71d2a;
    }

    .cart-summary {
      text-align: right;
      margin-top: 30px;
    }

    .total-price {
      font-size: 24px;
      color: #2c3e50;
      font-weight: 700;
    }

    .checkout-btn {
      margin-top: 20px;
      padding: 12px 24px;
      font-size: 18px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .checkout-btn:hover {
      background-color: #0056b3;
    }

    .footer {
      background-color: #1e1e2f;
      color: #f1f1f1;
      padding: 60px 20px 30px;
      font-size: 15px;
      margin-top: 60px;
      font-family: 'Roboto', sans-serif;
    }

    .footer-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 40px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .footer-logo,
    .footer-links,
    .footer-contact {
      flex: 1 1 250px;
      min-width: 200px;
    }

    .footer-logo h2 {
      font-size: 28px;
      color: #ffc107;
      margin-bottom: 10px;
    }

    .footer-logo p {
      color: #ccc;
      line-height: 1.6;
    }

    .footer-links h4,
    .footer-contact h4 {
      font-size: 18px;
      margin-bottom: 16px;
      color: #ffffff;
    }

    .footer-links ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .footer-links li {
      margin-bottom: 10px;
    }

    .footer-links a {
      color: #b0b3b8;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .footer-links a:hover {
      color: #ffffff;
      text-decoration: underline;
    }

    .footer-contact p {
      margin: 0;
      color: #b0b3b8;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .footer-contact i {
      color: #ffc107;
    }

    .contact-row {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 20px;
    }

    .footer-socials {
      display: flex;
      gap: 10px;
    }

    .footer-socials a {
      color: #b0b3b8;
      font-size: 20px;
      transition: color 0.3s ease;
    }

    .footer-socials a:hover {
      color: #ffc107;
    }

    .footer-bottom {
      text-align: center;
      padding-top: 30px;
      border-top: 1px solid #3c3e50;
      margin-top: 40px;
      font-size: 14px;
      color: #a5a5a5;
    }

    @media (max-width: 768px) {
      .cart-item {
        flex-direction: column;
        align-items: flex-start;
      }

      .item-info {
        margin-left: 0;
        margin-top: 10px;
      }

      .cart-summary {
        text-align: center;
      }

      .footer-container {
        flex-direction: column;
        text-align: center;
        gap: 30px;
      }

      .contact-row {
        justify-content: center;
      }

      .footer-logo h2 {
        font-size: 24px;
      }

      .footer-links h4,
      .footer-contact h4 {
        font-size: 16px;
      }
    }
  </style>
</head>
<body>
  <header>
    <!-- Include your existing header here -->
  </header>

  <main class="cart-container">
    <h1 class="cart-title">🛒 Giỏ Hàng</h1>

    <div class="cart-items">
      <div class="cart-item">
        <img src="https://via.placeholder.com/100" alt="Product" class="item-image" />
        <div class="item-info">
          <h3 class="item-name">Giày Nike Air Max</h3>
          <p class="item-price">1.500.000₫</p>
          <div class="item-quantity">
            <label for="quantity-1">Số lượng:</label>
            <input type="number" id="quantity-1" value="1" min="1" />
          </div>
        </div>
        <button class="remove-btn"><i class="fas fa-trash-alt"></i></button>
      </div>
    </div>

    <div class="cart-summary">
      <h2>Tổng cộng: <span class="total-price">1.500.000₫</span></h2>
      <button class="checkout-btn">🛍️ Thanh Toán</button>
    </div>
  </main>

  <footer class="footer">
    <div class="footer-container">
      <div class="footer-logo">
        <h2>ShoesStyle</h2>
        <p>Phong cách từ đôi chân bạn.</p>
      </div>

      <div class="footer-links">
        <h4>Liên kết nhanh</h4>
        <ul>
          <li><a href="#">Trang chủ</a></li>
          <li><a href="#">Sản phẩm</a></li>
          <li><a href="#">Liên hệ</a></li>
          <li><a href="#">Chính sách</a></li>
        </ul>
      </div>

      <div class="footer-contact">
        <h4>Liên hệ</h4>
        <div class="contact-row">
          <p><i class="fas fa-envelope"></i> support@shoesstyle.vn</p>
          <p><i class="fas fa-phone-alt"></i> 0981 234 567</p>
          <div class="footer-socials">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2025 ShoesStyle. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
