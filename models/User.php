<?php
require_once 'Model.php';

class User extends Model {
    protected $table = 'users';
    
    // Phương thức xác thực người dùng
    public function authenticate($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }
    
    // Thêm các phương thức khác tùy theo nhu cầu
}
?>
