<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
var_dump($_SESSION);
require_once __DIR__ . '/../config/Database.php';

$controller = $_GET['controller'] ?? 'product';
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'user':
        require_once __DIR__ . '/../controllers/UserController.php';
        $c = new UserController($conn);
       break;
    case 'product':
        require_once __DIR__ . '/../controllers/ProductController.php';
        $c = new ProductController($conn);
        break;
    }

if (method_exists($c, $action)) {
        call_user_func([$c, $action]);
    } else {
        http_response_code(404);
        echo "404 Not Found";
    }
