<?php include __DIR__ . '/../views/layout/header.php'; ?>

<div class="container">
    <h1>Order History</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($order['created_at'])); ?></td>
                    <td><?php echo number_format($order['total_price'], 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo $order['status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../views/layout/footer.php'; ?>