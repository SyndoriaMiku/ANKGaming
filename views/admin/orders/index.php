<?php
require_once __DIR__ . '/../../../models/Order.php';
global $conn;
$orders = Order::getAllOrders($conn);
?>

<h2>Danh sách đơn hàng</h2>
<a href="index.php?controller=admin_order&action=create" class="btn btn-primary">Thêm đơn hàng</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $item): ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['address']; ?></td>
                <td><?php echo $item['phone']; ?></td>
                <td><?php echo $item['total_price']; ?></td>
                <td><?php echo $item['status']; ?></td>
                <td>
                    <a href="index.php?controller=admin_order&action=edit&id=<?php echo $item['id']; ?>" class="btn btn-warning">Sửa</a>
                    <a href="index.php?controller=admin_order&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
