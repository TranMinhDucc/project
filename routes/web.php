<?php
// Include necessary files
require_once 'controllers/HomeController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/AuthController.php';

// Define routes
$request = $_SERVER['REQUEST_URI'];

// Remove base path from request
$basePath = '/project';
if (strpos($request, $basePath) === 0) {
    $request = substr($request, strlen($basePath));
}

// Remove query string if present
if (strpos($request, '?') !== false) {
    $request = substr($request, 0, strpos($request, '?'));
}

// Remove trailing slash if present
if (substr($request, -1) === '/') {
    $request = substr($request, 0, -1);
}

// If request is empty, set it to home
if (empty($request)) {
    $request = '/';
}

// Check for dynamic product route first
if (preg_match('/^\/product\/(\d+)$/', $request, $matches)) {
    $productId = $matches[1];
    $controller = new ProductController();
    $controller->detail($productId);
    exit;
}

// Static route handling
switch ($request) {
    case '/':
        $controller = new HomeController();
        $controller->index();
        break;
        
    case '/register':
        $controller = new AuthController();
        $controller->register();
        break;
        
    case '/login':
        $controller = new AuthController();
        $controller->login();
        break;
        
    case '/cart':
        $controller = new ProductController();
        $controller->cart();
        break;
        
    case '/products':
        $controller = new ProductController();
        $controller->list();
        break;
        
    case '/search':
        $controller = new ProductController();
        $controller->search();
        break;
        
    default:
        // 404 Not Found
        http_response_code(404);
        include 'views/errors/404.php';
        break;
}
?>
