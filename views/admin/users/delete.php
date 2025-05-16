<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../models/User.php';

if (isset($_GET['id'])) {
    try {
        User::delete($conn, $_GET['id']);
        header('Location: /admin/index.php?controller=admin_user&action=index');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>