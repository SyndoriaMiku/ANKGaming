<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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

<style>
/* Kế thừa các biến màu từ trang detail */
:root {
    --primary-color: #3498db;
    --secondary-color: #2ecc71;
    --dark-color: #2c3e50;
    --light-color: #ecf0f1;
    --danger-color: #e74c3c;
    --success-color: #27ae60;
    --gray-color: #95a5a6;
}

/* Container chung */
.container {
    max-width: 1200px;
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

/* Bảng giỏ hàng */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}

.table th {
    background-color: var(--primary-color);
    color: white;
    padding: 15px;
    text-align: left;
    font-weight: 500;
}

.table td {
    padding: 15px;
    border-bottom: 1px solid #eee;
    vertical-align: middle;
}

.table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table tr:hover {
    background-color: #f1f1f1;
}

/* Ô số lượng */
.quantity-control {
    display: flex;
    align-items: center;
    gap: 5px;
}

.quantity-btn {
    background: var(--light-color);
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.quantity-btn:hover {
    background: var(--gray-color);
    color: white;
}

.quantity-input {
    width: 50px;
    text-align: center;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Nút xóa */
.btn-remove {
    color: var(--danger-color);
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.2rem;
    transition: all 0.2s;
    padding: 5px;
    border-radius: 4px;
}

.btn-remove:hover {
    background: #f8d7da;
    transform: scale(1.1);
}

/* Tổng tiền */
.total-price {
    text-align: right;
    font-size: 1.3rem;
    margin: 25px 0;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.total-price strong {
    color: var(--dark-color);
}

#total-price {
    color: var(--danger-color);
    font-weight: bold;
}

/* Nút thanh toán */
#btn-checkout {
    display: block;
    width: 100%;
    max-width: 200px;
    margin-left: auto;
    padding: 12px;
    font-size: 1.1rem;
    background-color: var(--success-color);
}

#btn-checkout:hover {
    background-color: #219653;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(33, 150, 83, 0.3);
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding: 20px;
    }
    
    .table th, .table td {
        padding: 10px 8px;
        font-size: 0.9rem;
    }
    
    #btn-checkout {
        max-width: 100%;
    }
}

@media (max-width: 576px) {
    .table thead {
        display: none;
    }
    
    .table tr {
        display: block;
        margin-bottom: 15px;
        border: 1px solid #eee;
        border-radius: 8px;
    }
    
    .table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eee;
    }
    
    .table td::before {
        content: attr(data-label);
        font-weight: bold;
        color: var(--dark-color);
        margin-right: 15px;
    }
}
</style>
<?php include __DIR__ . '/../layout/footer.php'; ?>


