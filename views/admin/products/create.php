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
            <button type="submit">Create Product</button>
        </form>
    </div>
</body>
</html>