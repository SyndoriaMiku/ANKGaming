<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/Product.php';


class ProductController {
    public static function index() {
        $products = Product::getAll();
        include __DIR__ . '/../views/products/index.php';

    }

    public static function getProductById($id) {
        $product = Product::getById($id);
        include __DIR__ . '/../views/products/detail.php';
    }

    public function detail($id) {
        $product = Product::getById($id);
        include __DIR__ . '/../views/products/detail.php';
    }
}