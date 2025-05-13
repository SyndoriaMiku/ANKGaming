<?php include __DIR__ . '/../layout/header.php'; ?>
<h2>CPU List</h2>
<?php foreach ($products as $cpu): ?>
    <li>
        <img src="<?=$cpu['image']?>" alt="<?= $cpu['name'] ?>" width="100" height="100" vertical-align="middle">
        <a href="index.php?controller=product&action=getProductById&id=<?php echo $cpu['id']; ?>">
            <?php echo $cpu['name']; ?>
        </a>
        <br>
        <p>Price: <?php echo number_format($cpu['price'], 0, ',', '.'); ?> VND</p>
    </li>
    <?php endforeach; ?>
    </ul>
<?php include __DIR__ . '/../layout/footer.php'; ?>
