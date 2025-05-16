<?php
require_once __DIR__ . '/../../../config/Database.php';
require_once __DIR__ . '/../../../models/Product.php';

$product = null;

if (isset($_GET['id'])) {
    $product = Product::getById($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $imageFile = $_FILES['image'] ?? null;

    try {
        Product::update($conn, $product['id'], $data);
        header('Location: /admin/index.php?controller=admin_product&action=index');
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
    <title>Edit Product</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Product</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" name="id" id="id" value="<?= htmlspecialchars($product['id']) ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($product['name']) ?>" >
            </div>
            <div class="form-group">
                <label for="core">Core:</label>
                <input type="text" name="core" id="core" value="<?= htmlspecialchars($product['core']) ?>" >
            </div>
            <div class="form-group">
                <label for="thread">Thread:</label>
                <input type="text" name="thread" id="thread" value="<?= htmlspecialchars($product['thread']) ?>" >
            </div>
            <div class="form-group">
                <label for="base_clock">Base Clock:</label>
                <input type="text" name="base_clock" id="base_clock" value="<?= htmlspecialchars($product['base_clock']) ?>" >
            </div>
            <div class="form-group">
                <label for="boost_clock">Boost Clock:</label>
                <input type="text" name="boost_clock" id="boost_clock" value="<?= htmlspecialchars($product['boost_clock']) ?>" >
            </div>
            <div class="form-group">
                <label for="cache_l1">L1 Cache:</label>
                <input type="text" name="cache_l1" id="cache_l1" value="<?= htmlspecialchars($product['cache_l1']) ?>" >
            </div>
            <div class="form-group">
                <label for="cache_l2">L2 Cache:</label>
                <input type="text" name="cache_l2" id="cache_l2" value="<?= htmlspecialchars($product['cache_l2']) ?>" >
            </div>
            <div class="form-group">
                <label for="cache_l3">L3 Cache:</label>
                <input type="text" name="cache_l3" id="cache_l3" value="<?= htmlspecialchars($product['cache_l3']) ?>" >
            </div>
            <div class="form-group">
                <label for="socket">Socket:</label>
                <input type="text" name="socket" id="socket" value="<?= htmlspecialchars($product['socket']) ?>" >
            </div>
            <div class="form-group">
                <label for="tdp">TDP:</label>
                <input type="text" name="tdp" id="tdp" value="<?= htmlspecialchars($product['tdp']) ?>">
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" value="<?= htmlspecialchars($product['price']) ?>" >
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="text" name="stock" id="stock" value="<?= htmlspecialchars($product['stock']) ?>" >
            </div>
                        <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image">
                <input type="hidden" name="old_image" value="<?= htmlspecialchars($product['image']) ?>">
            </div>
            <button type="submit">Update Product</button>
        </form>
    </div>
</body>
</html>
