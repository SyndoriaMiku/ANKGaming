<?php
session_start();
 require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['customer_name'] ?? '';
    $address = $_POST['address'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $status = 'pending';
    $userId = $_SESSION['user_id'] ?? null;
    $cart = json_decode($_POST['cart'], true);

    if (empty($cart)) {
        echo "Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi đặt hàng.";
        exit;
    }

    //Calculate total price
    $total_price = 0;
    foreach ($cart as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    //Insert order into database
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, address, phone, total_price, status, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdsd", $name, $address, $phone, $total_price, $status, $userId);
    $stmt->execute();
    $orderId = $stmt->insert_id;


    //Insert order items into database
    $stmt_item = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($cart as $item) {
        $stmt_item->bind_param("isid", $orderId, $item['id'], $item['quantity'], $item['price']);
        $stmt_item->execute();
    }
}
?>
    <h2>Đặt hàng thành công!</h2>
    <p>Cảm ơn bạn, đơn hàng của bạn đã được ghi nhận.</p>

    <script>
        localStorage.removeItem('cart');
        setTimeout(function() {
            window.location.href = '/';
        }, 3000);

    </script>
