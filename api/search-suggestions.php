<?php
require_once '../config/database.php';
require_once '../models/Product.php';

header('Content-Type: application/json');

// Get search query
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($query) || strlen($query) < 2) {
    echo json_encode(['suggestions' => []]);
    exit;
}

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    $product = new Product($conn);
    $suggestions = $product->getSearchSuggestions($query);
    
    echo json_encode(['suggestions' => $suggestions]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'An error occurred while fetching suggestions']);
} 