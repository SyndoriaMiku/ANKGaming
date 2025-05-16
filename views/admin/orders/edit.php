<?php
require_once __DIR__ . '/../../../config/Database.php';
require_once __DIR__ . '/../../../models/Order.php';

$order = null;

if (isset($_GET['id'])) {
    $order = Order::getOrderById($conn, $_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    try {
        Order::updateOrder($conn, $order['id'], $data);
        header('Location: /admin/index.php?controller=admin_order&action=index');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

$orderItems = [];
if ($order) {
    $orderItems = Order::getOrderItems($conn, $order['id']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Order</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" name="id" id="id" value="<?= htmlspecialchars($order['id']) ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="text" name="user_id" id="user_id" value="<?= isset($order['user_id']) && $order['user_id'] !== null ? htmlspecialchars($order['user_id']) : '' ?>" readonly>
            </div>
            <div class="form-group">
                <label for="customer_name">Customer Name:</label>
                <input type="text" name="customer_name" id="customer_name" value="<?= htmlspecialchars($order['customer_name']) ?>" >
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($order['phone']) ?>" >
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" value="<?= htmlspecialchars($order['address']) ?>" >
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="processing" <?= $order['status'] === 'processing' ? 'selected' : '' ?>>Processing</option>
                    <option value="completed" <?= $order['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                    <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
            <div class="table-item">
                <table>
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderItems as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['product_id']) ?></td>
                                <td><?= htmlspecialchars($item['quantity']) ?></td>
                                <td><?= htmlspecialchars($item['price']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="button-group">
                <button type="submit" class="btn btn-primary">Update Order</button> 
                <a href="/admin/index.php?controller=admin_order&action=index" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
<style>
    /* ===== GENERAL FORM STYLES ===== */
.container {
    max-width: 1000px;
    margin: 30px auto;
    padding: 30px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #2c3e50;
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
    font-size: 1.8rem;
}

/* ===== FORM GROUP STYLES ===== */
.form-group {
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #2c3e50;
    font-size: 0.95rem;
}

.form-group input[type="text"],
.form-group input[type="number"],
.form-group input[type="email"],
.form-group input[type="tel"],
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: #f9f9f9;
}

.form-group input[readonly] {
    background-color: #f0f0f0;
    color: #666;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    background-color: white;
}

/* ===== TABLE STYLES ===== */
.table-item {
    margin: 30px 0;
    overflow-x: auto;
}

.table-item table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

.table-item th {
    background-color: #3498db;
    color: white;
    padding: 12px 15px;
    text-align: left;
    font-weight: 500;
}

.table-item td {
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
}

.table-item tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table-item tr:hover {
    background-color: #f1f1f1;
}

/* ===== BUTTON STYLES ===== */
.form-group.button-group {
    display: flex;
    gap: 12px; /* Giảm khoảng cách giữa các nút */
    margin-top: 30px;
    padding-top: 15px;
    border-top: 1px solid #eee;
    align-items: center; /* Căn giữa theo chiều dọc */
}

.btn {
    padding: 10px 20px; /* Giảm padding so với 12px 25px */
    border-radius: 4px; /* Bo góc nhỏ hơn */
    font-size: 0.9rem; /* Cỡ chữ nhỏ hơn */
    min-width: 80px; /* Độ rộng tối thiểu */
    text-align: center;
}

/* ===== (Primary) ===== */
.btn-primary {
    background-color: #3498db;
    color: white;
    padding: 10px 25px;
    border-radius: 4px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.btn-primary:hover {
    background-color: #2980b9;
    transform: translateY(-1px);
    box-shadow: 0 3px 6px rgba(0,0,0,0.15);
}

/* ===== (Secondary) ===== */
.btn-secondary {
    background-color: transparent;
    color: #666;
    padding: 9px 18px;
    border-radius: 4px;
    font-weight: 500;
    border: 1px solid #ccc;
    cursor: pointer;
    font-size: 0.85rem;
    transition: all 0.2s ease;
    margin-left: auto;
}

.btn-secondary:hover {
    background-color: #f5f5f5;
    border-color: #999;
}

/* ===== Nhóm nút ===== */
.button-group {
    display: flex;
    align-items: center;
    margin-top: 25px;
    padding-top: 15px;
    border-top: 1px solid #eee;
}


/* ===== STATUS BADGES ===== */
.status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    margin-left: 10px;
}

.status-pending {
    background-color: #fff3cd;
    color: #856404;
}

.status-processing {
    background-color: #cce5ff;
    color: #004085;
}

.status-completed {
    background-color: #d4edda;
    color: #155724;
}

.status-cancelled {
    background-color: #f8d7da;
    color: #721c24;
}

</style>
</html>

                    