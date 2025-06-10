<?php
class Order {
    public static function getAllOrders($conn) {
        $result = $conn->query("SELECT * FROM orders");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getOrderById($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function createOrder($conn, $data) {
        $stmt = $conn->prepare("INSERT INTO orders (id, customer_name, address, phone, total_price, status, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssisi", 
            $data['id'],
            $data['customer_name'],
            $data['address'],
            $data['phone'],
            $data['total_price'],
            $data['status'],
            $data['user_id']
        );
        $stmt->execute();
    }

    public static function updateOrder($conn, $id, $data) {
        if ($data['user_id'] === '' || $data['user_id'] === null) {
            $user_id = null;
        } else {
            $user_id = (int)$data['user_id'];
        }

        $stmt = $conn->prepare("UPDATE orders SET customer_name = ?, address = ?, phone = ?, total_price = ?, status = ?, user_id = ? WHERE id = ?");
        $stmt->bind_param("sssisii", 
            $data['customer_name'],
            $data['address'],
            $data['phone'],
            $data['total_price'],
            $data['status'],
            $user_id,
            $id
        );
        $stmt->execute();
    }

    public static function deleteOrder($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public static function getOrderByUserId($conn, $user_id) {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function getOrderItems($conn, $order_id) {
        $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}