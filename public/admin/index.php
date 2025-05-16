<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h1>Admin Panel</h1>
    <ul>
    <li><a href="index.php?controller=admin_product&action=index">Quản lý sản phẩm</a></li>
    <li><a href="index.php?controller=admin_order&action=index">Quản lý đơn hàng</a></li>
    <li><a href="index.php?controller=admin_user&action=index">Quản lý người dùng</a></li>
    <li><a href="index.php?controller=admin_user&action=logout">Đăng xuất</a></li>
</ul>
</body>
</html>
<?php
session_start();
require_once __DIR__ . '/../../config/Database.php';

$controller = $_GET['controller'] ?? 'admin_product';
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'admin_product':
        require_once __DIR__ . '/../../controllers/AdminProductController.php';
        $c = new AdminProductController($conn);
        break;
    case 'admin_order':
        require_once __DIR__ . '/../../controllers/AdminOrderController.php';
        $c = new AdminOrderController($conn);
        break;
    case 'admin_user':
        require_once __DIR__ . '/../../controllers/UserController.php';
        $c = new UserController($conn);
        break;
    default:
        echo "Controller not found";
        break;
}

if (method_exists($c, $action)) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $c->$action($id);
    } else {
        $c->$action();
    }
} else {
    echo "Action không tồn tại";
    header("/admin/index.php");
    exit;
}



?>

