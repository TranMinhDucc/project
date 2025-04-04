<?php
// Bắt đầu session
session_start();

// Định nghĩa đường dẫn gốc
define('ROOT_PATH', __DIR__);

// Include file routes
require_once 'routes/web.php';
?> 