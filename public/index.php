<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
        // Kiểm tra xem phương thức có chấp nhận tham số không
        $method = new ReflectionMethod($c, $action);
        if ($method->getNumberOfParameters() > 0) {
            call_user_func([$c, $action], $keyword);
        } else {
            call_user_func([$c, $action]);
        }
    } else {
        call_user_func([$c, $action]);
    }
    } else {
        http_response_code(404);
        echo "404 Not Found";
    }
