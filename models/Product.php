<?php
require_once __DIR__ . '/../config/database.php';

class Product {
    public static function getAll() {
        global $conn;
        $result = $conn->query("SELECT * FROM products");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}