<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../models/Order.php';

if (isset($_GET['id'])) {
    try {
        Order::deleteOrder($conn, $_GET['id']);
        header('Location: /admin/index.php?controller=admin_order&action=index');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>