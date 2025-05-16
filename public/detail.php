<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Product.php';


if (!isset($_GET['id'])) {
    header('Location: /');
    exit;
}

$id = $_GET['id'];
$product = Product::getById($id);

include __DIR__ . '/../views/products/detail.php';

?>