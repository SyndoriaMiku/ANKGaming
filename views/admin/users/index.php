<?php
require_once __DIR__ . '/../../../models/User.php';
global $conn;
$users = User::getAllUsers($conn);
?>
    

<h2>Danh sách người dùng</h2>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên người dùng</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $item): ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['username']; ?></td>
                <td>
                    <a href="index.php?controller=admin_user&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
