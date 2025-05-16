<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../models/Product.php';

if (isset($_GET['id'])) {
    try {
        Product::delete($conn, $_GET['id']);
        header('Location: /admin/index.php?controller=admin_product&action=index');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>