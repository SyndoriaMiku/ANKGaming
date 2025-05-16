<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../controllers/UserController.php';

$controller = new UserController($conn);
$controller->login();

include_once __DIR__ . '/../views/login.php';

// Include the footer

include_once __DIR__ . '/../views/layout/footer.php';

?>

