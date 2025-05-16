<?php include __DIR__ . '/../layout/header.php'; ?>
<h2>CPU List</h2>
<?php foreach ($products as $cpu): ?>
    <div class="product">
        <a href="detail.php?id=<?php echo htmlspecialchars($cpu['id']); ?>" class="product-link">
            <img src="<?=$cpu['image']?>" alt="<?= $cpu['name'] ?>" width="100" height="100" style="vertical-align: middle">
            <div class="product-info">
                <h3><?php echo htmlspecialchars($cpu['name']); ?></h3>
                <p class="price">Price: <?php echo number_format($cpu['price'], 0, ',', '.'); ?> VND</p>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
<?php include __DIR__ . '/../layout/footer.php'; ?>
<style>
.product-link {
    display: block;
    text-decoration: none;
    color: inherit;
}

.product-link:hover {
    background-color: #f5f5f5;
}

.product-info {
    padding: 10px;
}

.product-info h3 {
    margin: 0;
    padding: 5px 0;
}

.price {
    margin: 0;
    color: #e63946;
    font-weight: bold;
}
</style>