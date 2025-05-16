<?php include __DIR__ . '/../layout/header.php'; ?>
<h2>CPU List</h2>
    <div class="product-container">
        <?php foreach ($products as $cpu): ?>
        <div class="product">
            <a href="detail.php?id=<?php echo htmlspecialchars($cpu['id']); ?>" class="product-link">
                <img class="product-image" src="<?=$cpu['image']?>" alt="<?= $cpu['name'] ?>" width="100" height="100" style="vertical-align: middle">
                <div class="product-info">
                    <h3><?php echo htmlspecialchars($cpu['name']); ?></h3>
                    <p class="price">Price: <?php echo number_format($cpu['price'], 0, ',', '.'); ?> VND</p>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
<style>
.product-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    padding: 20px;
}

.product {
    border: 1px solid #f5f5f5;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%; /* Make sure all products are the same height */
    display: flex;
    flex-direction: column;

}

.product:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.product-link {
    display: flex;
    text-decoration: none;
    color: inherit;
    flex-direction: column;
    height: 100%;
}


.product-link:hover {
    background-color: #f5f5f5;
}

.product-image {
    width: 100%;
    height: 180px;
    object-fit: contain;
    padding: 10px;
    background-color: #ffffff;
    border-bottom: 1px solid #eee;
}

.product-info {
    padding: 15px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.product-info h3 {
    margin: 0 0 10px 0;
    font-size: 16px;
    line-height: 1.3;
    flex-grow: 1;
}

.price {
    margin: 0;
    color: #d32f2f;
    font-weight: bold;
    font-size: 18px;
}
</style>