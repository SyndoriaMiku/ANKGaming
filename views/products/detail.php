<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container" id="product-detail">
    <div class="product-detail-container">
        <!-- Phần hình ảnh sản phẩm -->
        <div class="product-image">
            <img src="<?= htmlspecialchars($product['image'] ?? 'images/default_cpu.jpg') ?>" 
                 alt="<?= htmlspecialchars($product['name']) ?>" 
                 onerror="this.src='images/default_cpu.jpg'">
        </div>
        
        <!-- Phần thông tin sản phẩm -->
        <div class="product-info">
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            
            <div class="product-specs">
                <p><strong>Core:</strong> <?= htmlspecialchars($product['core']) ?></p>
                <p><strong>Thread:</strong> <?= htmlspecialchars($product['thread']) ?></p>
                <p><strong>Base Clock:</strong> <?= htmlspecialchars($product['base_clock']) ?> GHz</p>
                <p><strong>Boost Clock:</strong> <?= htmlspecialchars($product['boost_clock']) ?> GHz</p>
                <p><strong>L1 Cache:</strong> <?= htmlspecialchars($product['cache_l1']) ?> MB</p>
                <p><strong>L2 Cache:</strong> <?= htmlspecialchars($product['cache_l2']) ?> MB</p>
                <p><strong>L3 Cache:</strong> <?= htmlspecialchars($product['cache_l3']) ?> MB</p>
                <p><strong>Socket:</strong> <?= htmlspecialchars($product['socket']) ?></p>
                <p><strong>TDP:</strong> <?= htmlspecialchars($product['tdp']) ?> W</p>
            </div>
            
            <div class="product-price">
                <?= number_format($product['price'], 0, ',', '.') ?> VNĐ
            </div>
            
            <p class="product-stock <?= $product['stock'] > 10 ? '' : ($product['stock'] > 0 ? 'low' : 'out') ?>">
                <strong>Tồn kho:</strong> 
                <?= $product['stock'] > 0 ? htmlspecialchars($product['stock']) . ' ' : 'Hết hàng' ?>
            </p>
            
            <button class="btn btn-primary" id="btn-add-to-cart" <?= $product['stock'] > 0 ? '' : 'disabled' ?>>
                Thêm vào giỏ hàng
            </button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function addToCart() {
        $("#btn-add-to-cart").on("click", function() {
            const product = {
                id: "<?=$product['id']?>",
                name: "<?=$product['name']?>",
                price: parseInt("<?=$product['price']?>"),
                quantity: 1
            };

            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            const existingProductIndex = cart.findIndex(item => item.id === product.id);
            if (existingProductIndex !== -1) {
                cart[existingProductIndex].quantity += 1;
            } else {
                cart.push(product);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            alert("Sản phẩm đã được thêm vào giỏ hàng!");
        });
    }

    $(document).ready(function() {
        addToCart();
    });
</script>

<style>
/* CSS chung */
:root {
    --primary-color: #3498db;
    --secondary-color: #2ecc71;
    --dark-color: #2c3e50;
    --light-color: #ecf0f1;
    --gray-color: #95a5a6;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fa;
    color: #333;
    line-height: 1.6;
    padding: 0;
    margin: 0;
}

.container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

/* Phần tiêu đề */
h2 {
    color: var(--dark-color);
    border-bottom: 2px solid var(--primary-color);
    padding-bottom: 10px;
    margin-bottom: 25px;
    font-size: 1.8rem;
}

/* Layout sản phẩm */
.product-detail-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

.product-image {
    text-align: center;
    border: 1px solid #eee;
    padding: 20px;
    border-radius: 8px;
    background: white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.product-image img {
    max-width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: contain;
}

.product-info {
    padding: 0 15px;
}

/* Thông số sản phẩm */
.product-specs {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 25px;
}

.product-specs p {
    margin: 0 0 12px 0;
    padding: 8px 12px;
    background: #f8f9fa;
    border-radius: 4px;
    font-size: 0.95rem;
}

.product-specs strong {
    color: var(--dark-color);
    min-width: 120px;
    display: inline-block;
}

/* Giá và nút thêm vào giỏ */
.product-price {
    font-size: 1.5rem;
    color: #e74c3c;
    font-weight: bold;
    margin: 20px 0;
}

.product-stock {
    color: var(--secondary-color);
    font-weight: 500;
}

.product-stock.low {
    color: var(--gray-color);
}

.product-stock.out {
    color: var(--dark-color);
    font-weight: bold;
}

/* Nút thêm vào giỏ */
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
    background-color: var(--primary-color);
    color: white;
}

.btn-primary:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(41, 128, 185, 0.3);
}

/* Responsive */
@media (max-width: 768px) {
    .product-detail-container {
        grid-template-columns: 1fr;
    }
    
    .product-specs {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include __DIR__ . '/../layout/footer.php'; ?>