<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký - ShoesStyle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/project/views/css/style.css">
</head>
<body>
    <header>
        <!-- Include your existing header here -->
    </header>

    <main class="auth-container">
        <h1>Đăng Ký</h1>
        <form id="register-form" action="/project/register" method="POST">
            <input type="text" name="username" placeholder="Tên đăng nhập" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
            <button type="submit">Đăng Ký</button>
        </form>
    </main>

    <footer>
        <!-- Include your existing footer here -->
    </footer>
</body>
</html> 