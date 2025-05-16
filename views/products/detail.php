<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container" id="product-detail">

<h2> CPU Details </h2>
<p><strong>Name:</strong> <?=$product['name']?></p>
<p><strong>Core:</strong> <?=$product['core']?></p>
<p><strong>Thread:</strong> <?=$product['thread']?></p>
<p><strong>Base Clock:</strong> <?=$product['base_clock']?></p>
<p><strong>Boost Clock:</strong> <?=$product['boost_clock']?></p>
<p><strong>L1 Cache:</strong> <?=$product['cache_l1']?></p>
<p><strong>L2 Cache:</strong> <?=$product['cache_l2']?></p>
<p><strong>L3 Cache:</strong> <?=$product['cache_l3']?></p>
<p><strong>Socket:</strong> <?=$product['socket']?></p>
<p><strong>TDP:</strong> <?=$product['tdp']?></p>
<p><strong>Price:</strong> <?= number_format($product['price'], 0, ',', '.') ?> VNĐ</p>
<p><strong>Stock:</strong> <?=$product['stock']?></p>

<button class="btn btn-primary" id="btn-add-to-cart" >Thêm vào giỏ hàng</button>
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

<?php include __DIR__ . '/../layout/footer.php'; ?>