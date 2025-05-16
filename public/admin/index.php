<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="/public/css/adminstyle.css">
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
<style>
    

:root {
    --admin-primary: #3498db;
    --admin-dark: #2c3e50;
    --admin-light: #ecf0f1;
    --admin-danger: #e74c3c;
    --admin-success: #2ecc71;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fa;
    margin: 0;
    padding: 0;
    color: var(--admin-dark);
    line-height: 1.6;
}

/* Header */
h1 {
    text-align: center;
    color: var(--admin-dark);
    margin: 30px 0;
    font-size: 2.5rem;
    position: relative;
    padding-bottom: 15px;
}



/* Navigation Menu */
ul {
    max-width: 800px;
    margin: 40px auto;
    padding: 0;
    list-style: none;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

li {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

li:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

a {
    display: block;
    padding: 25px 20px;
    text-decoration: none;
    color: var(--admin-dark);
    font-weight: 500;
    font-size: 1.1rem;
    text-align: center;
    position: relative;
    transition: all 0.3s ease;
}

a::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--admin-primary);
    transition: all 0.3s ease;
}

/* Màu sắc đặc biệt cho nút đăng xuất */
li:last-child a::before {
    background: var(--admin-danger);
}

li:hover a {
    color: var(--admin-primary);
    background: #f8f9fa;
}

li:last-child:hover a {
    color: var(--admin-danger);
}

/* Hiệu ứng icon */
a::after {
    content: '→';
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0;
    transition: all 0.3s ease;
}

li:hover a::after {
    opacity: 1;
    right: 15px;
}

/* Responsive */
@media (max-width: 600px) {
    ul {
        grid-template-columns: 1fr;
        margin: 20px;
    }
    
    h1 {
        font-size: 2rem;
        margin: 20px 0;
    }
}
</style>
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


