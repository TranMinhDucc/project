<header>
    <div class="container">
        <div class="header-wrapper">
            <div class="logo">
                <a href="/project/">
                    <h1>ShoesStyle</h1>
                </a>
            </div>
            
            <nav class="main-nav">
                <ul>
                    <li><a href="/project/" <?php echo ($_SERVER['REQUEST_URI'] == '/project/' || $_SERVER['REQUEST_URI'] == '/project') ? 'class="active"' : ''; ?>>Trang chủ</a></li>
                    <li><a href="/project/collections/men" <?php echo (strpos($_SERVER['REQUEST_URI'], '/collections/men') !== false) ? 'class="active"' : ''; ?>>Nam</a></li>
                    <li><a href="/project/collections/women" <?php echo (strpos($_SERVER['REQUEST_URI'], '/collections/women') !== false) ? 'class="active"' : ''; ?>>Nữ</a></li>
                    <li><a href="/project/collections/kids" <?php echo (strpos($_SERVER['REQUEST_URI'], '/collections/kids') !== false) ? 'class="active"' : ''; ?>>Trẻ em</a></li>
                    <li><a href="/project/collections/sport" <?php echo (strpos($_SERVER['REQUEST_URI'], '/collections/sport') !== false) ? 'class="active"' : ''; ?>>Thể thao</a></li>
                    <li><a href="/project/sale" <?php echo (strpos($_SERVER['REQUEST_URI'], '/sale') !== false) ? 'class="active"' : ''; ?>>Khuyến mãi</a></li>
                </ul>
            </nav>
            
            <div class="header-actions">
                <div class="search-box">
                    <form action="/project/search" method="GET">
                        <input type="text" name="q" placeholder="Tìm kiếm..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="user-actions">
                    <a href="/project/account" class="icon-btn"><i class="fas fa-user"></i></a>
                    <a href="/project/cart" class="icon-btn cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header> 