<?php if (isset($_SESSION['success_message'])): ?>
    <div class="modal-overlay" id="successModal">
        <div class="modal-content">
            <p><?php echo $_SESSION['success_message']; ?></p>
            <button id="closeModal">Đóng</button>
        </div>
    </div>
    <script>
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('successModal').style.display = 'none';
        });
    </script>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>
<div class="admin-header">
    <h2>Danh sách người dùng</h2>
</div>

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
                    <a href="index.php?controller=admin_user&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<style>
    /* ===== GENERAL ADMIN STYLES ===== */
:root {
    --admin-primary: #3498db;
    --admin-secondary: #2ecc71;
    --admin-warning: #f39c12;
    --admin-danger: #e74c3c;
    --admin-dark: #2c3e50;
    --admin-light: #ecf0f1;
    --admin-gray: #95a5a6;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    color: #333;
    line-height: 1.6;
    padding: 20px;
}

/* ===== HEADER STYLES ===== */
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    flex-wrap: wrap;
    gap: 15px;
}

.admin-title {
    color: var(--admin-dark);
    font-size: 1.8rem;
    margin: 0;
    position: relative;
    padding-bottom: 10px;
}

.admin-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: var(--admin-primary);
}

/* Cập nhật trong phần admin-header */
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 0 0 40px 0; /* Trên 0, phải 0, dưới 40px, trái 0 */
    padding: 0 0 25px 0; /* Padding dưới 25px */
    border-bottom: 1px solid #f0f0f0; /* Đường phân cách mờ */
    flex-wrap: wrap;
    gap: 20px; /* Tăng khoảng cách giữa title và button */
}

/* Đảm bảo container bảng có khoảng cách hợp lý */
.table-container {
    margin-top: 15px; /* Thêm khoảng cách phía trên bảng */
}

/* ===== BUTTON STYLES ===== */
.btn {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 4px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
}

.btn-primary {
    background-color: var(--admin-primary);
    color: white;
}

.btn-primary:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.btn-warning {
    background-color: var(--admin-warning);
    color: white;
}

.btn-warning:hover {
    background-color: #e67e22;
}

.btn-danger {
    background-color: var(--admin-danger);
    color: white;
}

.btn-danger:hover {
    background-color: #c0392b;
}

.btn-secondary {
    background-color: var(--admin-secondary);
    color: white;
}

.btn-secondary:hover {
    background-color: #27ae60;
}

/* ===== TABLE STYLES ===== */
.table-container {
    overflow-x: auto;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-bottom: 30px;
}

.table {
    width: 100%;
    border-collapse: collapse;
    min-width: 600px;
}

.table th {
    background-color: var(--admin-primary);
    color: white;
    padding: 12px 15px;
    text-align: left;
    font-weight: 500;
}

.table td {
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
    vertical-align: middle;
}

.table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table tr:hover {
    background-color: #f1f1f1;
}

.table .action-btns {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

/* ===== STATUS BADGES ===== */
.status-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-active {
    background-color: #d4edda;
    color: #155724;
}

.status-inactive {
    background-color: #f8d7da;
    color: #721c24;
}

.status-pending {
    background-color: #fff3cd;
    color: #856404;
}

/* ===== PAGINATION ===== */
.pagination {
    display: flex;
    justify-content: center;
    gap: 5px;
    margin-top: 20px;
}

.pagination a, .pagination span {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-decoration: none;
    color: var(--admin-primary);
}

.pagination a:hover {
    background-color: #f1f1f1;
}

.pagination .active {
    background-color: var(--admin-primary);
    color: white;
    border-color: var(--admin-primary);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .admin-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .table td, .table th {
        padding: 8px 10px;
    }
    
    .btn {
        padding: 6px 12px;
        font-size: 0.85rem;
    }
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* nền tối */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.modal-content {
    background: #fff;
    padding: 20px 30px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.modal-content p {
    margin-bottom: 20px;
    font-size: 16px;
    color: #333;
}

.modal-content button {
    padding: 8px 16px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.modal-content button:hover {
    background-color: #218838;
}

</style>