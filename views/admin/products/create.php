<?php
require_once __DIR__ . '/../../../config/Database.php';
require_once __DIR__ . '/../../../models/Product.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $imageFile = $_FILES['image'] ?? null;

    try {
        Product::create($conn, $data, $imageFile);
        header('Location: /admin');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Create Product</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" name="id" id="id" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" >
            </div>
            <div class="form-group">
                <label for="core">Core:</label>
                <input type="text" name="core" id="core" >
            </div>
            <div class="form-group">
                <label for="thread">Thread:</label>
                <input type="text" name="thread" id="thread" >
            </div>
            <div class="form-group">
                <label for="base_clock">Base Clock:</label>
                <input type="text" name="base_clock" id="base_clock" >
            </div>
            <div class="form-group">
                <label for="boost_clock">Boost Clock:</label>
                <input type="text" name="boost_clock" id="boost_clock" >
            </div>
            <div class="form-group">
                <label for="cache_l1">L1 Cache:</label>
                <input type="text" name="cache_l1" id="cache_l1" >
            </div>
            <div class="form-group">
                <label for="cache_l2">L2 Cache:</label>
                <input type="text" name="cache_l2" id="cache_l2" >
            </div>
            <div class="form-group">
                <label for="cache_l3">L3 Cache:</label>
                <input type="text" name="cache_l3" id="cache_l3" >
            </div>
            <div class="form-group">
                <label for="socket">Socket:</label>
                <input type="text" name="socket" id="socket" >
            </div>
            <div class="form-group">
                <label for="tdp">TDP:</label>
                <input type="text" name="tdp" id="tdp" >
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" >
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="text" name="stock" id="stock" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" accept="image/*" >
            </div>
            <div class="button-group">
                <button type="submit" class="btn btn-primary">Create Product</button> 
                <a href="/admin/index.php?controller=admin_product&action=index" class="btn btn-secondary">Cancel</a>
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