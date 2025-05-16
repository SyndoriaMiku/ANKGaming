<?
session_start();
include __DIR__ . '/../layout/header.php';

?>
<h2> Giỏ hàng </h2>
<table class="table">
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng tiền</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody id="cart-items">
        
    </tbody>
</table>
<div class="total-price">
    <strong>Tổng tiền: </strong><span id="total-price">0</span> VNĐ 
</div>
<button class="btn btn-primary" id="btn-checkout">Thanh toán</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    function renderCart() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        let html = '';
        let total = 0;

        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            html += `
                <tr>
                    <td>${item.name}</td>
                    <td>${item.price.toLocaleString('vi-VN')} VNĐ</td>
                    <td>${item.quantity}</td>
                    <td>${itemTotal.toLocaleString('vi-VN')} VNĐ</td>
                    <td><button class="btn btn-danger" onclick="removeFromCart(${item.id})">Xóa</button></td>
                </tr>
            `;
        });

        $('#cart-items').html(html);
        $('#total-price').text(total.toLocaleString('vi-VN'));

        if (cart.length === 0) {
            $('#cart-items').html('<tr><td colspan="5">Giỏ hàng trống</td></tr>');
        }
    }

    function removeFromCart(id) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart = cart.filter(item => item.id !== id);
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
    }


    $(document).ready(function() {
        renderCart();

        $('#btn-checkout').on('click', function() {
            if (JSON.parse(localStorage.getItem('cart')).length === 0) {
                alert("Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi thanh toán.");
                return;
            }
            window.location.href = "/checkout.php";
        });
    });

</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>


