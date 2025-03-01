<?php
require_once __DIR__ . '/../../config/database.php';

class Item {
    private $conn;
    private $table_name = "`table-1`"; // 使用反引號括起來

    public $id;
    public $name;
    public $description;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo json_encode(["message" => "Error: " . $e->getMessage()]);
            return null;
        }
    }

    public function readById($id) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE `key-id` = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo json_encode(["message" => "Error: " . $e->getMessage()]);
            return null;
        }
    }

    // ...其他CRUD方法...
}
?>
