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
                    <td data-status="<?php echo strtolower($order['status']); ?>">
                        <?php echo $order['status']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../views/layout/footer.php'; ?>

<style>
    .container {
        max-width: 1280px;
        margin: 30px auto;
        padding: 20px;
        font-family: 'Segoe UI', sans-serif;
        
    }
    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #3c3e50;
        font-weight: 500;
        position: relative;
        padding-bottom: 15px;
    }
    h1::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: #3498db;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .table thead tr {
        background-color: #3498db;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }

    .table th, .table td {
        padding: 12px 15px;
        text-align: center;
    }

    .table tbody tr td:nth-child(4) {
        font-weight: 600;
        text-transform: capitalize;
    }
    
    .table tbody tr td:nth-child(4)[data-status="processing"],
    .table tbody tr td:nth-child(4)[data-status="completed"] {
        color: #27ae60;
    }
    
    .table tbody tr td:nth-child(4)[data-status="pending"] {
        color: #f39c12;
    }
    
    .table tbody tr td:nth-child(4)[data-status="cancelled"] {
        color: #e74c3c;
    }

</style>