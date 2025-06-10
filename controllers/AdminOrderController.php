<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/Order.php';

class AdminOrderController {
    public function index() {
        global $conn;
        $orders = Order::getAllOrders($conn);
        include __DIR__ . '/../views/admin/orders/index.php';
    }

    public function create() {
        include __DIR__ . '/../views/admin/orders/create.php';
    }

    public function store() {
        global $conn;
        Order::createOrder($conn, $_POST);
        $_SESSION['success_message'] = "Thêm đơn hàng thành công!";
        header('Location: /admin/index.php?controller=admin_order&action=index');
        exit;
    }
    
    public function edit($id) {
        global $conn;
        $order = Order::getOrderById($conn, $id);
        include __DIR__ . '/../views/admin/orders/edit.php';
    }

    public function update($id) {
        global $conn;
        Order::updateOrder($conn, $id, $_POST);
        $_SESSION['success_message'] = "Cập nhật đơn hàng thành công!";
        header('Location: /admin/index.php?controller=admin_order&action=index');
        exit;
    }

    public function delete($id) {
        global $conn;
        Order::deleteOrder($conn, $id);
        $_SESSION['success_message'] = "Xóa đơn hàng thành công!";
        header('Location: /admin/index.php?controller=admin_order&action=index');
        exit;
    }
}
?>
