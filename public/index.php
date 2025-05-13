<?php
$controller = $_GET['controller'] ?? 'product';
$action = $_GET['action'] ?? 'index';

$controllerClass = ucfirst($controller) . 'Controller';
require_once __DIR__ . '/../controllers/ProductController.php';

$controllerObject = new $controllerClass();
$params = [];
if ($action === 'getProductById') {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        die("Thiếu tham số ID sản phẩm");
    }
    $params = [$id];
}
$controllerObject->$action(...$params);
