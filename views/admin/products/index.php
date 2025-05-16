<?php
require_once __DIR__ . '/../../../models/Product.php';
global $conn;
$products = Product::getAll($conn);
?>


<h2>Danh sách sản phẩm</h2>
<a href="index.php?controller=admin_product&action=create" class="btn btn-primary">Thêm sản phẩm</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $item): ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td><?php echo $item['stock']; ?></td>
                <td>
                    <a href="index.php?controller=admin_product&action=edit&id=<?php echo $item['id']; ?>" class="btn btn-warning">Sửa</a>
                    <a href="index.php?controller=admin_product&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
