<?php
require_once __DIR__ . '/../config/database.php';

class Model {
    protected $conn;
    protected $table;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
    
    // Phương thức cơ bản để lấy tất cả bản ghi
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Phương thức lấy một bản ghi theo ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Các phương thức thêm, sửa, xóa có thể được thêm vào đây
}
?>
