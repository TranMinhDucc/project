<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lỗi - ShoesStyle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/project/views/css/style.css">
    <style>
        .error-container {
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
        }
        .error-icon {
            font-size: 4rem;
            color: #ff4d4d;
            margin-bottom: 1rem;
        }
        .error-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1rem;
        }
        .error-message {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 2rem;
            max-width: 600px;
        }
        .back-btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            background-color: #ff4d4d;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .back-btn:hover {
            background-color: #ff3333;
        }
    </style>
</head>
<body>
    <?php require_once __DIR__ . '/../../views/partials/header.php'; ?>

    <div class="error-container">
        <div class="error-icon">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <h1 class="error-title">Đã xảy ra lỗi</h1>
        <p class="error-message">
            <?php echo isset($error_message) ? htmlspecialchars($error_message) : 'Đã có lỗi xảy ra. Vui lòng thử lại sau.'; ?>
        </p>
        <a href="/project" class="back-btn">Về trang chủ</a>
    </div>

    <?php require_once __DIR__ . '/../../views/partials/footer.php'; ?>

    <script src="/project/views/js/main.js"></script>
</body>
</html> 