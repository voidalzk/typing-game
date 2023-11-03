<?php
require_once __DIR__ . '/../config/mysql.php';

class LoginModel {
    private $conn;

    public function __construct() {
        global $mysql;
        $this->conn = $mysql;
    }

    public function authenticate($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }
}
?>