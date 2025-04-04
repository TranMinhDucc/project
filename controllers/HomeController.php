<?php
require_once 'models/User.php';

class HomeController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function index() {
        // Ví dụ lấy tất cả người dùng
        $users = $this->userModel->getAll();
        
        // Truyền dữ liệu đến view
        include 'views/home/index.php';
    }
}
?>
