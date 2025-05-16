<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../layout/header.php';

?>
<h2> Đặt hàng </h2>
<form method="POST" action="/process_checkout.php">
    <div class="form-group">
        <label for="customer_name">Tên khách hàng:</label>
        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
    </div>
    <div class="form-group">
        <label for="address">Địa chỉ:</label>
        <input type="text" class="form-control" id="address" name="address" required>
    </div>
    <div class="form-group">
        <label for="phone">Số điện thoại:</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
    </div>
    <input type="hidden" name="cart" id="cart">
    <button type="submit" class="btn btn-primary">Đặt hàng</button>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (cart.length === 0) {
        alert("Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi đặt hàng.");
        window.location.href = "/cart.php";
    }

    $('#cart').val(JSON.stringify(cart));

</script>
<style>
/* Kế thừa các biến màu từ hệ thống */
:root {
    --primary-color: #3498db;
    --secondary-color: #2ecc71;
    --dark-color: #2c3e50;
    --light-color: #ecf0f1;
    --danger-color: #e74c3c;
    --success-color: #27ae60;
    --gray-color: #95a5a6;
}

/* Container chung - Đồng bộ với các trang khác */
.container {
    max-width: 800px;
    margin: 30px auto;
    padding: 30px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

h2 {
    color: var(--dark-color);
    border-bottom: 2px solid var(--primary-color);
    padding-bottom: 10px;
    margin-bottom: 25px;
    font-size: 1.8rem;
}

/* Form styles - Đồng bộ với hệ thống */
.form-group {
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: var(--dark-color);
    font-size: 0.95rem;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: #f9f9f9;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    background-color: white;
}

/* Nút đặt hàng - Đồng bộ với cart.php */
.btn {
    display: inline-block;
    padding: 12px 30px;
    border-radius: 4px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    font-size: 1rem;
}

.btn-primary {
    background-color: var(--success-color);
    color: white;
    width: 100%;
    max-width: 200px;
    margin-top: 15px;
}

.btn-primary:hover {
    background-color: #219653;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(33, 150, 83, 0.3);
}

/* Phần thông tin giỏ hàng (nếu bạn thêm vào) */
.cart-summary {
    margin: 30px 0;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #eee;
}

.cart-summary h3 {
    color: var(--dark-color);
    margin-top: 0;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

/* Responsive - Đồng bộ với các trang khác */
@media (max-width: 768px) {
    .container {
        padding: 20px;
    }
    
    .btn-primary {
        max-width: 100%;
    }
}

@media (max-width: 576px) {
    .form-control {
        padding: 10px 12px;
    }
}
</style>
<?php include __DIR__ . '/../layout/footer.php'; ?>