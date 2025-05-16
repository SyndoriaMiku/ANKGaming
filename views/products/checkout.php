<?php 
session_start();
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
<?php include __DIR__ . '/../layout/footer.php'; ?>