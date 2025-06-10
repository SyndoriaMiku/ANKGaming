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
    public static function filter($keyword) {
        $products = Product::getByKeyword($keyword);
        include __DIR__ . '/../views/products/index.php';
    }
    public static function filterByCategory() {
        $filters = [
            'brand' => $_GET['brand'] ?? [],
            'socket' => $_GET['socket'] ?? '',
            'price_min' => $_GET['price_min'] ?? '',
            'price_max' => $_GET['price_max'] ?? '',
            'core_min' => $_GET['core_min'] ?? '',
            'core_max' => $_GET['core_max'] ?? '',
            'boost_max' => $_GET['boost_max'] ?? '',
            'tdp_max' => $_GET['tdp_max'] ?? '',
        ];

        $products = Product::getByFilter($filters);

        include __DIR__ . '/../views/products/index.php';
    }

}